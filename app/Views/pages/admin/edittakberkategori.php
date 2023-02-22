<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="content">
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="/admin/takberkategori/update/<?= $takberkategori['id_takberkategori']; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="slug_takberkategori" value="<?= $takberkategori['slug_takberkategori']; ?>">
                        <input type="hidden" name="gambar_takberkategoriLama" value="<?= $takberkategori['gambar_takberkategori']; ?>">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control <?= ($validation->hasError('judul_takberkategori')) ? 'is-invalid' : ''; ?>" id="judul_takberkategori" name="judul_takberkategori" autofocus value="<?= (old('judul_takberkategori')) ? old('judul_takberkategori') : $takberkategori['judul_takberkategori'] ?>" placeholder="Masukkan Judul">

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('judul_takberkategori'); ?>
                            </div>
                        </div>

                        <div class="inputgroup mb-3">
                            <div class="col-sm-2">
                                <img src="/img_simpan/<?= $takberkategori['gambar_takberkategori']; ?>" class="img-thumbnail img-preview">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control <?= ($validation->hasError('gambar_takberkategori')) ? 'is-invalid' : ''; ?>" id="gambar_takberkategori" name="gambar_takberkategori" onchange="previewImg6()">
                            <label class="input-group-text myPreviewgambar" for="gambar_takberkategori"><?= $takberkategori['gambar_takberkategori']; ?></label>

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('gambar_takberkategori'); ?>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="tag_takberkategori" id="tag_takberkategori" class="form-control" placeholder="Masukkan Tag ..." value=" <?= (old('tag_takberkategori')) ? old('tag_takberkategori') : $takberkategori['tag_takberkategori'] ?>">
                        </div>

                        <textarea class="form-control <?= ($validation->hasError('isi_takberkategori')) ? 'is-invalid' : ''; ?> editable_inline" id="isi_takberkategori" name="isi_takberkategori">
                        <?= (old('isi_takberkategori')) ? old('isi_takberkategori') : $takberkategori['isi_takberkategori'] ?>
                        </textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('isi_takberkategori'); ?>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-right"></label>
                            <div class="col-sm-10">
                                <div class="btn-group my-3">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button>

                                    <a href="/admin/takberkategori" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa fa-times"></i> Kembali</a>
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
        .create(document.querySelector('#isi_takberkategori'), {
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
        .create(document.querySelector('#isi_takberkategori'), {
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