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
                    <form action="/admin/datun/save" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control <?= ($validation->hasError('judul_datun')) ? 'is-invalid' : ''; ?>" id="judul_datun" name="judul_datun" autofocus value="<?= old('judul_datun'); ?>" placeholder="Masukkan Judul">

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('judul_datun'); ?>
                            </div>
                        </div>

                        <textarea class="form-control <?= ($validation->hasError('isi_datun')) ? 'is-invalid' : ''; ?> editable_inline" id="isi_datun" name="isi_datun">
                            <?= old('isi_datun'); ?>
                        </textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('isi_datun'); ?>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-right"></label>
                            <div class="col-sm-10">
                                <div class="btn-group my-3">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button>

                                    <a href="/admin/datun" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa fa-times"></i> Kembali</a>
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
    function previewImgdatun() {
        const gambar_datun = document.querySelector('#gambar_datun');
        const gambar_datunLabel = document.querySelector('.input-group-text');
        const imgPreview = document.querySelector('.img-preview');

        gambar_datunLabel.textContent = gambar_datun.files[0].name;

        const filegambardatungambar_datun = new FileReader();
        filegambardatungambar_datun.readAsDataURL(gambar_datun.files[0]);

        filegambardatungambar_datun.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script> -->
<script>
    ClassicEditor
        .create(document.querySelector('#isi_datun'), {
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
        .create(document.querySelector('#isi_datun'), {
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