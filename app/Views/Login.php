<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login SIPADA</title>
</head>
<style>
    body {
        background: url('assets/images/backgroundlogin.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .footer {
        padding: 1.98rem;
        margin-top: auto;
        background: #ffffff;
    }
</style>

<body>
    <div class="container d-flex justify-content-center justify-content-lg-between align-items-center flex-wrap min-vh-100">
        <div class="col-lg-4 bg-body p-4 border border-2 rounded-2 mt-2">
            <h5>SIPADA</h5>
            <p style="text-align: justify;">Sistem Informasi Penggunaan Kendaraan Dinas adalah sebuah website yang mengatur jadwal penggunaan kendaraan agar tidak terjadi tumpang tindih, serta memastikan ketersediaan kendaraan sesuai kebutuhan operasional serta menghasilkan laporan dan analisis atas penggunaan kendaraan dinas operasional di Sekretariat DPRD Provinsi DKI Jakarta</p>
        </div>
        <div class=" col-lg-4 border border-2 rounded-2 shadow-lg bg-body p-4 mt-5">
            <div class="d-flex justify-content-center" style="height: 140px;">
                <img src=" <?= base_url('assets/images/sipadalogo.jpg') ?>" alt="sipada" style="width: 190px; height:100%">
            </div>

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <?php if ($config->validFields === ['email']) : ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="email" placeholder="email" name="login">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>

                <?php else : ?>



                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="username" placeholder="Username" name="login">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" placeholder="Password">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <div class="footer  w-100 text-center text-lg-start">
        <div class="row justify-content-evenly">
            <div class="col-lg-3">
                <h5>Hubungi Kami</h5>
                <p>Jln. kebon Sirih No.18, Jakarta Pusat <br>
                    Telp/Fax : 021-3808701</p>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold" style="font-size: 15px; font-weight:700">&copy; 2025 Sekretariat DPRD Daerah Khusus Jakarta</h5>
                <p class="m-0">Bagian Umum </p>
                <p> Subbag Perlengkapan</p>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>