<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalus">
    <i class="bi bi-person-add"></i> New Driver
</button>

<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success mt-2" role="alert">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="modalus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/Admin/AddUser') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="d-flex flex-column">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" aria-describedby="nama" name="nama">

                    </div>
                    <div class="d-flex flex-column">
                        <label for="notelp" class="form-label">No Telp</label>
                        <input type="text" class="form-control" id="notelp" aria-describedby="notelp" name="notelp">

                    </div>
                    <div class="d-flex flex-column">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" aria-describedby="nik" name="nik">

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