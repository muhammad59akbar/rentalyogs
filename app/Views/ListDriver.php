<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2">List Driver</h2>
    <hr>
    <?= $this->include('AddDriver'); ?>



    <table id="drivermobil" class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">Nama</th>
                <th scope="col">No Telp</th>
                <th scope="col">Nik</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($listDriver as $ndriver) : ?>

                <tr class="text-center">
                    <th><?= $ndriver['nama_driver'] ?></th>
                    <td><?= $ndriver['no_telp'] ?></td>
                    <td><?= $ndriver['nik_driver'] ?></td>
                    <td>
                        <a href="<?= base_url('/DetailDriver/' . url_title($ndriver['nama_driver'], '-')) ?>" class="btn btn-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <?php if (in_groups(['Pengelola Barang'])) : ?>
                            <form class="d-inline" method="post" action="<?= base_url("/DeleteDriver/" . $ndriver['id_driver']) ?>">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data ini ???')"><i class="bi bi-archive-fill"></i></i></button>
                            </form>
                        <?php endif ?>
                    </td>

                </tr>

            <?php endforeach ?>




        </tbody>

    </table>
</div>

<script>
    $(document).ready(function() {
        <?php if (session('errors')) : ?>

            $('#modaldriver').modal('show');

        <?php endif; ?>
    });

    $(document).ready(function() {
        $('#drivermobil').DataTable({
            paging: false,
            "bInfo": false,
        });
    });
</script>

<?= $this->endSection(); ?>