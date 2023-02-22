<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laman</h1>
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
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th><i class="fas fa-comment"></i></th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= base_url('admin/adhyaksadharmakarini'); ?>">Adhyaksa Dharma Karini</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($adk as $adk) : ?>
                                            <td><?= $adk['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/barbukdanbasan'); ?>">Barbuk dan Basan</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($barbukdanbasan as $barbukdanbasan) : ?>
                                            <td><?= $barbukdanbasan['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/beranda'); ?>">Beranda - Laman Muka</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($beranda as $beranda) : ?>
                                            <td><?= $beranda['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/datun'); ?>">Datun</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($datun as $datun) : ?>
                                            <td><?= $datun['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/intelijen'); ?>">Intelijen</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($intelijen as $intelijen) : ?>
                                            <td><?= $intelijen['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/jadwalsidang'); ?>">Jadwal Sidang</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($jadwalsidang as $jadwalsidang) : ?>
                                            <td><?= $jadwalsidang['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/katasambutan'); ?>">Kata Sambutan</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($katasambutan as $katasambutan) : ?>
                                            <td><?= $katasambutan['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/konsultasihukum'); ?>">Konsultasi Hukum</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($konsultasihukum as $konsultasihukum) : ?>
                                            <td><?= $konsultasihukum['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/kontak'); ?>">Kontak</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($kontak as $kontak) : ?>
                                            <td><?= $kontak['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/pembinaan'); ?>">Pembinaan</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($pembinaan as $pembinaan) : ?>
                                            <td><?= $pembinaan['updated_at']; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/peraturan'); ?>">Peraturan</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($peraturan as $peraturan) : ?>
                                            <td><?= $peraturan['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/pdtu'); ?>">Perdata dan Tata Usaha Negara</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($pdtu as $pdtu) : ?>
                                            <td><?= $pdtu['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/perintahharian'); ?>">Perintah Harian</a></td>
                                        <td>Kejari</td>
                                        <td>-</td>
                                        <?php foreach ($perintahharian as $perintahharian) : ?>
                                            <td><?= $perintahharian['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/pidanakhusus'); ?>">Pidana Khusus</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($pidanakhusus as $pidanakhusus) : ?>
                                            <td><?= $pidanakhusus['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/pidanaumum'); ?>">Pidana Umum</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($pidanaumum as $pidanaumum) : ?>
                                            <td><?= $pidanaumum['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/pidsus'); ?>">Pidsus</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($pidsus as $pidsus) : ?>
                                            <td><?= $pidsus['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/pidum'); ?>">Pidum</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($pidum as $pidum) : ?>
                                            <td><?= $pidum['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/strukturorganisasi'); ?>">Struktur Organisasi</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($strukturorganisasi as $strukturorganisasi) : ?>
                                            <td><?= $strukturorganisasi['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/tentangkejari'); ?>">Tentang Kejari Kab. Pekalongan</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($tentangkejari as $tentangkejari) : ?>
                                            <td><?= $tentangkejari['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('admin/visidanmisi'); ?>">Visi dan Misi</a></td>
                                        <td>Kejari
                                        </td>
                                        <td>-</td>
                                        <?php foreach ($visidanmisi as $visidanmisi) : ?>
                                            <td><?= $visidanmisi['updated_at']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th><i class="fas fa-comment"></i></th>
                                        <th>Tanggal</th>
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