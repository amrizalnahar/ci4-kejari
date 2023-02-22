<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengguna</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary ">Tambah Baru</button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Pengguna</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peranan</th>
                                        <th>Pos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?= $user['username']; ?></td>
                                            <td><?= $user['fullname']; ?>
                                            </td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['name']; ?></td>
                                            <td><?= $user['name']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>Nama Pengguna</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peranan</th>
                                        <th>Pos</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




<?= $this->endSection(); ?>