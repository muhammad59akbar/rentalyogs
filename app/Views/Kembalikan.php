<?php if ($pinjaman['status'] === 'Belum Dikembalikan') : ?>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kembalikanModal-<?= $pinjaman['id_pinjaman'] ?>">
        <i class="bi bi-pencil-square"></i>
    </button>
<?php endif ?>


<!-- Modal -->
<div class="modal" id="kembalikanModal-<?= $pinjaman['id_pinjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kembalikan Mobil</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formproduk" action="<?= base_url('/KembalikanMobil') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <input type="hidden" name="id_pinjaman" value="<?= $pinjaman['id_pinjaman'] ?>" required>
                <input type="hidden" name="id_mobil" value="<?= $pinjaman['id_mobil'] ?>" required>
                <input type="hidden" name="id_user" value="<?= user()->id ?>" required>

                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <label for="npinjam" class="form-label text-start">Nama Peminjam</label>
                        <input type="text" class="form-control" id="npinjam" aria-describedby="npinjam" name="npinjam" value="<?= $pinjaman['fullname'] ?>" disabled>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="merkmobil" class="form-label text-start">Merk Mobil</label>
                        <input type="text" class="form-control" id="merkmobil" aria-describedby="merkmobil" name="merkmobil" value="<?= $pinjaman['merk_mobil'] ?>" disabled>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="no_stnk" class="form-label text-start">No STNK</label>
                        <input type="text" class="form-control" id="no_stnk" aria-describedby="no_stnk" name="no_stnk" value="<?= $pinjaman['no_stnk'] ?>" disabled>

                    </div>
                    <div class="d-flex flex-column">
                        <label for="no_plat" class="form-label text-start">No Plat</label>
                        <input type="text" class="form-control" id="no_plat" aria-describedby="no_plat" name="no_plat" value="<?= $pinjaman['no_plat'] ?>" disabled>

                    </div>
                    <div class="d-flex flex-column">
                        <label for="status" class="form-label text-start">Status</label>
                        <input type="text" class="form-control" id="status" aria-describedby="status" name="status" value="<?= $pinjaman['status'] ?>" disabled>
                    </div>








                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kembalikan</button>
                </div>
            </form>

        </div>
    </div>
</div>