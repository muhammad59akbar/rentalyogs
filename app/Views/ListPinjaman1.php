<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>


<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2 titleku">List Pinjaman</h2>




    <hr>
    <?= $this->include('PinjamMobils'); ?>
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success mt-2" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($listpinjaman)) : ?>
        <table id="ListPinjaman" class="display" style="width:100%">
            <thead>
                <tr>

                    <th>Nama Driver</th>
                    <th>Merk Mobil</th>
                    <th>No Plat</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listpinjaman as $lp) : ?>
                    <tr>
                        <td><?= $lp['nama_driver'] ?></td>
                        <td><?= $lp['merk_mobil'] ?></td>
                        <td><?= $lp['no_plat'] ?></td>
                        <td><?= date_format(date_create($lp['tanggal_pinjaman']), "d F Y") ?></td>
                        <td><?= date_format(date_create($lp['tanggal_kembali']), "d F Y") ?></td>
                        <td><?= $lp['status'] ?></td>
                        <td class="d-flex">
                            <a href="<?= base_url('/DetailPinjaman/' . $lp['id_pinjaman'] . '-' . url_title($lp['nama_driver'])) ?>" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                            <a href="<?= base_url('/SuratJalan/' . $lp['id_pinjaman'] . '-' . url_title($lp['nama_driver'])) ?>" class="btn btn-primary mx-1"><i class="bi bi-list-task"></i></a>



                        </td>
                    </tr>
                <?php endforeach ?>



            </tbody>

        </table>

    <?php else : ?>

        <p class="mt-3">Data Pinjaman Tidak Tersedia !!!</p>
    <?php endif; ?>






    <script>
        $(document).ready(function() {
            <?php if (session('errors')) : ?>
                <?php if (session('modal' == 'pinjam')) : ?>

                    $('#pinjamMobil').modal('show');
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>


    <?= $this->endSection(); ?>