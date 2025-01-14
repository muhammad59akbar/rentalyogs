<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>

<div class="main-content mt-5" id="mainContent">
    <h1>Edit Data Mobil</h1>
    <hr>
    <!-- alert -->
    <a href="<?= base_url('/ListMobil') ?>" class="m-2">&laquo; Kembali</a>

    <form id="formproduk" action="<?= base_url('/editDataMobil/' . $mobil['id_mobil']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="container mt-3">
            <div class="d-flex flex-column">
                <input type="hidden" name="id_mobil" value="<?= $mobil['id_mobil'] ?>">
                <input type="hidden" name="gmbrmobillama" value="<?= $mobil['img_mobil'] ?>">
                <label for="merkmobil" class="form-label">Merk Mobil</label>
                <input type="text" class="form-control" id="merkmobil" aria-describedby="merkmobil" name="merkmobil" required value="<?= $mobil['merk_mobil'] ?>">


            </div>

            <div class="mb-2 ">
                <label for="warnambl" class="form-label">Warna Mobil</label>
                <input class="form-control" type="text" id="warnambl" name="warnambl" value="<?= $mobil['warna_mobil'] ?>">

            </div>
            <div class="my-2">
                <img class="img-thumbnail" src="<?= base_url('assets/images/mobil/' . $mobil['img_mobil']) ?>" alt="" width="250" height="250" id="prevImage">

            </div>
            <div class="mb-2 ">
                <label for="gmbr_mbl" class="form-label">Gambar Mobil</label>
                <input class="form-control" type="file" id="gmbr_mbl" name="gmbr_mbl" onchange="changeImage(this, 'prevImage')">
            </div>


            <div class="mb-2 ">
                <label for="noplat" class="form-label">No Plat</label>
                <input class="form-control" type="text" id="noplat" name="noplat" value="<?= $mobil['no_plat'] ?>">

            </div>

            <div class="mb-2 ">
                <label for="nostnk" class="form-label">No STNK</label>
                <input class="form-control" type="text" id="nostnk" name="nostnk" value="<?= $mobil['no_stnk'] ?>">

            </div>




            <a href="<?= base_url('/ListMobil') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>


    </form>
</div>


<?= $this->endSection(); ?>