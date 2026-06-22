<?php
/**
 * Abstract Class: Pendaftaran
 * Tahap 3 - Implementasi Abstraksi (Abstraction)
 *
 * Merepresentasikan atribut global (induk) yang dipetakan
 * dari kolom tabel_pendaftaran pada basis data Tahap 1.
 */

abstract class Pendaftaran {

    // Properti/Atribut terenkapsulasi (protected)
    // dipetakan dari kolom tabel_pendaftaran
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar) {
        $this->id_pendaftaran = $id_pendaftaran;
        $this->nama_calon = $nama_calon;
        $this->asal_sekolah = $asal_sekolah;
        $this->nilai_ujian = $nilai_ujian;
        $this->biayaPendaftaranDasar = $biayaPendaftaranDasar;
    }

    // Metode abstrak (tanpa isi/body)
    // Wajib diimplementasikan oleh setiap subclass turunan
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}