<?php
require_once __DIR__ . '/Pendaftaran.php';

/**
 * Subclass: PendaftaranReguler
 * Tahap 4 - Implementasi Pewarisan (Inheritance)
 */
class PendaftaranReguler extends Pendaftaran {

    // Properti tambahan khusus jalur Reguler
    protected $pilihanProdi;
    protected $lokasiKampus;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $pilihanProdi, $lokasiKampus) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

    // Implementasi method abstrak dari induk
    // CATATAN: logika biaya final menyusul di Tahap 5 sesuai ketentuan soal
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar;
    }

    public function tampilkanInfoJalur() {
        return "Jalur Reguler - Prodi: {$this->pilihanProdi}, Kampus: {$this->lokasiKampus}";
    }

    /**
     * Metode Query Spesifik
     * Mengambil seluruh data pendaftar jalur Reguler
     */
    public function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}