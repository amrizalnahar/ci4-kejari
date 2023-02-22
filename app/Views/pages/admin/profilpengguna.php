<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header ">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profil Pengguna</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="content container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h4>Nama</h4>
                <form>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label" value="">Nama Pengguna</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nama Panggilan*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="">
                        </div>
                    </div>
                    <h4>Info Kontak</h4>
                    <form>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email*</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Situs Web</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="url">
                            </div>
                        </div>
                        <h4>Tentang Anda</h4>
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Info Biografi</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" cols="50" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Foto Profil</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="url">
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword3">
                            </div>
                        </div> -->

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                            </div>
                        </form>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>




<?= $this->endSection(); ?>