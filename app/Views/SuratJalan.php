<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>-</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/SJ.css') ?>" />
</head>


<body>
    <div class="kop-surat" style="display: flex; align-items: center; gap: 20px;">
        <img src="<?= base_url('assets/images/kop.jpeg') ?>" alt="Logo" style="width: 100px; height: auto;">
        <div style="flex: 1;">
            <h4>PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA</h4>
            <h4>SEKRETARIAT DEWAN PERWAKILAN RAKYAT DAERAH</h4>
            <p style="margin: 0; text-align: center;">Jalan Kebon Sirih Nomor 18, Telepon 3808701, 3822049</p>
            <p style="margin: 0; text-align: center;">JAKARTA</p>
            <p style="text-align: end;">Kode Pos 10110</p>
        </div>
    </div>
    <hr>

    <div class="content">
        <h4 style="text-align: center;">SURAT TUGAS</h4>
        <p style="text-align: center;"><i>Nomor : <?= $listpinjaman['id_pinjaman'] ?> /ST-KDO/IX/2024 </i> </p>
        <div class="konten-surat">
            <p>
                Dalam rangka memfasilitasi kegiatan DPRD dan Sekretariat DPRD Provinsi DKI Jakarta diluar kantor, dengan ini Kasubbag Perlengkapan Sekretariat DPRD Provinsi DKI Jakarta.
            </p>

        </div>

        <h4 style="text-align: center;">MENUGASKAN</h4>

        <table>
            <tr>
                <td><strong>Nama Driver</strong></td>
                <td>: <?= $listpinjaman['nama_driver'] ?></td>
            </tr>
            <tr>
                <td><strong>Hari</strong></td>
                <?php
                $hariInggris = [
                    'Sunday' => 'Minggu',
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu'
                ];
                ?>
                <td>: <?= $hariInggris[date('l', strtotime($listpinjaman['tanggal_pinjaman']))] ?> - <?= $hariInggris[date('l', strtotime($listpinjaman['tanggal_kembali']))] ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal</strong></td>
                <td>: <?= date('d', strtotime($listpinjaman['tanggal_pinjaman'])) ?> - <?= date('d F Y', strtotime($listpinjaman['tanggal_kembali'])) ?></td>
            </tr>
            <tr>
                <td><strong>Jenis Kendaraan</strong></td>
                <td>: <?= $listpinjaman['merk_mobil'] ?></td>
            </tr>
            <tr>
                <td><strong>Nopol Kendaraan</strong></td>
                <td>: <?= $listpinjaman['no_plat'] ?></td>
            </tr>
            <tr>
                <td><strong>Tujuan</strong></td>
                <td>: tetetete</td>
            </tr>
        </table>

        <p>Demikian surat tugas ini, agar dilaksanakan dengan penuh tanggung jawab.</p>
    </div>

    <!-- Tanda Tangan -->
    <div class="footer">
        <p>Jakarta, <?= strftime('%d %B %Y') ?></p>
        <p>Kasubbag Perlengkapan</p>
        <div class="signature"></div>
        <p>Juniadi Jatno Prasetyo</p>
        <p>NIP. 196906091997031006</p>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        // Menangani aksi setelah cetak selesai (print atau cancel)
        window.onafterprint = function() {
            // Redirect setelah print atau cancel
            window.location.href = 'http://localhost:8080/ListPinjaman'; // Ganti dengan URL yang sesuai
        };

        window.print();
    });
</script>

</html>