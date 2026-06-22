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

    /**
     * Tahap 5 - Overriding hitungTotalBiaya()
     * Kedinasan: dikenakan surcharge 25% untuk administrasi khusus & kemitraan dinas
     * Total Biaya = biayaPendaftaranDasar * 1.25
     */
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar * 1.25;
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