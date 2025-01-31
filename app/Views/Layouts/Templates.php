<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Me.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-light  fixed-top" style="background-color: #929292;">
        <button class="navbar-toggler"
            type="button"
            data - toggle="collapse"
            data - target="#navbarNav"
            aria - controls="navbarNav"
            aria - expanded="false"
            aria - label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span> </button>
        <div class="d-flex justify-content-between w-100 align-items-center">

            <h4 class="mt-2 mx-3 ">
                <a class="navbar-brand" href="<?= base_url('/') ?>"> PT.Rentales </a>
            </h4>
            <h6 class="p-2 mt-1 font-weight-light"> Logged as: <span class="font-weight-bold"> <?= user()->fullname; ?> </span></h6>
        </div>

    </nav>

    <div class="sidebar"
        id="sidebar"
        style="z-index: 100;"
        class="text-white">
        <div class="p-3">

            <ul class="nav flex-column mt-5 mt-lg-0">
                <li class="nav-item border-bottom border-white">
                    <a class="nav-link text-white"
                        href="<?= base_url('/') ?>"> Dashboard </a>
                </li>
                <?php if (in_groups(['Admin'])) : ?>
                    <li class="nav-item border-bottom border-white">
                        <a class="nav-link text-white"
                            href="<?= base_url('/Admin/ListUser') ?>"> List User </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item border-bottom border-white">
                    <a class="nav-link text-white"
                        href="<?= base_url('/ListMobil') ?>"> List Mobil </a>
                </li>

                <li class="nav-item border-bottom border-white">
                    <a class="nav-link text-white"
                        href="<?= base_url('/ListPinjaman') ?>"> List Pinjaman </a>
                </li>


                <li class="nav-item border-bottom border-white">
                    <a class="nav-link text-white"
                        href="<?= base_url('logout') ?>"> Logout </a>
                </li>
            </ul>
        </div>
    </div>

    <?= $this->renderSection('content'); ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ListPinjaman').DataTable({
                paging: false,
                "bInfo": false,

                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'copyHtml5',
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },


                        ],

                    }
                },

            });
        });
        $(document).ready(function() {
            $('.navbar-toggler').click(function() {
                $('#sidebar').toggleClass('active');
                $('#mainContent').toggleClass('active-content');
            });
        });
    </script>

</body>

</html>