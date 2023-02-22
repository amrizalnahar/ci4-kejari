<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- <div class="col-sm-6">
                    <h1>galeri Detail</h1>
                    </div> -->
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">Fixed Navbar Layout</li>
                    </ol>
                </div> -->
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->

                    <!-- POS BERITA -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Pos Berita</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Judul Berita</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($berita as $berita) : ?>
                                        <tr>
                                            <td><?= $berita['judul_berita']; ?></td>
                                            <td><img src="/img_simpan/<?= $berita['gambar_berita']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $berita['tag_berita']; ?></td>
                                            <td><?= $berita['updated_at']; ?></td>
                                            <td><a href="/admin/berita/detail/<?= $berita['slug_berita']; ?>" class="btn btn-warning btn-sm">Detail</a>

                                                <a href="/admin/berita/edit/<?= $berita['slug_berita']; ?>" class="btn btn-secondary btn-sm">Edit</a>

                                                <form action="/admin/berita/delete/<?= $berita['id_berita']; ?>" method="post" class="d-inline">
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
                                        <th>Judul Berita</th>
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

                    <!-- DATA TILANG -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <strong>Data Tilang</strong>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Judul Data Tilang</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datatilang as $datatilang) : ?>
                                        <tr>
                                            <td><?= $datatilang['judul_datatilang']; ?></td>
                                            <td><img src="/img_simpan/<?= $datatilang['gambar_datatilang']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $datatilang['tag_datatilang']; ?></td>
                                            <td><?= $datatilang['updated_at']; ?></td>
                                            <td><a href="/admin/datatilang/detail/<?= $datatilang['slug_datatilang']; ?>" class="btn btn-warning btn-sm">Detail</a>

                                                <a href="/admin/datatilang/edit/<?= $datatilang['slug_datatilang']; ?>" class="btn btn-secondary btn-sm">Edit</a>

                                                <form action="/admin/datatilang/delete/<?= $datatilang['id_datatilang']; ?>" method="post" class="d-inline">
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

                    <!-- EVENT KEJAKSAAN -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Event Kejaksaan</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Judul Event Kejaksaan</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($eventkejaksaan as $eventkejaksaan) : ?>
                                        <tr>
                                            <td><?= $eventkejaksaan['judul_eventkejaksaan']; ?></td>
                                            <td><img src="/img_simpan/<?= $eventkejaksaan['gambar_eventkejaksaan']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $eventkejaksaan['tag_eventkejaksaan']; ?></td>
                                            <td><?= $eventkejaksaan['updated_at']; ?></td>
                                            <td><a href="/admin/eventkejaksaan/detail/<?= $eventkejaksaan['slug_eventkejaksaan']; ?>" class="btn btn-warning btn-sm">Detail</a>

                                                <a href="/admin/eventkejaksaan/edit/<?= $eventkejaksaan['slug_eventkejaksaan']; ?>" class="btn btn-secondary btn-sm">Edit</a>

                                                <form action="/admin/eventkejaksaan/delete/<?= $eventkejaksaan['id_eventkejaksaan']; ?>" method="post" class="d-inline">
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
                                        <th>Judul Event Kejaksaan</th>
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

                    <!-- GALERI FOTO -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Galeri</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Judul Galeri</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($galeri as $galeri) : ?>
                                        <tr>
                                            <td><?= $galeri['judul_galeri']; ?></td>
                                            <td><img src="/img_simpan/<?= $galeri['gambar_galeri']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $galeri['tag_galeri']; ?></td>
                                            <td><?= $galeri['updated_at']; ?></td>
                                            <td><a href="/admin/galeri/detail/<?= $galeri['slug_galeri']; ?>" class="btn btn-warning btn-sm">Detail</a>

                                                <a href="/admin/galeri/edit/<?= $galeri['slug_galeri']; ?>" class="btn btn-secondary btn-sm">Edit</a>

                                                <form action="/admin/galeri/delete/<?= $galeri['id_galeri']; ?>" method="post" class="d-inline">
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
                                        <th>Judul Galeri</th>
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

                    <!-- KEJAKSAAN TERKINI -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Kejaksaan Terkini</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>

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
                                    <?php foreach ($kejaksaanterkini as $kejaksaanterkini) : ?>
                                        <tr>
                                            <td><?= $kejaksaanterkini['judul_kejaksaanterkini']; ?></td>
                                            <td><img src="/img_simpan/<?= $kejaksaanterkini['gambar_kejaksaanterkini']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $kejaksaanterkini['tag_kejaksaanterkini']; ?></td>
                                            <td><?= $kejaksaanterkini['updated_at']; ?></td>
                                            <td><a href="/admin/kejaksaanterkini/detail/<?= $kejaksaanterkini['slug_kejaksaanterkini']; ?>" class="btn btn-warning btn-sm">Detail</a>

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
                                        <th>Judul Kejaksaan Terkini</th>
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

                    <!-- TAK BERKATEGORI-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Tak Berkategori</strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Judul Data Tak Berkategori</th>
                                        <th>Gambar</th>
                                        <th>Tag</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($takberkategori as $takberkategori) : ?>
                                        <tr>
                                            <td><?= $takberkategori['judul_takberkategori']; ?></td>
                                            <td><img src="/img_simpan/<?= $takberkategori['gambar_takberkategori']; ?>" alt="" class="img-fluid" width="150px">
                                            </td>
                                            <td><?= $takberkategori['tag_takberkategori']; ?></td>
                                            <td><?= $takberkategori['updated_at']; ?></td>
                                            <td><a href="/admin/takberkategori/detail/<?= $takberkategori['slug_takberkategori']; ?>" class="btn btn-warning btn-sm">Detail</a>

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
                                        <th>Judul Data Tak Berkategori</th>
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
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?= $this->endSection(); ?>