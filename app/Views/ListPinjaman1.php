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
        <!-- filter tahun -->
        <select id="filterYear" class="form-select my-3" style="width: 150px; margin-bottom: 10px;">
            <option value="">Semua Tahun</option>
        </select>
        <table id="ListPinjaman" class="display" style="width:100%">
            <thead>
                <tr>

                    <th>Nama Peminjam</th>
                    <th>Nama Driver</th>
                    <th>Merk Mobil</th>
                    <th>No Plat</th>
                    <th>Tahun</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listpinjaman as $lp) : ?>
                    <tr>
                        <td><?= $lp['namapeminjam'] ?></td>
                        <td><?= $lp['nama_driver'] ?></td>
                        <td><?= $lp['merk_mobil'] ?></td>
                        <td><?= $lp['no_plat'] ?></td>
                        <td><?= date_format(date_create($lp['tanggal_pinjaman']), "Y") ?></td>
                        <td><?= date_format(date_create($lp['tanggal_pinjaman']), "d F Y") ?></td>
                        <td><?= date_format(date_create($lp['tanggal_kembali']), "d F Y") ?></td>
                        <td><?= $lp['status'] ?></td>
                        <!-- Disetujui Pending, Selesai -->
                        <td class="d-block d-lg-flex justify-content-center">
                            <a href="<?= base_url('/DetailPinjaman/' . url_title($lp['id_pinjaman'] . '-' . $lp['namapeminjam'], '-', true)) ?>" class="btn btn-primary m-1">
                                <i class="bi bi-eye-fill"></i></a>
                            <?php if (in_groups(['Pengelola Barang'])) : ?>
                                <?php if ($lp['status'] === 'Pending') : ?>
                                    <!-- edit nama driver, merk mobil , tanggal pinjaman dan kembali tujuan, jemput -->
                                    <?= view('EditPinjaman', ['lp' => $lp]) ?>
                                <?php endif; ?>

                                <?php if ($lp['status'] !== 'Selesai') : ?>

                                    <form class="m-1" method="post" action="<?= base_url('/DeletePinjaman/' . $lp['id_pinjaman']) ?>">
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus peminjaman ini ???')"><i class="bi bi-trash2-fill"></i></button>
                                    </form>
                                <?php endif; ?>


                            <?php endif; ?>
                            <?php if (in_groups(['Pengelola Barang'])) : ?>
                                <?php if ($lp['status'] === 'Pending') : ?>

                                    <form class="m-1" method="post" action="<?= base_url('/ApproveMobil') ?>">
                                        <input type="hidden" name="no_pinjaman" value="<?= $lp['id_pinjaman'] ?>">
                                        <input type="hidden" name="approve_by" value="<?= user_id() ?>">
                                        <button type="submit" class="btn btn-success" onclick="return confirm('apakah anda yakin ingin menyetujui peminjaman ini ???')"><i class="bi bi-clipboard-check-fill"></i></button>
                                    </form>
                                <?php else: ?>
                                    <a href="<?= base_url('/SuratJalan/' . url_title($lp['id_pinjaman'] . '-' . $lp['namapeminjam'], '-', true)) ?>
                                    " class="btn btn-primary m-1"><i class="bi bi-list-task"></i></a>
                                <?php endif; ?>
                            <?php endif ?>





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
                <?php if (session('modal')  == 'pinjam') : ?>

                    $('#pinjamMobil').modal('show');
                <?php elseif (session('modalubah') == 'ubahpinjaman') : ?>

                    var idpinjaman = '<?= session('id_pinjaman') ?>';
                    $('#editpinjaman-' + idpinjaman).modal('show');
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>


    <?= $this->endSection(); ?>