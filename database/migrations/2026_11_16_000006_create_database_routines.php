<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. FUNCTION: hitung denda keterlambatan (Rp 5.000/hari)
        DB::unprepared('DROP FUNCTION IF EXISTS fn_hitung_denda;');
        DB::unprepared('
            CREATE FUNCTION fn_hitung_denda(p_rencana DATE, p_real DATE, p_tarif DECIMAL(12,2))
            RETURNS DECIMAL(12,2) DETERMINISTIC
            BEGIN
                IF p_real > p_rencana THEN
                    RETURN DATEDIFF(p_real, p_rencana) * p_tarif;
                END IF;
                RETURN 0.00;
            END
        ');

        // 2. TRIGGER: kurangi stok otomatis saat peminjaman disetujui
        DB::unprepared('DROP TRIGGER IF EXISTS trg_peminjaman_approved_stok;');
        DB::unprepared("
            CREATE TRIGGER trg_peminjaman_approved_stok
            AFTER UPDATE ON peminjamans
            FOR EACH ROW
            BEGIN
                IF NEW.status = 'disetujui' AND OLD.status != 'disetujui' THEN
                    UPDATE alats
                    SET stok = GREATEST(0, stok - NEW.jumlah), updated_at = NOW()
                    WHERE id = NEW.alat_id;
                END IF;
            END
        ");

        // 3. STORED PROCEDURE: proses pengembalian + denda + pulihkan stok
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_kembalikan_alat;');
        DB::unprepared("
            CREATE PROCEDURE sp_kembalikan_alat(
                IN p_pinjam_id BIGINT,
                IN p_petugas_id BIGINT,
                IN p_tgl DATE,
                IN p_kondisi VARCHAR(50),
                IN p_rusak DECIMAL(12,2),
                OUT p_total DECIMAL(12,2)
            )
            BEGIN
                DECLARE v_rencana DATE;
                DECLARE v_alat BIGINT;
                DECLARE v_jml INT;
                DECLARE v_user BIGINT;
                DECLARE v_telat INT DEFAULT 0;
                DECLARE v_denda DECIMAL(12,2) DEFAULT 0;

                SELECT tgl_kembali_rencana, alat_id, jumlah, user_id
                INTO v_rencana, v_alat, v_jml, v_user
                FROM peminjamans WHERE id = p_pinjam_id;

                IF p_tgl > v_rencana THEN
                    SET v_telat = DATEDIFF(p_tgl, v_rencana);
                    SET v_denda = fn_hitung_denda(v_rencana, p_tgl, 5000);
                END IF;

                SET p_total = v_denda + IFNULL(p_rusak, 0);

                INSERT INTO pengembalians (
                    kode_pengembalian, peminjaman_id, user_id, petugas_id,
                    tgl_kembali_real, terlambat_hari, denda_terlambat,
                    kondisi_alat, denda_kerusakan, total_denda, status_denda,
                    created_at, updated_at
                ) VALUES (
                    CONCAT('KB-', p_pinjam_id, '-', UNIX_TIMESTAMP()),
                    p_pinjam_id, v_user, p_petugas_id,
                    p_tgl, v_telat, v_denda,
                    p_kondisi, IFNULL(p_rusak, 0), p_total,
                    IF(p_total > 0, 'belum_lunas', 'tidak_ada_denda'),
                    NOW(), NOW()
                );

                UPDATE peminjamans SET status = 'selesai', updated_at = NOW() WHERE id = p_pinjam_id;
                UPDATE alats SET stok = stok + v_jml, updated_at = NOW() WHERE id = v_alat;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_peminjaman_approved_stok; DROP PROCEDURE IF EXISTS sp_kembalikan_alat; DROP FUNCTION IF EXISTS fn_hitung_denda;');
    }
};
