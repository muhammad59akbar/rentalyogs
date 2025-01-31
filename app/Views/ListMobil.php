<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2 titleku">List Mobil</h2>
    <hr>




    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success mt-2" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <?= $this->include('AddMobil'); ?>




    <div class="d-flex flex-wrap justify-content-center justify-content-lg-start ">

        <?php
        $mobilTersedia = array_filter($listMobil, function ($mbl) {
            return $mbl['status'] === 'Tersedia';
        });
        ?>
        <?php if (!empty($mobilTersedia)) : ?>
            <?php foreach ($mobilTersedia as $mbl) : ?>

                <div class="card m-2" style="width: 18rem;">
                    <img src="<?= base_url('/assets/images/mobil/' . $mbl['img_mobil']) ?>" class="card-img-top p-1" alt="..." style="height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title" style="height: 50px;"><?= $mbl['merk_mobil'] ?></h5>
                        <div class="row mb-3">
                            <div class="col-4">
                                <p class="card-text">No Plat</p>
                            </div>
                            <div class="col-8">
                                <p class="card-text">: <?= $mbl['no_plat'] ?></p>
                            </div>

                            <div class="col-4">
                                <p class="card-text">Warna</p>
                            </div>
                            <div class="col-8">

                                <p class="card-text">: <?= $mbl['warna_mobil'] ?></p>

                            </div>
                        </div>






                        <?php if (in_groups(['Admin'])) : ?>

                            <a href="<?= base_url('DetailMobil/' . url_title($mbl['no_plat'], '-')) ?>" class="btn btn-success">
                                <i class="bi bi-pencil-square"></i>
                            </a>


                            <form class="d-inline" method="post" action="<?= base_url('/DeleteDataMobil/' . $mbl['id_mobil']) ?>">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data ini ???')"><i class="bi bi-archive-fill"></i></i></button>
                            </form>
                        <?php else : ?>
                            <div></div>
                        <?php endif; ?>








                    </div>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <p class="mt-1">Data Mobil Tidak Tersedia !!!</p>
        <?php endif ?>




    </div>
</div>



<script>
    // $(document).ready(function() {
    //     <?php if (session('errors')) : ?>
    //         $('#productModal').modal('show');





    //     <?php endif; ?>
    // });

    $(document).ready(function() {
        <?php if (session('errors')) : ?>
            <?php if (session('modal') == 'mobil') : ?>
                $('#mobilsModal').modal('show');
            <?php elseif (session('modal') == 'pinjam') : ?>
                var mobilid = '<?= session('id_mobil') ?>'; // Ambil ID produk dari session
                $('#orderModal-' + mobilid).modal('show');
            <?php endif; ?>
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>