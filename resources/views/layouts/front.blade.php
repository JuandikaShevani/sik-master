<!DOCTYPE html>
<html lang="en">

<head>
    <title>Academics &mdash; Website by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('Template/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Template/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('Template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Template/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Template/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Template/css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Template/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('Template/fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('Template/css/aos.css') }}">
    <link href="{{ asset('Template/css/jquery.mb.YTPlayer.min.css') }}" media="all" rel="stylesheet"
        type="text/css">

    <link rel="stylesheet" href="{{ asset('Template/css/style.css') }}">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <div class="py-2 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 d-none d-lg-block">
                        <span class="small mr-3"><span class="icon-phone2 mr-2"></span> +62{{ $setting->no_hp }}</span>
                        <span class="small mr-3"><span class="icon-envelope-o mr-2"></span>
                            {{ $setting->email }}</span>
                    </div>
                    <div class="col-lg-3 text-right">
                        <a href="{{ route('login') }}" class="small btn btn-primary px-4 py-2 rounded-0"><span
                                class="icon-unlock-alt"></span> Log In</a>
                    </div>
                </div>
            </div>
        </div>
        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="site-logo">
                        <a href="{{ route('landing_page') }}" class="d-block">
                            <img src="{{ Storage::disk('public')->url($setting->path_image) }}" alt="Image"
                                class="img-fluid" width="50">
                        </a>
                    </div>
                    <div class="ml-auto">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li>
                                    <a href="javascript:void(0);" class="nav-link text-left"
                                        onclick="scrollToSection('homeSection')">Home</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="nav-link text-left"
                                        onclick="scrollToSection('fiturSection')">Fitur</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="nav-link text-left"
                                        onclick="scrollToSection('profileSection')">Profile</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </header>


        <div id="homeSection" class="hero-slide owl-carousel site-blocks-cover">
            <div class="intro-section" style="background-image: url('{{ asset('img/bg-landpage.jpg') }}');">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                            <h1>{{ $setting->nama_aplikasi }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div></div>

        <div id="fiturSection" class="site-section">
            <div class="container">
                <div class="row mb-5 justify-content-center text-center">
                    <div class="col-lg-4 mb-5">
                        <h2 class="section-title-underline mb-5">
                            <span>Fitur {{ $setting->nama_aplikasi }}</span>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="feature-1 border">
                            <div class="icon-wrapper bg-primary">
                                <i class="fa-solid fa-file-pdf fa-3x" style="color: white; margin-left: 25px;"></i>
                            </div>
                            <div class="feature-1-content">
                                <h2>Export PDF</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="feature-1 border">
                            <div class="icon-wrapper bg-primary">
                                <i class="fa-solid fa-file-csv fa-3x" style="color: white; margin-left: 25px;"></i>
                            </div>
                            <div class="feature-1-content">
                                <h2>Export Excel</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="feature-1 border">
                            <div class="icon-wrapper bg-primary">
                                <i class="fa-solid fa-chart-pie fa-3x ml-3" style="color: white"></i>
                            </div>
                            <div class="feature-1-content">
                                <h2>Grafik Data</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="feature-1 border">
                            <div class="icon-wrapper bg-primary">
                                <i class="fa-solid fa-rocket fa-3x ml-3 mt-1" style="color: white"></i>
                            </div>
                            <div class="feature-1-content">
                                <h2>Fast CRUD</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="profileSection" class="section-bg style-1"
            style="background-image: url('{{ asset('img/jumbotron-bg.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="section-title-underline style-2">
                            <span>{{ $setting->nama_aplikasi }}</span>
                        </h2>
                    </div>
                    <div class="col-lg-8">
                        <p class="lead">{{ $setting->nama_aplikasi }} adalah sebuah Sistem Informasi yang
                            dirancang untuk mengolah data kependudukan. Dengan sistem ini, pengolahan data terkait
                            kependudukan menjadi lebih efisien dan akurat.</p>
                        <p>Sistem informasi ini dilengkapi dengan berbagai fitur yang memungkinkan dilakukannya
                            pengumpulan, penyimpanan, dan pelaporan data kependudukan. Salah satu keunggulan
                            {{ $setting->nama_aplikasi }} adalah kemampuannya dalam menangani data dalam jumlah besar.
                            Secara keseluruhan, {{ $setting->nama_aplikasi }} menyederhanakan proses pemrosesan data,
                            dan menjadikannya alat penting untuk mengelola data populasi secara efektif.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- // 05 - Block -->
        {{-- <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-4">
                        <h2 class="section-title-underline">
                            <span>Testimonials</span>
                        </h2>
                    </div>
                </div>


                <div class="owl-slide owl-carousel">

                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Designer</span>
                            </div>
                        </div>
                        <div>
                            <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia.
                                Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis,
                                provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
                        </div>
                    </div>

                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Designer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus
                                mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident
                                numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>

                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Designer</span>
                            </div>
                        </div>
                        <div>
                            <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia.
                                Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis,
                                provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
                        </div>
                    </div>

                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Designer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus
                                mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident
                                numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>

                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Designer</span>
                            </div>
                        </div>
                        <div>
                            <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia.
                                Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis,
                                provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
                        </div>
                    </div>

                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Designer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus
                                mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident
                                numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>

                </div>

            </div>
        </div> --}}

        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <img src="{{ Storage::disk('public')->url($setting->path_image_bg) }}" alt="Image"
                            class="img-fluid">
                    </div>
                    <div class="col-lg-5 ml-auto align-self-center">
                        <h2 class="section-title-underline mb-5">
                            <span>Profile</span>
                        </h2>
                        <p>{{ $setting->profil }}</p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                        <img src="{{ Storage::disk('public')->url($setting->path_image_bg2) }}" alt="Image"
                            class="img-fluid">
                    </div>
                    <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                        <h2 class="section-title-underline mb-5">
                            <span>Master Data</span>
                        </h2>
                        <ol class="ul-check primary list-unstyled">
                            <li>Data Kartu Keluarga</li>
                            <li>Data Penduduk Domisili</li>
                            <li>Data Kelahiran</li>
                            <li>Data Kematian</li>
                            <li>Data Pendatang</li>
                            <li>Data Pindah</li>
                            <li>Data Penduduk Tidak Mampu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | {{ $setting->nama_aplikasi }}
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- .site-wrap -->


    <!-- loader -->
    {{-- <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#51be78" />
        </svg></div> --}}

    <script src="{{ asset('Template/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('Template/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('Template/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('Template/js/popper.min.js') }}"></script>
    <script src="{{ asset('Template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Template/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('Template/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('Template/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('Template/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('Template/js/aos.js') }}"></script>
    <script src="{{ asset('Template/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('Template/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('Template/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ asset('Template/js/main.js') }}"></script>

    <script>
        function scrollToSection(sectionId) {
            var targetElement = document.getElementById(sectionId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    </script>

</body>

</html>
