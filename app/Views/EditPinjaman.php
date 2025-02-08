<button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#editpinjaman-<?= $lp['id_pinjaman'] ?>">
    <i class="bi bi-pencil-square"></i>
</button>

<!-- Modal -->
<div class="modal" id="editpinjaman-<?= $lp['id_pinjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pinjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formproduk" action="<?= base_url('/EditPinjaman/' . $lp['id_pinjaman']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" id="id_pinjaman" aria-describedby="id_pinjaman" name="id_pinjaman" value="<?= $lp['id_pinjaman'] ?>">
                    <input type="hidden" id="old_driver" aria-describedby="old_driver" name="old_driver" value="<?= $lp['i_driver'] ?>">
                    <input type="hidden" id="old_mobil" aria-describedby="old_mobil" name="old_mobil" value="<?= $lp['id_mobil'] ?>">
                    <div class="d-flex flex-column mb-2">
                        <label for="npinjam" class="form-label">Nama Peminjam</label>
                        <input type="text" class="form-control <?= session('errors.npinjam') ? 'is-invalid' : '' ?>" id="npinjam" aria-describedby="npinjam" name="npinjam" value="<?= $lp['namapeminjam'] ?>" disabled>
                        <div class="invalid-feedback">
                            <?= session('errors.npinjam') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <label class="form-label">Nama Driver</label>
                        <select class="form-select <?= session('errors.n_driver') ? 'is-invalid' : '' ?>" aria-label="Default select example" name="n_driver" <?= empty($listDriver) ? 'disabled' : ''; ?>>

                            <option value="<?= $lp['i_driver'] ?>" selected><?= $lp['nama_driver'] ?></option>

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
                            <option value="<?= $lp['id_mobil'] ?>"><?= $lp['merk_mobil'] . ' - ' . $lp['no_plat'] ?></option>
                            <?php foreach ($listMobil as $m) : ?>
                                <option value="<?= $m['id_mobil'] ?>"><?= $m['merk_mobil'] . ' - ' . $m['no_plat'] ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>

                    <div class="d-flex flex-column">
                        <label for="tgl_pnjm" class="form-label ">Tanggal Pinjaman</label>
                        <input type="date" class="form-control <?= session('errors.tgl_pnjm') ? 'is-invalid' : '' ?>" id="tgl_pnjm" aria-describedby="tgl_pnjm" value="<?= isset($lp['tanggal_pinjaman']) ? date('Y-m-d', strtotime($lp['tanggal_pinjaman'])) : '' ?>" name="tgl_pnjm" placeholder="dd/mm/yyyy">
                        <div class="invalid-feedback">
                            <?= session('errors.tgl_pnjm') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <label for="tgl_kmbli" class="form-label  <?= session('errors.tgl_kmbli') ? 'is-invalid' : '' ?>">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tgl_kmbli" aria-describedby="tgl_kmbli" name="tgl_kmbli" placeholder="dd/mm/yyyy" value="<?= isset($lp['tanggal_kembali']) ? date('Y-m-d', strtotime($lp['tanggal_kembali'])) : '' ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.tgl_kmbli') ?>
                        </div>

                    </div>
                    <div class="d-flex flex-column mb-2">
                        <label for="jmput" class="form-label">Titik Penjemputan</label>
                        <input type="text" class="form-control <?= session('errors.jmput') ? 'is-invalid' : '' ?>" id="jmput" aria-describedby="jmput" name="jmput" value="<?= $lp['penjemputan'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.jmput') ?>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label for="tjuan" class="form-label">Titik Tujuan</label>
                        <input type="text" class="form-control <?= session('errors.tjuan') ? 'is-invalid' : '' ?>" id="tjuan" aria-describedby="tjuan" name="tjuan" value="<?= $lp['tujuan'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.tjuan') ?>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Pinjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>