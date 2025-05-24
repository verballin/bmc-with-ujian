<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="google-translate-customization" content="9f841e7780177523-3214ceb76f765f38-gc38c6fe6f9d06436-c">
    </meta>

    <title>Bimbel Mora College</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="brem/img/icon bmc.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="brem/lib/animate/animate.min.css" rel="stylesheet">
    <link href="brem/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="brem/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="brem/css/style.css" rel="stylesheet">
   
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <p class="m-0 fw-bold" style="font-size: 25px;"><img src="brem/img/icon bmc.png" alt="" height="50px"><span
                    style="color: #fb873f;"></span></p>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
            <?php
            $session=session();
            $isLoggedIn = $session->get('login') === true;
            ?>
            <div class="nav-item dropdown">
                <?php if ($isLoggedIn) { ?>
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown"><i class="fa fa-user"></i></a>
                    <div class="dropdown-menu fade-down m-0">
                        <?php if (session()->get('role') === 'Admin') : ?>
                        <a href="<?= site_url('kelolauser') ?>" class="dropdown-item">Kelola User</a>    
                        <a href="<?= site_url('inputproduk') ?>" class="dropdown-item">Input Produk</a>   
                        <?php endif; ?>
                        <a href="<?= site_url('historipembelian') ?>" class="dropdown-item">Histori Pembelian</a>
                        <form action="<?= site_url('/logout') ?>" method="post" style="display: inline;">
                        <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                <?php } else { ?>
                    <a href="<?= site_url('login') ?>" class="nav-item nav-link"><i class="fa fa-user"></i></a>
                <?php } ?>
            </div>

                <a href="<?= base_url()?>" class="nav-item nav-link">Beranda</a>
                <a href="<?= site_url('about') ?>" class="nav-item nav-link">Tentang</a>
                <a href="<?= site_url('courses') ?>" class="nav-item nav-link">Kursus</a>
                <div class="nav-item dropdown">
                <?php if($isLoggedIn) { ?>
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown">Simulasi</a>
                        <div class="dropdown-menu fade-down m-0">
                            <?php if (session()->get('role') === 'Admin') : ?>
                            <a href="<?= site_url('infopengaturanujian') ?>" class="dropdown-item">Pengaturan Ujian</a>
                            <a href="<?= site_url('tambahsoal') ?>" class="dropdown-item">Tambah Soal Ujian</a>
                            <a href="<?= site_url('daftarsoal') ?>" class="dropdown-item">Lihat Daftar Soal Ujian</a>
                            <?php endif; ?>
                            <a href="<?= site_url('ujian') ?>" class="dropdown-item">Pilih Ujian</a>   
                        </div>
                    <?php } ?>
                </div>
                <a href="<?= site_url('contact') ?>" class="nav-item nav-link">Kontak</a>
     
                </div>
                

                <div id="google_translate_element">
                </div>


                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-4">
    <?php if (session()->getFlashdata('pesan')): ?> <?= session()->getFlashdata('pesan') ?><?php endif; ?>
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="brem/img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class=" text-uppercase mb-3 animated slideInDown" style="color: #fb873f;">Best
                                    Platform pembelajaran elektronik terbaik</h5>
                                <h1 class="display-3 text-white animated slideInDown">Bimbingan Belajar di Mora College: Terbukti Sukses dalam Ujian CPNS & Akademik.</h1>
                                <p class=" text-white mb-4 pb-2">Jelajahi berbagai kursus yang dirancang untuk meningkatkan keahlian Anda dalam teknologi, bisnis, seni, dan banyak lagi. Mulailah belajar hari ini!</p>
                                <a href="<?= site_url('about') ?>"
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Baca selengkapnya</a>
                                <a href="<?= site_url('signup') ?>" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Bergabunglah
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="brem/img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class=" text-uppercase mb-3 animated slideInDown" style="color: #fb873f;">Selamat Datang di Bimbel Mora College</h5>
                                <h1 class="display-3 text-white animated slideInDown">Panduan ahli untuk masa depan cerah!
                                </h1>
                                <p class=" text-white mb-4 pb-2">Ikuti pelajaran interaktif, kuis, dan proyek. Rasakan pembelajaran langsung yang membuat Anda termotivasi dan terinspirasi.</p>
                                <a href="<?= site_url('about') ?>"
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Baca selengkapnya</a>
                                <a href="<?= site_url('signup') ?>" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Bergabunglah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-2 text-center">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 style="color: #fb873f;">Investasikan dalam tujuan profesional Anda bersama BMC</h1>
                    <p class="mb-5">Dapatkan akses tak terbatas ke lebih dari 90% kursus, Proyek, Spesialisasi, dan Sertifikat Profesional di BMC, yang diajarkan oleh instruktur top.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3 shadow">
                        <div class="p-4">
                            <img src="brem/img/icon1.png" alt="" width="60px" class="mb-4">
                            <h5 class="mb-3">Belajar apa saja</h5>
                            <p>Jelajahi minat atau topik terkini, ambil prasyarat, dan tingkatkan keterampilan Anda</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3 shadow">
                        <div class="p-4">
                            <img src="brem/img/icon2.png" alt="" width="60px" class="mb-4">
                            <h5 class="mb-3">Hemat Biaya</h5>
                            <p>Hemat lebih banyak untuk pembelajaran Anda jika berencana mengikuti banyak kursus tahun ini</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3 shadow">
                        <div class="p-4">
                            <img src="brem/img/icon3.png" alt="" width="60px" class="mb-4">
                            <h5 class="mb-3">Pembelajaran fleksibel</h5>
                            <p>Belajar sesuai dengan kemampun Anda sendiri, berpindah antar kursus, atau beralih ke kursus lain
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3 shadow">
                        <div class="p-4">
                            <img src="brem/img/icon4.png" alt="" width="60px" class="mb-4">
                            <h5 class="mb-3">Sertifikat tanpa batas</h5>
                            <p>Dapatkan sertifikat untuk setiap program pembelajaran yang Anda selesaikan tanpa biaya tambahan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="brem/img/about.jpg" alt=""
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start pe-3">Tentang Kami</h6>
                    <h1 class="mb-4" style="color: #fb873f;">Selamat Datang di BMC</h1>
                    <p class="mb-4">Di BMC, kami percaya pada pengalaman belajar yang mudah diakses dan inovatif
                    yang menyesuaikan dengan jadwal serta gaya belajar Anda. Bergabunglah bersama kami dalam merangkul
                    masa depan pendidikan dan buka potensi Anda melalui kursus online yang mendalam.</p>
                    <p class="mb-4"> Selamat datang di BMC, gerbang Anda menuju peluang belajar tanpa batas. Kami
                    berdedikasi untuk mendemokratisasi pendidikan, menawarkan beragam kursus yang diajarkan oleh para
                    ahli industri. Misi kami adalah memberdayakan pelajar di seluruh dunia, membangun platform berbasis
                    komunitas di mana pengetahuan tidak mengenal batas.</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right  me-2"></i>Instruktur Ahli</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2"></i>Sesi Interaktif Langsung</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2"></i>Katalog Kursus Lengkap</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2"></i>Keterlibatan Komunitas</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2"></i>Jalur Belajar yang Dipersonalisasi</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2"></i>Sertifikasi dan Pengakuan</p>
                        </div>
                    </div>
                    <a class="btn text-light py-3 px-5 mt-2" href="<?= site_url('about') ?>">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




    <!-- Banner-1 Start -->
    <div class="container-xxl py-5 pt-5 bg-light">
        <div class="container">
            <div class="row g-5 ">
                <div class="col-lg-6 p-5 wow fadeInUp" data-wow-delay="0.3s">

                    <h1 class="mb-4" style="color: #fb873f;">Jelajahi Kursus Gratis</h1>
                    <p class="mb-4">Mulailah perjalanan belajar onlinemu di Great Learning Academy secara gratis dengan kursus dasar jangka pendek di berbagai bidang yang banyak diminati.</p>

                    <a class="btn text-light py-3 px-5 mt-2" href="<?= site_url('signup') ?>">Mulai Gratis</a>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="brem/img/banner-1.jpg" alt=""
                            style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner-1 End -->



    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center px-3">Jelajahi Kursus Gratis</h6>
                <h1 class="mb-5" style="color: #fb873f;">Mulailah perjalanan belajar onlinemu di BMC Mora College secara gratis dengan kursus dasar jangka pendek di berbagai bidang yang banyak diminati.</h1>
                <a class="btn text-light py-3 px-5 mt-2" href="<?= site_url('signup') ?>">Mulai Gratis</a>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="brem/img/banner-1.jpg" alt=""
                        style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->



    <!-- FAQ Start  -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
                <h1 class="mb-5">Pertanyaan yang Sering Diajukan</h1>
            </div>
            <div class="row g-2">
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apa itu BMC?
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                BMC adalah sebuah inisiatif yang menawarkan kursus online terbaik dalam teknologi terkini dan telah berhasil mendaftarkan lebih dari 100+ pelajar di berbagai bidang. BMC mencakup kursus CPNS, TOEFL, SNBT, Psikotes, dan masih banyak lagi!
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Mengapa saya harus memilih BMC untuk kursus gratis bersertifikat?
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                BMC adalah pilihan yang sangat baik untuk kursus dengan sertifikat karena kualitas konten pembelajarannya yang tinggi. Kursus-kursus tersebut dirancang dengan baik, menawarkan pengalaman belajar yang luar biasa, serta interaktif dan menarik, sehingga sangat cocok bagi pelajar dalam menentukan jalur karier mereka.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Berapa banyak kursus gratis yang bisa saya ikuti sekaligus?
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Anda dapat mengikuti beberapa kursus secara bersamaan di BMC.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Bagaimana cara mendaftar kursus online gratis ini?
                              </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                Anda dapat mengklik tombol “Daftar” pada halaman dan mendaftar menggunakan alamat email dan nama Anda.
                                </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Apa saja kursus paling populer yang ditawarkan oleh BMC?
                              </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                BMC berfokus pada konsep dan keterampilan yang paling diminati, membantu pelajar mengembangkan pengetahuan yang relevan dengan industri pilihan mereka.

                                <p>Beberapa kursus gratis paling populer dari BMC yang banyak diminati saat ini antara lain:</p>
                                <ul>
                                    <li>Kursus CPNS</li>
                                    <li>Kursus TOEFL</li>
                                    <li>Kursus SNBT</li>
                                    <li>Kursus Kedinasan</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End  -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Tautan Cepat</h4>
                    <p><a class="text-light" href="<?= site_url('about') ?>">Tentang Kami</a></p>
                    <p><a class="text-light" href="<?= site_url('contact') ?>">Hubungi Kami</a></p>
                    <p><a class="text-light" href="<?= site_url('courses') ?>">Kursus</a></p>

                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Kontak</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Jalan Farrel Pasaribu, Simpang GG. Rambutan Daerah, Jl. Lapangan Sepak Bola, Kec. Siantar Marihat, Kota Pematang Siantar, Sumatera Utara 21121</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0821-6329-9216</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>kursuonline.moracollege@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://x.com/CollegeMora"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/moracollege/"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="brem/lib/wow/wow.min.js"></script>
    <script src="brem/lib/easing/easing.min.js"></script>
    <script src="brem/lib/waypoints/waypoints.min.js"></script>
    <script src="brem/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="brem/js/main.js"></script>
    <script>
    window.setTimeout(function(){
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
        });
    },1500);
    </script>
</body>

</html>