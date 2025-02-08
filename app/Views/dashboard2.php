<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">

    <div class="row mt-3 titleku">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm text-center text-white" style="min-height: 200px; background:#e1c827;">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-car-front-fill fs-1"></i>
                    <div class="ms-3">
                        <h1 class="card-title mb-1 fs-5">Total Mobil</h1>
                        <p class="mb-0 fs-5"><?= $totalMobil ?> Mobil</p>
                    </div>

                </div>
            </div>


        </div>








        <div class="col-md-3 mb-4">
            <div class="card shadow-sm text-center text-white" style="min-height: 200px; background: #2762e1;">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-bar-chart-line-fill fs-1"></i>

                    <div class="ms-3">
                        <h1 class="card-title mb-1 fs-5">Pinjaman Disetujui</h1>

                        <p class="mb-0 fs-5"><?= $totalPinjaman ?> Pinjaman</p>
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

                        <p class="mb-0 fs-5"><?= $pinjamanSelesai ?> Selesai</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="keterangan">
            <h2>Keterangan</h2>

            <ul>

                <li>Disetujui</li>

            </ul>
        </div>

        <div id='calendar'></div>
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>




    </div>




</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                <?php
                $today = date('Y-m-d');
                foreach ($prosesPinjaman as $pinjaman): ?> {



                        title: "<?= $pinjaman['namapeminjam']; ?>",
                        start: "<?= $pinjaman['tanggal_pinjaman']; ?>",
                        backgroundColor: "<?= ($pinjaman['status'] === 'Pending') ? '#ffdf13' : (($pinjaman['status'] === 'Belum Dikembalikan') ? '#137bff' : (($pinjaman['status'] === 'Selesai') ? '#00ff3a' : '#ff0000')); ?>",

                        extendedProps: {
                            merk_mobil: "<?= $pinjaman['merk_mobil']; ?>",
                            no_plat: "<?= $pinjaman['no_plat']; ?>",
                            titik_penjemputan: "<?= $pinjaman['penjemputan'] ?>",
                            titik_tujuan: "<?= $pinjaman['tujuan'] ?>"

                        },
                        description: "Nama: <?= $pinjaman['nama_driver']; ?> Merk Mobil: <?= $pinjaman['merk_mobil']; ?> No Plat: <?= $pinjaman['no_plat']; ?>"
                    },
                    {
                        title: "<?= $pinjaman['namapeminjam']; ?>",
                        start: "<?= $pinjaman['tanggal_kembali']; ?>",
                        backgroundColor: "<?= ($pinjaman['status'] === 'Pending') ? '#ffdf13' : (($pinjaman['status'] === 'Belum Dikembalikan') ? '#137bff' : (($pinjaman['status'] === 'Selesai') ? '#00ff3a' : '#ff0000')); ?>",
                        extendedProps: {
                            merk_mobil: "<?= $pinjaman['merk_mobil']; ?>",
                            no_plat: "<?= $pinjaman['no_plat']; ?>",
                            titik_penjemputan: "<?= $pinjaman['penjemputan'] ?>",
                            titik_tujuan: "<?= $pinjaman['tujuan'] ?>"
                        },
                        description: "Nama: <?= $pinjaman['nama_driver']; ?> Merk Mobil: <?= $pinjaman['merk_mobil']; ?> No Plat: <?= $pinjaman['no_plat']; ?> Titik Penjemputan: <?= $pinjaman['penjemputan']; ?> Titik Tujuan: <?= $pinjaman['tujuan']; ?>"
                    },
                <?php endforeach; ?>
            ],
            displayEventTime: false,
            eventClick: function(info) {

                var title = info.event.title;
                var merkMobil = info.event.extendedProps.merk_mobil;
                var noPlat = info.event.extendedProps.no_plat;
                var titik_penjemputan = info.event.extendedProps.titik_penjemputan;
                var titik_tujuan = info.event.extendedProps.titik_tujuan;
                var modalContent = `
                <h5>${title}</h5>
                <p>Merk Mobil: ${merkMobil}</p>
                <p>Titik Penjemputan: ${titik_penjemputan}</p>
                <p>Titik Tujuan: ${titik_tujuan}</p>
                <p>No Plat: ${noPlat}</p>
            `;
                document.getElementById('modal-body').innerHTML = modalContent;
                var modal = new bootstrap.Modal(document.getElementById('eventModal'));
                modal.show();
            }
        });

        calendar.render();
    });
</script>


<?= $this->endSection(); ?>