<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kejaksaan Terkini</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="/admin/kejaksaanterkini/create" class="btn btn-primary mb-3">Tambah Info Kejaksaan Terkini</a>
                </div>
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
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
                                        <th>Judul Kejaksaan Terkini</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tb_kejaksaanterkini as $kejaksaanterkini) : ?>
                                        <tr>
                                            <td><?= $kejaksaanterkini['judul_kejaksaanterkini']; ?></td>
                                            <td> <img src="/img_simpan/<?= $kejaksaanterkini['gambar_kejaksaanterkini']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $kejaksaanterkini['tag_kejaksaanterkini']; ?></td>
                                            <td><?= $kejaksaanterkini['updated_at']; ?></td>
                                            <td class="text-center">
                                                <a href="/admin/kejaksaanterkini/detail/<?= $kejaksaanterkini['slug_kejaksaanterkini']; ?>" class="btn btn-warning btn-sm">Detail</a>

                                                <a href="/admin/kejaksaanterkini/edit/<?= $kejaksaanterkini['slug_kejaksaanterkini']; ?>" class="btn btn-secondary btn-sm">Edit</a>

                                                <form action="/admin/kejaksaanterkini/delete/<?= $kejaksaanterkini['id_kejaksaanterkini']; ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>Judul Data Tilang</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
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