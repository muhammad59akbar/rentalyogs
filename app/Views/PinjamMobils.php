<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pinjamMobil">
    <i class="bi bi-file-earmark-plus-fill"></i> Tambah Pinjaman
</button>



<!-- Modal -->
<div class="modal" id="pinjamMobil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pinjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formproduk" action="<?= base_url('/PinjamMobil') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="d-flex flex-column mb-3">
                        <label class="form-label">Nama Driver</label>


                        <select class="form-select <?= session('errors.n_driver') ? 'is-invalid' : '' ?>" aria-label="Default select example" name="n_driver" <?= empty($listDriver) ? 'disabled' : ''; ?>>


                            <?php foreach ($listDriver as $d) : ?>
                                <option value="<?= $d['id_driver'] ?>"><?= $d['nama_driver'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors.n_driver') ?>
                        </div>

                    </div>
                    <div class="mb-2 ">
                        <label class="form-label">Merk Mobil</label>
                        <select class="form-select " aria-label="Default select example" name="merkmobil" <?= empty($listMobil) ? 'disabled' : ''; ?>>
                            <?php foreach ($listMobil as $m) : ?>
                                <option value="<?= $m['id_mobil'] ?>"><?= $m['merk_mobil'] . ' - ' . $m['no_plat'] ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>

                    <div class="d-flex flex-column">
                        <label for="tgl_pjm" class="form-label ">Tanggal Pinjaman</label>
                        <input type="date" class="form-control <?= session('errors.tgl_pjm') ? 'is-invalid' : '' ?>" id="tgl_pjm" aria-describedby="tgl_pjm" value="<?= old('tgl_pjm') ?>" name="tgl_pjm">
                        <div class="invalid-feedback">
                            <?= session('errors.tgl_pjm') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="tgl_kembalikan" class="form-label ">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tgl_kembalikan" aria-describedby="tgl_kembalikan" name="tgl_kembalikan">
                        <div class="invalid-feedback">
                            <?= session('errors.tgl_kembalikan') ?>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Pinjam</button>
                </div>
            </form>
        </div>
    </div>
</div>