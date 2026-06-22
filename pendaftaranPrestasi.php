<?php
require_once __DIR__ . '/Pendaftaran.php';

/**
 * Subclass: PendaftaranPrestasi
 * Tahap 4 - Implementasi Pewarisan (Inheritance)
 */
class PendaftaranPrestasi extends Pendaftaran {

    // Properti tambahan khusus jalur Prestasi
    protected $jenisPrestasi;
    protected $tingkatPrestasi;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $jenisPrestasi, $tingkatPrestasi) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }

    /**
     * Tahap 5 - Overriding hitungTotalBiaya()
     * Prestasi: mendapat insentif/potongan apresiasi sebesar Rp50.000
     * Total Biaya = biayaPendaftaranDasar - 50000
     */
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar - 50000;
    }

    public function tampilkanInfoJalur() {
        return "Jalur Prestasi - Jenis: {$this->jenisPrestasi}, Tingkat: {$this->tingkatPrestasi}";
    }

    /**
     * Metode Query Spesifik
     * Mengambil seluruh data pendaftar jalur Prestasi
     */
    public function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}