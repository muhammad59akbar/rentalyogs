<?php if (in_groups('Pengelola Barang')) : ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaldriver">
        <i class="bi bi-person-add"></i> Tambah Driver
    </button>
<?php endif ?>

<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success mt-2" role="alert">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="modaldriver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/addDriver') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="d-flex flex-column">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" aria-describedby="nama" name="nama" placeholder="example: Ujang" value="<?= old('nama') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>

                    </div>
                    <div class="d-flex flex-column">
                        <label for="notelp" class="form-label">No Telp</label>
                        <input type="text" class="form-control <?= session('errors.notelp') ? 'is-invalid' : '' ?>" id="notelp" aria-describedby="notelp" name="notelp" placeholder="08xxxxx / 021xxxx" value="<?= old('notelp') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.notelp') ?>
                        </div>

                    </div>
                    <div class="d-flex flex-column">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>" id="nik" aria-describedby="nik" name="nik" placeholder="3171xxxxxx" value="<?= old('nik') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.nik') ?>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>