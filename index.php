<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/pendaftaran.php';
require_once __DIR__ . '/pendaftaranRegular.php';
require_once __DIR__ . '/pendaftaranPrestasi.php';
require_once __DIR__ . '/pendaftaranKedinasan.php';

$database = new Database();
$db = $database->getConnection();

$objReguler   = new pendaftaranRegular(null, null, null, null, null, null, null);
$objPrestasi  = new pendaftaranPrestasi(null, null, null, null, null, null, null);
$objKedinasan = new pendaftaranKedinasan(null, null, null, null, null, null, null);

$dataReguler   = $objReguler->getDaftarReguler($db);
$dataPrestasi  = $objPrestasi->getDaftarPrestasi($db);
$dataKedinasan = $objKedinasan->getDaftarKedinasan($db);

function buatObjekDariRow($row) {
    $jalur = $row['jalur_pendaftaran'];
    if ($jalur === 'Reguler') {
        return new pendaftaranRegular(
            $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'],
            $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'],
            $row['pilihan_prodi'], $row['lokasi_kampus']
        );
    } elseif ($jalur === 'Prestasi') {
        return new pendaftaranPrestasi(
            $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'],
            $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'],
            $row['jenis_prestasi'], $row['tingkat_prestasi']
        );
    } elseif ($jalur === 'Kedinasan') {
        return new pendaftaranKedinasan(
            $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'],
            $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'],
            $row['sk_ikatan_dinas'], $row['instansi_sponsor']
        );
    }
    return null;
}

