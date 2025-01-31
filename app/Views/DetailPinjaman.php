<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>

<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2 titleku">Detail Pinjaman</h2>



    <a href="<?= base_url('/ListPinjaman') ?>" class="m-2">&laquo; Kembali</a>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h5>Nama Driver</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['nama_driver'] ?></p>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <h5>NIK Driver</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['nik_driver'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h5>No Telp Driver</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['no_telp'] ?></p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-4">
                <h5>Merk Mobil yang di Pinjam</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['merk_mobil'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 d-flex align-items-center">
                <h5>Gambar Mobil</h5>
            </div>
            <div class="col-lg-5">
                <p class="d-flex align-items-center">: <img src="<?= base_url('assets/images/mobil/') . $listpinjaman['img_mobil'] ?>" alt="" class="img-thubnail" width="350" height="250"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h5>No Plat Mobil</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['no_plat'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h5>Tanggal Peminjaman</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['tanggal_pinjaman'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h5>Tanggal Dikembalikan</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['tanggal_kembali'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h5>Status</h5>
            </div>
            <div class="col-lg-5">
                <p>: <?= $listpinjaman['status'] ?></p>
            </div>
        </div>




    </div>


</div>

<?= $this->endSection(); ?>