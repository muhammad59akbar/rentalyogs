<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2">Edit User</h2>

    <hr>
    <a href="<?= base_url('/Admin/ListUser') ?>" class="m-2">&laquo; Kembali</a>


    <form action="" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="">
        <input type="hidden" name="fotoOld" value="">

        <div class="container mt-3">
            <div class="d-flex flex-column flex-lg-row mb-3">
                <div class="col-lg-5">

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="email" name="email" required value="">

                </div>
                <div class="col-lg-5 mx-0 mx-lg-5">

                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="">

                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row mb-3 align-items-center ">
                <div class="col-lg-4">
                    <img class="img-thumbnail" src="" alt="" width="250" height="250" id="prevImageKaryawan">

                </div>
                <div class="col-lg-5">
                    <label for="imagekaryawan">Gambar Karyawan</label>
                    <input type="file" class="form-control " id="imagekaryawan" aria-describedby="imagekaryawan" name="imagekaryawan" onchange="changeImage(this, 'prevImageKaryawan')">

                </div>
            </div>
            <div class=" col-lg-5 mb-3">
                <label for="namalengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control " id="namalengkap" aria-describedby="namalengkap" name="namalengkap" value="">

            </div>
            <div class=" col-lg-5 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
                <span class="text-danger" style="font-size: 12px">*Isi Password Jika Diubah</span>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role" id="role">

                </select>



            </div>







            <a href="<?= base_url('/Admin/ListUser') ?>" class="btn btn-secondary ">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>



    </form>
</div>

<?= $this->endSection(); ?>