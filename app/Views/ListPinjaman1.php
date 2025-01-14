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
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Nama Driver</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listpinjaman as $pinjaman) : ?>
                    <tr>
                        <td><?= $pinjaman['fullname'] ?></td>
                        <td><?= $pinjaman['nama_driver'] ?></td>
                        <td><?= date_format(date_create($pinjaman['tanggal_pinjaman']), "d F Y") ?></td>
                        <td> <?= date_format(date_create($pinjaman['tanggal_kembali']), "d F Y") ?></td>
                        <td><?= $pinjaman['status'] ?></td>
                        <td class="no-print">
                            <a href="<?= base_url('/DetailPinjaman/' . $pinjaman['id_pinjaman'] . '-' . url_title($pinjaman['fullname'])) ?>" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>


                            <?= view('Kembalikan', ['pinjaman' => $pinjaman]) ?>
                        </td>
                    </tr>
                <?php endforeach ?>


            </tbody>

        </table>
    <?php else: ?>
        <p class="mt-1">Data Pinjaman Tidak Tersedia !!!</p>

    <?php endif ?>


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