<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title; ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/admin/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/admin/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Plugin -->
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/admin/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href=".<?= base_url(); ?>/css/admin/responsive.bootstrap4.min.css">
    <!-- CkEditor -->
    <script src="<?= base_url(); ?>/vendor/ckeditor5/ckeditor.js"></script>
    <script src="<?= base_url(); ?>/vendor/ckfinder/ckfinder.js"></script>
    <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key={0ca6043d2ffa4034bb994b}"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('layout/topbar_admin'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('layout/sidebar_admin'); ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <?= $this->renderSection('content'); ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">

        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y'); ?> Kejari Kab. Pekalongan</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->



    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>/plugins/admin/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url(); ?>/plugins/admin/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?= base_url(); ?>/js/admin/adminlte.js"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="<?= base_url(); ?>/plugins/admin/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>/js/admin/demo.js"></script>
    <script src="<?= base_url(); ?>/js/admin/pages/dashboard3.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url(); ?>/plugins/admin/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/admin/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/admin/datatables-responsive/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/admin/datatables-responsive/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <!-- <script>
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                ckfinder: {
                    uploadUrl: 'http://localhost:8080/kejari/public/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'outdent', 'indent', '|', 'insertTable', 'mediaEmbed', '|', 'undo', 'redo', ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                    ]
                },
                language: 'id'
            })
            .catch(error => {
                console.error(error);
            });
    </script> -->
    <!-- Script CK Editor 5 -->
    <?= $this->renderSection('script') ?>
    <script>
        function previewImgBrt() {
            const gambar_berita = document.querySelector('#gambar_berita');
            const gambar_beritaLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            gambar_beritaLabel.textContent = gambar_berita.files[0].name;

            const filegambarberitagambar_berita = new FileReader();
            filegambarberitagambar_berita.readAsDataURL(gambar_berita.files[0]);

            filegambarberitagambar_berita.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        function previewImg2() {
            const gambar_datatilang = document.querySelector('#gambar_datatilang');
            const gambar_datatilangLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            gambar_datatilangLabel.textContent = gambar_datatilang.files[0].name;

            const filegambardatatilanggambar_datatilang = new FileReader();
            filegambardatatilanggambar_datatilang.readAsDataURL(gambar_datatilang.files[0]);

            filegambardatatilanggambar_datatilang.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        function previewImg3() {
            const gambar_eventkejaksaan = document.querySelector('#gambar_eventkejaksaan');
            const gambar_eventkejaksaanLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            gambar_eventkejaksaanLabel.textContent = gambar_eventkejaksaan.files[0].name;

            const filegambareengambar_eventkejaksaan = new FileReader();
            filegambareengambar_eventkejaksaan.readAsDataURL(gambar_eventkejaksaan.files[0]);

            filegambareengambar_eventkejaksaan.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        function previewImg4() {
            const gambar_galeri = document.querySelector('#gambar_galeri');
            const gambar_galeriLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            gambar_galeriLabel.textContent = gambar_galeri.files[0].name;

            const filegambargalerigambar_galeri = new FileReader();
            filegambargalerigambar_galeri.readAsDataURL(gambar_galeri.files[0]);

            filegambargalerigambar_galeri.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        function previewImg5() {
            const gambar_kejaksaanterkini = document.querySelector('#gambar_kejaksaanterkini');
            const gambar_kejaksaanterkiniLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            gambar_kejaksaanterkiniLabel.textContent = gambar_kejaksaanterkini.files[0].name;

            const filegambarkejaksaangambar_kejaksaanterkini = new FileReader();
            filegambarkejaksaangambar_kejaksaanterkini.readAsDataURL(gambar_kejaksaanterkini.files[0]);

            filegambarkejaksaangambar_kejaksaanterkini.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        function previewImg6() {
            const gambar_takberkategori = document.querySelector('#gambar_takberkategori');
            const gambar_takberkategoriLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            gambar_takberkategoriLabel.textContent = gambar_takberkategori.files[0].name;

            const filegambartakbergambar_takberkategori = new FileReader();
            filegambartakbergambar_takberkategori.readAsDataURL(gambar_takberkategori.files[0]);

            filegambartakbergambar_takberkategori.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

</body>

</html>