function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Mahasiswa Baru</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: #EEF2F7; color: #1A2B45; }

        header {
            background: linear-gradient(135deg, #1B3A6B 0%, #0D2240 100%);
            color: #fff; padding: 40px 32px 32px;
            border-bottom: 4px solid #D4A017;
        }
        header .eyebrow { font-size: 11px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #D4A017; margin-bottom: 10px; }
        header h1 { font-size: 28px; font-weight: 700; margin-bottom: 6px; }
        header p { font-size: 13px; color: #94B0CC; }

        .summary-bar { display: flex; gap: 16px; padding: 16px 32px; background: #fff; border-bottom: 1px solid #DDE5F0; flex-wrap: wrap; }
        .summary-item { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #445566; }
        .summary-dot { width: 12px; height: 12px; border-radius: 50%; }
        .summary-item strong { color: #1A2B45; }

        main { max-width: 1200px; margin: 0 auto; padding: 32px 24px 60px; display: flex; flex-direction: column; gap: 40px; }

        .jalur-header { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; }
        .jalur-badge { padding: 5px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #fff; }
        .badge-reguler   { background: #2E6DA4; }
        .badge-prestasi  { background: #2A7A4B; }
        .badge-kedinasan { background: #A0320A; }
        .jalur-header h2 { font-size: 20px; font-weight: 700; }
        .jalur-header .count { margin-left: auto; font-size: 13px; color: #667788; background: #EEF2F7; padding: 4px 12px; border-radius: 12px; }

        .card { background: #fff; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.07); overflow: hidden; border: 1px solid #DDE5F0; }

        table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        thead { background: #F4F7FB; border-bottom: 2px solid #DDE5F0; }
        thead th { padding: 13px 16px; text-align: left; font-size: 11px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; color: #5A7090; }
        tbody tr { border-bottom: 1px solid #F0F3F8; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #F8FAFD; }
        tbody td { padding: 13px 16px; color: #334455; }

        .td-id    { font-size: 11px; color: #99AABB; font-weight: 600; }
        .td-nama  { font-weight: 600; color: #1A2B45; }
        .td-nilai { font-weight: 600; color: #2E6DA4; }
        .td-info  { font-size: 12px; color: #556677; font-style: italic; }
        .td-biaya { font-weight: 700; white-space: nowrap; }
        .biaya-reguler   { color: #2E6DA4; }
        .biaya-prestasi  { color: #2A7A4B; }
        .biaya-kedinasan { color: #A0320A; }

        .empty-state { padding: 40px; text-align: center; color: #99AABB; }
        footer { text-align: center; padding: 20px; font-size: 12px; color: #99AABB; border-top: 1px solid #DDE5F0; background: #fff; }
    </style>
</head>
<body>

<header>
    <div class="eyebrow">Politeknik Negeri Cilacap &mdash; Kelas TI1C</div>
    <h1>Sistem Informasi Pendaftaran Mahasiswa Baru</h1>
    <p>Data diambil secara dinamis dari <code>tabel_pendaftaran</code> &mdash; dikelompokkan per jalur menggunakan PHP OOP</p>
</header>

<div class="summary-bar">
    <div class="summary-item">
        <div class="summary-dot" style="background:#2E6DA4"></div>
        <span>Reguler: <strong><?= count($dataReguler) ?> pendaftar</strong></span>
    </div>
    <div class="summary-item">
        <div class="summary-dot" style="background:#2A7A4B"></div>
        <span>Prestasi: <strong><?= count($dataPrestasi) ?> pendaftar</strong></span>
    </div>
    <div class="summary-item">
        <div class="summary-dot" style="background:#A0320A"></div>
        <span>Kedinasan: <strong><?= count($dataKedinasan) ?> pendaftar</strong></span>
    </div>
    <div class="summary-item" style="margin-left:auto">
        <span>Total: <strong><?= count($dataReguler) + count($dataPrestasi) + count($dataKedinasan) ?> pendaftar</strong></span>
    </div>
</div>

<main>

    <section>
        <div class="jalur-header">
            <span class="jalur-badge badge-reguler">Reguler</span>
            <h2>Jalur Reguler</h2>
            <span class="count"><?= count($dataReguler) ?> data</span>
        </div>
        <div class="card">
            <?php if (empty($dataReguler)): ?>
                <div class="empty-state">Tidak ada data jalur Reguler.</div>
            <?php else: ?>
            <table>
                <thead><tr><th>#</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Info Jalur</th><th>Total Biaya</th></tr></thead>
                <tbody>
                <?php foreach ($dataReguler as $row): $obj = buatObjekDariRow($row); ?>
                <tr>
                    <td class="td-id"><?= $row['id_pendaftaran'] ?></td>
                    <td class="td-nama"><?= htmlspecialchars($row['nama_calon']) ?></td>
                    <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                    <td class="td-nilai"><?= $row['nilai_ujian'] ?></td>
                    <td class="td-info"><?= htmlspecialchars($obj->tampilkanInfoJalur()) ?></td>
                    <td class="td-biaya biaya-reguler"><?= formatRupiah($obj->hitungTotalBiaya()) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <div class="jalur-header">
            <span class="jalur-badge badge-prestasi">Prestasi</span>
            <h2>Jalur Prestasi</h2>
            <span class="count"><?= count($dataPrestasi) ?> data</span>
        </div>
        <div class="card">
            <?php if (empty($dataPrestasi)): ?>
                <div class="empty-state">Tidak ada data jalur Prestasi.</div>
            <?php else: ?>
            <table>
                <thead><tr><th>#</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Info Jalur</th><th>Total Biaya</th></tr></thead>
                <tbody>
                <?php foreach ($dataPrestasi as $row): $obj = buatObjekDariRow($row); ?>
                <tr>
                    <td class="td-id"><?= $row['id_pendaftaran'] ?></td>
                    <td class="td-nama"><?= htmlspecialchars($row['nama_calon']) ?></td>
                    <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                    <td class="td-nilai"><?= $row['nilai_ujian'] ?></td>
                    <td class="td-info"><?= htmlspecialchars($obj->tampilkanInfoJalur()) ?></td>
                    <td class="td-biaya biaya-prestasi"><?= formatRupiah($obj->hitungTotalBiaya()) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <div class="jalur-header">
            <span class="jalur-badge badge-kedinasan">Kedinasan</span>
            <h2>Jalur Kedinasan</h2>
            <span class="count"><?= count($dataKedinasan) ?> data</span>
        </div>
        <div class="card">
            <?php if (empty($dataKedinasan)): ?>
                <div class="empty-state">Tidak ada data jalur Kedinasan.</div>
            <?php else: ?>
            <table>
                <thead><tr><th>#</th><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Info Jalur</th><th>Total Biaya</th></tr></thead>
                <tbody>
                <?php foreach ($dataKedinasan as $row): $obj = buatObjekDariRow($row); ?>
                <tr>
                    <td class="td-id"><?= $row['id_pendaftaran'] ?></td>
                    <td class="td-nama"><?= htmlspecialchars($row['nama_calon']) ?></td>
                    <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                    <td class="td-nilai"><?= $row['nilai_ujian'] ?></td>
                    <td class="td-info"><?= htmlspecialchars($obj->tampilkanInfoJalur()) ?></td>
                    <td class="td-biaya biaya-kedinasan"><?= formatRupiah($obj->hitungTotalBiaya()) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </section>

</main>

<footer>Latihan UAS PBO &mdash; TI1C &mdash; AlyaDhitiNurIzdihar &mdash; Politeknik Negeri Cilacap</footer>
</body>
</html>