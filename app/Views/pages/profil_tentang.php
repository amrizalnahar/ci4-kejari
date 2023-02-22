<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<main>
    <section>
        <div class="container" style="background-color: white; margin-left: 80px;">
            <div class="row">
                <span class="badge" style="background-color: green;">
                    <marquee style=" font-size: 30px; font-family: Georgia, 'Times New Roman', Times, serif;"> SELAMAT DATANG DI WEBSITE KEJAKSAAN NEGERI KABUPATEN PEKALONGAN</marquee>
                </span>
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="margin-left: -10x; margin-right: 0px;">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url(); ?>/assets/img/kantor.jpeg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>KANTOR KEJAKSAAN NEGERI KABUPATEN PEKALONGAN</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url(); ?>/assets/img/kantor.jpeg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url(); ?>/assets/img/kantor.jpeg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="padding-top: 30px;">
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <div class="sidebar" style="background-color: white;">
                            <div class="Slide1">
                                <span class="badge" style="background-color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                        <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z" />
                                    </svg> Pimpinan Kejaksaan Negeri Kabupaten Pekalongan</span>
                                <div class="card" style="margin-top: 15px; margin-bottom: 15px;">
                                    <div class="card-body">
                                        <img src="<?= base_url(); ?>/assets/img/pimpinan.jpg" class="card-img-top" alt="...">
                                        <h5 class="card-title" style="margin-top: 10px;">Abun Hasbullah Syambas, S.H., M.Si</h5>
                                        <p class="card-text">
                                            Deskripsi Singkat
                                        </p>
                                        <a href="#" class="btn btn-primary" style="background-color: green;">Go somewhere</a>
                                    </div>
                                </div>
                                <span class="badge" style="background-color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                        <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                    </svg> Video Kejaksaan Negeri</span>
                            </div>
                            <div class="video" style="margin-top: 10px;">
                                <video width="410" height="240" controls>
                                    <source src="<?= base_url(); ?>/assets/video/vlog.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="Slide2" style="margin-top: 15px;">
                                <span class="badge" style="background-color: green; font-size: 18px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                        <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                        <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                    </svg> Berita Terbaru</span>
                            </div>
                            <div class="card mb-3" style="max-width: 550px; margin-top: 15px;">
                                <div class="row g-1">
                                    <div class="col-md-4" style="margin-top: 15px;">
                                        <img src="<?= base_url(); ?>/assets/img/kantor.jpeg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="" style="color: black">Berita Kecelakaan</h5></a>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-1">
                                    <div class="col-md-4" style="margin-top: 10px;">
                                        <img src="<?= base_url(); ?>/assets/img/kantor.jpeg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8" style="margin-top: -5px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="" style="color: black">Berita Kecelakaan</h5></a>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Slide2" style="margin-top: 15px;">
                                <span class="badge" style="background-color: green; font-size: 18px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                        <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z" />
                                    </svg> Daftar Buronan</span>
                            </div>
                            <div class="foto" style="margin-top: 10px; margin-bottom: 30px;">
                                <img src="<?= base_url(); ?>/assets/img/arif-zaenuri.png" width="410" height="220">
                            </div>
                        </div>
                    </div>
    </section>
</main>


<?= $this->endSection(); ?>