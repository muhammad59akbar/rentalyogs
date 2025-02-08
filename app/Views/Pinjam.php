<button type="button" class="btn btn-primary <?= in_groups('User') ? 'w-100' : '' ?>" data-toggle="modal" data-target="#orderModal-<?= $mbl['id_mobil'] ?>">
    <i class="bi bi-briefcase-fill"></i>
</button>


<!-- Modal -->
<div class="modal" id="orderModal-<?= $mbl['id_mobil'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pinjam Mobil</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formproduk" action="<?= base_url('/PinjamMobil') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_mobil" value="<?= $mbl['id_mobil'] ?>">
                <input type="hidden" name="id_user" value="<?= user()->id ?>">

                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <label for="merkmobil" class="form-label">Merk Mobil</label>
                        <input type="text" class="form-control" id="merkmobil" aria-describedby="merkmobil" name="merkmobil" value="<?= $mbl['merk_mobil'] ?>" disabled>
                    </div>

                    <!-- tambahan NIK, No telp,  -->
                    <div class="d-flex flex-column">
                        <label for="nikdrive" class="form-label ">Nik Driver</label>
                        <input type="text" class="form-control <?= session('errors.nikdrive') ? 'is-invalid' : '' ?>" id="nikdrive" aria-describedby="nikdrive" name="nikdrive" placeholder="Nik Driver" maxlength="16" pattern="\d*" value="<?= old('nikdrive') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.nikdrive') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="ndriver" class="form-label ">Nama Driver</label>
                        <input type="text" class="form-control <?= session('errors.ndriver') ? 'is-invalid' : '' ?>" id="ndriver" aria-describedby="ndriver" name="ndriver" placeholder="Nama Driver" value="<?= old('ndriver') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.ndriver') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="no_telp" class="form-label ">No Telp Driver</label>
                        <input type="text" class="form-control <?= session('errors.no_telp') ? 'is-invalid' : '' ?>" id="no_telp" aria-describedby="no_telp" name="no_telp" placeholder="No Telp Driver" value="<?= old('no_telp') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.no_telp') ?>
                        </div>
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
                        <input type="date" class="form-control <?= session('errors.tgl_kembalikan') ? 'is-invalid' : '' ?>" id="tgl_kembalikan" aria-describedby="tgl_kembalikan" name="tgl_kembalikan" value="<?= old('tgl_kembalikan') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.tgl_kembalikan') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="tgl_kembalikan" class="form-label ">Tujuan</label>
                        <input type="text" class="form-control <?= session('errors.tujuan') ? 'is-invalid' : '' ?>" id="tujuan" aria-describedby="tgl_kembalikan" name="tujuan" value="<?= old('tujuan') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.tujuan') ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="jemput" class="form-label ">Titik Penjemputan</label>
                        <input type="text" class="form-control <?= session('errors.jemput') ? 'is-invalid' : '' ?>" id="jemput" aria-describedby="jemput" name="jemput" value="<?= old('jemput') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.jemput') ?>
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