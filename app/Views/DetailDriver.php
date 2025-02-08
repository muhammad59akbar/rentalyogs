<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>

<div class="main-content mt-5" id="mainContent">
    <h1 class="titleku">Edit Data Mobil</h1>
    <hr>
    <!-- alert -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success mt-2" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    <a href="<?= base_url('/ListDriver') ?>" class="m-2">&laquo; Kembali</a>

    <form id="formproduk" action="<?= base_url('/editDriver/' . $ddriver['id_driver']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="container mt-3">
            <div class="col-lg-5 mb-2">
                <input type="hidden" name="id_driver" value="<?= $ddriver['id_driver'] ?>">
                <label for="ndriver" class="form-label">Nama Driver</label>
                <input type="text" class="form-control <?= session('errors.ndriver') ? 'is-invalid' : '' ?>" id="ndriver" aria-describedby="ndriver" name="ndriver" required value="<?= $ddriver['nama_driver'] ?>">
                <div class="invalid-feedback">
                    <?= session('errors.ndriver') ?>
                </div>
            </div>

            <div class="mb-2 col-lg-5">
                <label for="notelp" class="form-label <?= session('errors.notelp') ? 'is-invalid' : '' ?>">No Telepon</label>
                <input class="form-control" type="text" id="notelp" name="notelp" value="<?= $ddriver['no_telp'] ?>">
                <div class="invalid-feedback">
                    <?= session('errors.notelp') ?>
                </div>
            </div>

            <div class="col-lg-5 mb-2">
                <label for="nikdriver" class="form-label">NIK Driver</label>
                <input class="form-control <?= session('errors.nikdriver') ? 'is-invalid' : '' ?>" type="text" id="nikdriver" name="nikdriver" value="<?= $ddriver['nik_driver'] ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nikdriver') ?>
                </div>

            </div>






            <a href="<?= base_url('/ListDriver') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>


    </form>
</div>


<?= $this->endSection(); ?>