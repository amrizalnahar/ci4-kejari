<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="content">
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
                <div class="col-lg-12">
                    <form action="/admin/adhyaksadharmakarini/save" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control <?= ($validation->hasError('judul_adk')) ? 'is-invalid' : ''; ?>" id="judul_adk" name="judul_adk" autofocus value="<?= old('judul_adk'); ?>" placeholder="Masukkan Judul">

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('judul_adk'); ?>
                            </div>
                        </div>

                        <textarea class="form-control <?= ($validation->hasError('isi_adk')) ? 'is-invalid' : ''; ?> editable_inline" id="isi_adk" name="isi_adk">
                            <?= old('isi_adk'); ?>
                        </textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('isi_adk'); ?>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-right"></label>
                            <div class="col-sm-10">
                                <div class="btn-group my-3">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button>

                                    <a href="/admin/adhyaksadharmakarini" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa fa-times"></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.col -->

            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<!-- <script>
    function previewImgAdk() {
        const gambar_adk = document.querySelector('#gambar_adk');
        const gambar_adkLabel = document.querySelector('.input-group-text');
        const imgPreview = document.querySelector('.img-preview');

        gambar_adkLabel.textContent = gambar_adk.files[0].name;

        const filegambaradkgambar_adk = new FileReader();
        filegambaradkgambar_adk.readAsDataURL(gambar_adk.files[0]);

        filegambaradkgambar_adk.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script> -->
<script>
    ClassicEditor
        .create(document.querySelector('#isi_adk'), {
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
</script>



<?= $this->endSection() ?>

<!-- <script>
    ClassicEditor
        .create(document.querySelector('#isi_adk'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote'],
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
                    }
                ]
            }
        }).then(editor => {
            console.log(editor);
        }).catch(error => {
            console.log(error);
        });
</script> -->