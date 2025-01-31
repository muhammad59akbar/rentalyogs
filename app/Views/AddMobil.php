<!-- Button trigger modal -->
<?php if (in_groups('Admin')) : ?>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#mobilsModal">
        <i class="bi bi-file-earmark-plus-fill"></i> Tambah Mobil
    </button>

<?php endif ?>


<!-- Modal -->
<div class="modal" id="mobilsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formproduk" action="<?= base_url('/AddNewMobil') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <label for="merkmobil" class="form-label">Merk Mobil</label>
                        <input type="text" class="form-control  <?= session('errors.merkmobil') ? 'is-invalid' : '' ?>" id="merkmobil" aria-describedby="merkmobil" name="merkmobil" required placeholder="Example Toyota">
                        <div class="invalid-feedback">
                            <?= session('errors.merkmobil') ?>
                        </div>
                    </div>
                    <div class="mb-2 ">
                        <label for="warnambl" class="form-label">Warna Mobil</label>
                        <input class="form-control  <?= session('errors.warnambl') ? 'is-invalid' : '' ?>" type="text" id="warnambl" name="warnambl" placeholder="Example Hitam">
                        <div class="invalid-feedback">
                            <?= session('errors.warnambl') ?>
                        </div>
                    </div>
                    <div class="my-2">
                        <img class="img-thumbnail" src="<?= base_url('assets/images/addimage.png') ?>" alt="" width="250" height="250" id="prevImage">

                    </div>
                    <div class="mb-2 ">
                        <label for="gmbr_mbl" class="form-label">Gambar Mobil</label>
                        <input class="form-control  <?= session('errors.gmbr_mbl') ? 'is-invalid' : '' ?>" type="file" id="gmbr_mbl" name="gmbr_mbl" onchange="changeImage(this, 'prevImage')">
                        <div class="invalid-feedback">
                            <?= session('errors.gmbr_mbl') ?>
                        </div>
                    </div>
                    <div class="mb-2 ">
                        <label for="noplat" class="form-label">No Plat</label>
                        <input class="form-control  <?= session('errors.noplat') ? 'is-invalid' : '' ?>" type="text" id="noplat" name="noplat" placeholder="Example B 13245 ASD">
                        <div class="invalid-feedback">
                            <?= session('errors.noplat') ?>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>