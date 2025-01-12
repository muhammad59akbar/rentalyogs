<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">


    <div class="row mt-3">
        <div class="col-md-3 mb-4">

            <div class="card shadow-sm text-center text-white" style="min-height: 200px; background:#d13f3f;">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-person-fill fs-1 "></i>
                    <div class="ms-3">
                        <h1 class="card-title mb-1 fs-5">Total Users</h1>
                        <p class="mb-0 fs-5">1 Orang</p>
                    </div>

                </div>
            </div>

        </div>


        <div class="col-md-3 mb-4">
            <div class="card shadow-sm text-center text-white" style="min-height: 200px; background: #2762e1;">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-bar-chart-line-fill fs-1"></i>

                    <div class="ms-3">
                        <h1 class="card-title mb-1 fs-5">Total Pinjaman</h1>

                        <p class="mb-0 fs-5">10 Pinjaman</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm text-center text-white" style="min-height: 200px; background: #44ec12;">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-clipboard-check-fill fs-1"></i>

                    <div class="ms-3">
                        <h1 class="card-title mb-1 fs-5">Pinjaman Selesai</h1>

                        <p class="mb-0 fs-5">8 Selesai</p>
                    </div>

                </div>
            </div>
        </div>



    </div>


</div>

<?= $this->endSection(); ?>