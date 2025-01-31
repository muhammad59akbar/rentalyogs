<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2">List Driver</h2>
    <hr>
    <?= $this->include('AddDriver'); ?>



    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col border-2">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Nik</th>
                <th scope="col">No Telp</th>

            </tr>
        </thead>
        <tbody>





            <tr class="text-center">
                <th>adsasd</th>
                <td>asdasd</td>
                <td>asdads</td>
                <td>asdads</td>

            </tr>




        </tbody>

    </table>
</div>

<script>
    $(document).ready(function() {
        <?php if (session('errors')) : ?>

            $('#modalus').modal('show');

        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>