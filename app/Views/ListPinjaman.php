<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>


<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2">List Pinjaman</h2>


    <hr>
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success mt-2" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>


    <?php if (session()->getFlashdata('terlarang')) : ?>
        <div class="alert alert-danger mt-2" role="alert">
            <?= session()->getFlashdata('terlarang') ?>
        </div>
    <?php endif; ?>




    <?php if (!empty($listpinjaman)) : ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col border-2">No</th>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Nama Driver</th>
                        <th scope="col">Tanggal Peminjaman</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Status</th>

                        <th scope="col">Action</th>



                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($listpinjaman as $pinjaman) : ?>


                        <tr class="text-center">
                            <th><?= $no++ ?></th>
                            <td><?= $pinjaman['fullname'] ?></td>
                            <td><?= $pinjaman['nama_driver'] ?></td>

                            <td>
                                <?= date_format(date_create($pinjaman['tanggal_pinjaman']), "d F Y") ?>
                            </td>
                            <td>
                                <?= date_format(date_create($pinjaman['tanggal_kembali']), "d F Y") ?>
                            </td>



                            <td><?= $pinjaman['status'] ?></td>
                            <td>

                                <a href="<?= base_url('/DetailPinjaman/' . $pinjaman['id_pinjaman'] . '-' . url_title($pinjaman['fullname'])) ?>" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>


                                <?= view('Kembalikan', ['pinjaman' => $pinjaman]) ?>






                            </td>
                        </tr>
                    <?php endforeach ?>



                </tbody>

            </table>
        </div>
    <?php else: ?>
        <p class="mt-1">Data Pinjaman Tidak Tersedia !!!</p>

    <?php endif ?>

</div>

<script>
    $(document).ready(function() {
        <?php if (session('errors')) : ?>
            let id_pinjaman = '<?= session('id_pinjaman') ?>';
            $('#kembalikanModal-' + id_pinjaman).modal('show');

        <?php endif; ?>
    });

    document.addEventListener('submit', function(e) {
        const idPinjaman = document.querySelector('input[name="id_pinjaman"]').value;
        if (!idPinjaman) {
            alert('ID pinjaman tidak boleh kosong.');
            e.preventDefault();
        }
    });
</script>


<?= $this->endSection(); ?>