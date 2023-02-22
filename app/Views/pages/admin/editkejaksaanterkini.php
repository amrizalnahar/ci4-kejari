<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="content">
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Kejaksaan Terkini</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="/admin/kejaksaanterkini/update/<?= $kejaksaanterkini['id_kejaksaanterkini']; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="slug_kejaksaanterkini" value="<?= $kejaksaanterkini['slug_kejaksaanterkini']; ?>">
                        <input type="hidden" name="gambar_kejaksaanterkiniLama" value="<?= $kejaksaanterkini['gambar_kejaksaanterkini']; ?>">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control <?= ($validation->hasError('judul_kejaksaanterkini')) ? 'is-invalid' : ''; ?>" id="judul_kejaksaanterkini" name="judul_kejaksaanterkini" autofocus value="<?= (old('judul_kejaksaanterkini')) ? old('judul_kejaksaanterkini') : $kejaksaanterkini['judul_kejaksaanterkini'] ?>" placeholder="Masukkan Judul">

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('judul_kejaksaanterkini'); ?>
                            </div>
                        </div>

                        <div class="inputgroup mb-3">
                            <div class="col-sm-2">
                                <img src="/img_simpan/<?= $kejaksaanterkini['gambar_kejaksaanterkini']; ?>" class="img-thumbnail img-preview">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control <?= ($validation->hasError('gambar_kejaksaanterkini')) ? 'is-invalid' : ''; ?>" id="gambar_kejaksaanterkini" name="gambar_kejaksaanterkini" onchange="previewImg5()">
                            <label class="input-group-text myPreviewgambar" for="gambar_kejaksaanterkini"><?= $kejaksaanterkini['gambar_kejaksaanterkini']; ?></label>

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('gambar_kejaksaanterkini'); ?>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="tag_kejaksaanterkini" id="tag_kejaksaanterkini" class="form-control" placeholder="Masukkan Tag ..." value=" <?= (old('tag_kejaksaanterkini')) ? old('tag_kejaksaanterkini') : $kejaksaanterkini['tag_kejaksaanterkini'] ?>">
                        </div>

                        <textarea class="form-control <?= ($validation->hasError('isi_kejaksaanterkini')) ? 'is-invalid' : ''; ?> editable_inline" id="isi_kejaksaanterkini" name="isi_kejaksaanterkini">
                        <?= (old('isi_kejaksaanterkini')) ? old('isi_kejaksaanterkini') : $kejaksaanterkini['isi_kejaksaanterkini'] ?>
                        </textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('isi_kejaksaanterkini'); ?>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-right"></label>
                            <div class="col-sm-10">
                                <div class="btn-group my-3">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button>

                                    <a href="/admin/kejaksaanterkini" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa fa-times"></i> Kembali</a>
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
    ClassicEditor
        .create(document.querySelector('#isi_kejaksaanterkini'), {
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
<script>
    ClassicEditor
        .create(document.querySelector('#isi_kejaksaanterkini'), {
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