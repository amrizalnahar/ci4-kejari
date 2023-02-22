<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Tak Berkategori</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="/admin/takberkategori/create" class="btn btn-primary mb-3">Tambah Data</a>
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
                                        <th>Judul Tak Berkategori</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tb_takberkategori as $takberkategori) : ?>
                                        <tr>
                                            <td><?= $takberkategori['judul_takberkategori']; ?></td>
                                            <td> <img src="/img_simpan/<?= $takberkategori['gambar_takberkategori']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $takberkategori['tag_takberkategori']; ?></td>
                                            <td><?= $takberkategori['updated_at']; ?></td>
                                            <td class="text-center">
                                                <a href="/admin/takberkategori/detail/<?= $takberkategori['slug_takberkategori']; ?>" class="btn btn-warning btn-sm">Detail</a>

                                                <a href="/admin/takberkategori/edit/<?= $takberkategori['slug_takberkategori']; ?>" class="btn btn-secondary btn-sm">Edit</a>

                                                <form action="/admin/takberkategori/delete/<?= $takberkategori['id_takberkategori']; ?>" method="post" class="d-inline">
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
                                        <th>Judul Tak Berkategori</th>
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