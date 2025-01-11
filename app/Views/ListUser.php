<?= $this->extend('Layouts/Templates'); ?>
<?= $this->section('content'); ?>
<div class="main-content mt-5" id="mainContent">
    <h2 class="mt-2">List User</h2>
    <hr>
    <?= $this->include('AddUser'); ?>



    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col border-2">No</th>
                <th scope="col">Email</th>
                <th scope="col">Nama</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>

            <?php foreach ($userrental as $user) : ?>


                <tr class="text-center">
                    <th><?= $no++ ?></th>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td><?= $user['roles'] ?></td>
                    <td>
                        <a href="<?= base_url('/Admin/DetailUser/' . url_title($user['fullname'], '-', true)); ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <form class="d-inline" method="post" action="<?= base_url('/Admin//DeleteUser/' . $user['id']) ?>">

                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus Pengguna ini ???')"><i class="bi bi-archive-fill"></i></button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>


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