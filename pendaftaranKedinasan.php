<?php
require_once __DIR__ . '/Pendaftaran.php';

/**
 * Subclass: PendaftaranKedinasan
 * Tahap 4 - Implementasi Pewarisan (Inheritance)
 */
class PendaftaranKedinasan extends Pendaftaran {

    // Properti tambahan khusus jalur Kedinasan
    protected $skIkatanDinas;
    protected $instansiSponsor;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $skIkatanDinas, $instansiSponsor) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }

    // Implementasi method abstrak dari induk
    // CATATAN: logika biaya final menyusul di Tahap 5 sesuai ketentuan soal
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar;
    }

    public function tampilkanInfoJalur() {
        return "Jalur Kedinasan - SK: {$this->skIkatanDinas}, Instansi Sponsor: {$this->instansiSponsor}";
    }

    /**
     * Metode Query Spesifik
     * Mengambil seluruh data pendaftar jalur Kedinasan
     */
    public function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}