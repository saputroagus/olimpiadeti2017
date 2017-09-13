<!DOCTYPE html>
<html>
<head>

    <title>{{ LAConfigs::getByKey('sitename') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ LAConfigs::getByKey('site_description') }}">
    <meta name='keywords' content='olimpiade ti, 2017, ti, olimpiade, digital, step'/>
    <meta name="author" content="Olimpiade TI 2017">
    <meta name="google-site-verification" content="O8-KV_7a8Kihi6oQ4vfpEnYfjjPPCneV8sVkuRl1lSE" />

    <meta property="og:title" content="{{ LAConfigs::getByKey('sitename') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ LAConfigs::getByKey('site_description') }}" />
        
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/animateModal.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('la-assets/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee|Lato|Nunito" rel="stylesheet">
</head>
<body>  

    

    <div id="login" class="login-bg">
        <div class="wrapper">
            <form method="post" autocomplete="off" action="{{ url('/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <h1>Login</h1>Olimpiade TI 2017
                    </div><br>
                    <div class="col-md-3 col-sm-3 col-ms-5">
                        <input type="email" name="email" maxlength="40" placeholder="Email" required>
                    </div>
                    <div class="col-md-3 col-sm-3 col-ms-5">
                        <input type="password" name="password" maxlength="25" placeholder="Password" required>
                    </div>
                    <div class="col-md-2 col-sm-3 col-ms-2">
                        <input type="submit" class=" upper">
                    </div>  
                    <div class="col-md-2 lg-hide">
                        <a data-scroll href="#online"><i class="light-brown">Belum punya akun? Daftar disini</i></a>
                    </div>
                </div>
            </form>
            <div class="close-login"><h3><i class="lnr lnr-cross-circle"></i></h3></div>
        </div>
    </div>
    
    <div id="animatedModal" class="modals">
        <div class="wrapper">
            <div class="close-animatedModal"> 
                <img class="closebt center" src="{{ asset('la-assets/img/closebt.svg') }}">
            </div>
            <br>
            <div class="row light-brown">
                <div class="col-sm-6">
                    <h3 class="text-center text-uppercase"><b>Pendaftaran ONLINE</b></h3>
                    <hr>
                    <ol>
                        <li>Melakukan Pembayaran sebesar <b>Rp 50.000,-</b> ke rekening BRI <b>0021-01-132012-50-5</b> a.n <b>Rosyidah Amatullah Widodo</b></li>
                        <li>Melakukan konfirmasi pendaftaran dengan mengirimkan sms ke <b>0857-4833-8171</b> dengan format : <b>[nama lengkap / sesuai dengan nama pembayaran di Bank]</b> spasi <b>[email]</b> spasi <b>[asal sekolah]</b></li>
                        <li>Panitia akan memberikan <b>Username</b> dan <b>Password</b> untuk login ke website Olimpiade TI 2017</li>
                        <li>Membuka website Olimpiade TI 2017 - <b>http://www.olimpiadeti.com</b></li>
                        <li>Login dengan username dan password yang telah diberikan</li>
                        <li>Masuk ke pendaftaran dan isi form pendaftaran serta unggah file Kartu Pelajar yang telah discan kemudian cetak bukti pendaftaran. </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <h3 class="text-center text-uppercase"><b>Pendaftaran OFFLINE</b></h3>
                    <hr>
                    <ol>
                        <li>Datang ke Stan Pendaftaran Olimpiade TI 2017 di Program Studi Sistem Informasi Universitas Jember</li>
                        <li>Mengumpulkan berkas persyaratan peserta</li>
                        <li>Mengisi formulir pendaftaran</li>
                        <li>Membayar biaya pendaftaran sebesar <b>Rp 50.000,-</b> ke panitia</li>
                        <li>Mendapat tanda bukti pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <div id="header">    
        <div class="wrapper">
          @if (count($errors) > 0)
        <div class="alert alert-danger">
          <center>  
          <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </center>
        </div>
    @endif
            <div class="row menu">
                <div class="col-sm-3 col-ms-4">
                    <div class="box"><a data-scroll href="#panduan"><span class="lnr lnr-download"></span> Download</a></div>
                </div>
                <div class="col-sm-2 col-sm-offset-5 col-xs-6">
                    <div class="box tright"><a id="register" href="#animatedModal"><span class="lnr lnr-plus-circle"></span> Daftar</a></div>
                </div>
                <div class="col-sm-2">
                    <div class="box tright">
                        @if (Auth::guest())
                            <button class="br-brown open-login upper"><span class="lnr lnr-lock"></span> Login</button>
                        @else
                        <a href="{{ url(config('laraadmin.adminRoute')) }}"><button class="br-brown upper"><span class="lnr lnr-lock"></span> Home</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="divider"></div>
            <div class="divider"></div>
            
            <h5>2017</h5>
            <h1>OLIMPIADE TI</h1>
            <h4>Strengthen Your Brain</h4>  
            <a data-scroll href="#about"><button class="br-brown">Selengkapnya</button></a>
                  
        </div>
    </div>


    <!-- FIXED MENU -->
<!--     <div class="menus row text-uppercase">
        <ul>
            <li><a data-scroll href="#header">Olimpiade TI</a></li>
            <li><a data-scroll href="#online">Alur Pendaftaran</a></li>
            <li><a data-scroll href="#jadwal">Jadwal Kegiatan</a></li>
            <li><a data-scroll href="#panduan">Panduan</a></li>
            <li><a data-scroll href="#kontak">Kontak</a></li>
            @if (Auth::guest())
                <li><a data-scroll href="#login" class="open-login"><button class="br-brown">Login</button></a></li>
            @else
                <li><a href="{{ url(config('laraadmin.adminRoute')) }}"><button class="br-brown">{{ Auth::user()->name }}</button></a></li>
            @endif
        </ul>
    </div> -->

    <!-- ABOUT -->
    <div id="about">
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-4 col-ms-5 sm-hide">
                    <img draggable="false" src="{{ asset('la-assets/img/apeople.png') }}">
                </div>
                <div class="col-sm-7 col-ms-7 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            <h3 class="upper brown"><b>Deskripsi</b> kegiatan<br>Olimpiade <b>TI 2017</b></h3>
                        </div>
                        <div class="col-md-5 col-sm-6 lg-hide">
                            <img draggable="false" src="{{ asset('la-assets/img/aline.png') }}" class="line">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            Olimpiade TI merupakan ajang kompetisi tahunan yang diselenggarakan oleh Badan Eksekutif Mahasiswa (BEM) Program Studi Sistem Informasi Universitas Jember.<br><br>
                            Penyisihan akan dilakukan di 3 region, yaitu Jember, Surabaya, Malang. Final akan dilaksanakan di Universitas Jember.<br><br>
                            <a data-scroll href="#panduan"><button class="br-brown bt-sm">Panduan</button></a>
                            <a id="re2" href="#animatedModal"><button class="br-brown bt-sm">Daftar</button></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JADWAL -->
    <div id="jadwal">
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-4 col-ms-8 col-xs-12">   
                    <button class="br-brown bt-lg disable bolder" disabled=""><h3 class="title">Jadwal <b>Kegiatan<br>Olimpiade TI</b> 2017</h3></button>
                </div>
                <div class="col-sm-8 col-ms-4 xs-hide">
                    <img draggable="false" src="{{ asset('la-assets/img/jline1.png') }}" class="line">
                </div>  
            </div>
            <div class="divider"></div>

            <div class="row text-center">
                <!-- Pendaftaran -->
                <div class="col-sm-4 rel">
                    <h3 class="text-uppercase brown"><b>Pendaftaran</b></h3>
                    <img class="jlineh" src="{{ asset('la-assets/img/jline2.png') }}">
                    <img src="{{ asset('la-assets/img/tgdaftar.png') }}">

                    <div class="row">
                        <div class="col-sm-12 col-ms-6 list">
                            <div class="row text-left">
                                <div class="col-xs-2 icon">
                                    <img src="{{ asset('la-assets/img/computer.png') }}">
                                </div>
                                <div class="col-xs-10">
                                    <h5 class="text-uppercase tbold brown">Online</h5>
                                    <a href="http://www.olimpiadeti.com">http://www.olimpiadeti.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-ms-6 list">
                            <div class="row text-left">
                                <div class="col-xs-2 icon">
                                    <img src="{{ asset('la-assets/img/file.png') }}">
                                </div>
                                <div class="col-xs-10">
                                    <h5 class="text-uppercase tbold brown">Offline</h5>
                                    Program Studi Sistem Informasi Universitas Jember
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <div class="jline"></div>
                </div>


                <!-- Penyisihan -->
                <div class="col-sm-4 rel">
                    <h3 class="text-uppercase brown"><b>Penyisihan</b></h3>
                    <img class="jlineh" src="{{ asset('la-assets/img/jline3.png') }}">
                    <img src="{{ asset('la-assets/img/tgpenyisihan.png') }}">

                    <div class="row"> 
                        <div class="col-sm-12 col-ms-4 list">
                            <div class="row text-left">
                                <div class="col-xs-2 icon">
                                    <img src="{{ asset('la-assets/img/school.png') }}">
                                </div>
                                <div class="col-xs-10">
                                    <h5 class="text-uppercase tbold brown">Jember</h5>
                                    Gedung R. Soengedi Program Studi Sistem Informasi UNEJ
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-ms-4 list">
                            <div class="row text-left">
                                <div class="col-xs-2 icon">
                                    <img src="{{ asset('la-assets/img/school.png') }}">
                                </div>
                                <div class="col-xs-10">
                                    <h5 class="text-uppercase tbold brown">Malang</h5>
                                    SMAN 4 Malang<br>
                                    <i class="red">Jl. Tugu No.1, Kiduldalem, Klojen, Kota Malang</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-ms-4 list">
                            <div class="row text-left">
                                <div class="col-xs-2 icon">
                                    <img src="{{ asset('la-assets/img/school.png') }}">
                                </div>
                                <div class="col-xs-10">
                                    <h5 class="text-uppercase tbold brown">Surabaya</h5>
                                    SMA Al Irsyad<br>
                                    <i class="red">Jl. Sultan Iskandar Muda no. 46, Ujung</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jline"></div>
                </div>

                <!-- Final -->
                <div class="col-sm-4">
                    <h3 class="text-uppercase brown"><b>Final</b></h3>
                    <img class="jlineh" src="{{ asset('la-assets/img/jline4.png') }}">
                    <img src="{{ asset('la-assets/img/tgfinal.png') }}">

                    <div class="row text-left list">
                        <div class="col-xs-2 icon">
                            <img src="{{ asset('la-assets/img/school-2.png') }}">
                        </div>
                        <div class="col-xs-10">
                            <h5 class="text-uppercase tbold brown">Jember</h5>
                            Gedung Mas Soerachman Universitas Jember<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- REWARD -->
    <div id="reward">
        <div class="wrapper upper">
            <div class="row">
                <div class="col-sm-6 col-ms-10 col-sm-offset-6 col-xs-offset-1">
                    <h3 class="tcenter white upper"><b>Ayo Daftar</b></h3>
                    <div class="row">
                        <!--div class="col-sm-4 col-ms-4 col-xs-6 list">
                            <h4 class="upper white"><b>Juara 1</b></h4>
                            RP 3.000.000,-<br>
                            Trophy<br>
                            Sertifikat
                            <span class="separator"></span>
                        </div>
                        <div class="col-ms-4 col-sm-4 col-xs-6 list">
                            <h4 class="upper white"><b>Juara 2</b></h4>
                            RP 2.000.000,-<br>
                            Trophy<br>
                            Sertifikat
                            <span class="separator"></span>
                        </div>
                        <div class="col-ms-4 col-sm-4 col-xs-12">
                            <h4 class="upper white"><b>Juara 3</b></h4>
                            RP 1.000.000,-<br>
                            Trophy<br>
                            Sertifikat
                        </div-->
                    </div>

                    <br>
                    <h4 class="tcenter"><b>Tunggu apalagi, ayo daftar sekarang!</b></h4><br>    
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="https://bit.ly/soal-olim"><button class="yellow bt-lg right"><h3 class="title"><b>Soal</b></h3></button></a>
                        </div>
                        <div class="col-xs-6">
                            <a data-scroll href="#panduan"><button class="yellow bt-lg"><h3 class="title"><b>Panduan</b></h3></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- ALUR ONLINE -->
    <div id="online">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-ms-6 md-hide">
                    <img draggable="false" src="{{ asset('la-assets/img/alurline.png') }}" class="line">
                </div>  
                <div class="col-md-4 col-sm-6 col-ms-6 col-xs-12">  
                    <button class="br-brown bt-lg disable bolder" disabled=""><h3 class="title">Alur <b>Pendaftaran<br>Olimpiade TI</b> 2017</h3></button>
                </div>
            </div>
            <div class="sdivider"></div>
            <img draggable="false" src="{{ asset('la-assets/img/online.png') }}" class="center line">
        </div>
    </div>

    <!-- ALUR OFFLINE -->
    <div id="offline">
        <div class="wrapper">
            <center>
                <img draggable="false" src="{{ asset('la-assets/img/offlinet.png') }}" class="center">
                <div class="sdivider"></div>
                <img draggable="false" src="{{ asset('la-assets/img/offline.png') }}" class="center">
            </center>
        </div>
    </div>

    <!-- Panduan -->
    <div id="panduan" class="brown">
        <div class="wrapper">
            <div class="row">
                <div class="col-ms-2 col-sm-2 sm-hide">
                    <img draggable="false" src="{{ asset('la-assets/img/paper.png') }}" class="line">
                </div>  
                <div class="col-ms-10 col-sm-10">   
                    <div class="row">
                        <div class="col-xs-9">
                            <h2 class="upper"><b>Panduan</b> Peserta</h2>
                        </div>
                        <div class="col-xs-3">
                            <a target="_blank" href="https://bit.ly/panduan-olim"><button class="br-brown bold right"><span class="lnr lnr-download sm-show"></span> <span class="sm-hide">Download</span></button></a>
                        </div>
                    </div>
                    <h4>Download panduan peserta Olimpiade TI 2017. File berisi informasi kegiatan Olimpiade TI 2017 mulai dari ketentuan peserta, jadwal pelaksanaan kegiatan, alur pendaftaran, dan kontak panitia Olimpiade TI 2017</h4>
                </div>

            </div>
        </div>
    </div>

    <!-- Sponsor dan Media Partner -->
    <div id="sponsor">
        <div class="wrapper">
            <img draggable="false" src="{{ asset('la-assets/img/medpart.jpg') }}" class="line">
        </div>
    </div>

    <!-- Kontak -->
    <div id="kontak">
        <div class="wrapper">
            <h2 class="upper"><b>Kontak</b></h2><br>
            <div class="row">
                <div class="col-ms-6 col-sm-6">
                    
                    <form method="post" autocomplete="off" action="#">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="nama" maxlength="20" placeholder="Nama" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="email" maxlength="50" placeholder="Email/No. Telp." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea name="pesan" maxlength="200" placeholder="Pesan" required=""></textarea>
                            </div>
                        </div>
                        <input type="submit" name="kirimBtn" value="kirim" class="bt-lg upper">
                    </form>
                </div>  
                <div class="col-ms-6 col-sm-6"> 
                    <ul class="kontak">
                        <li><span class="lnr lnr-apartment"></span> PS. Sistem Informasi Universitas Jember</li>
                        <li><span class="lnr lnr-map-marker"></span> Jl. Kalimantan no. 37, Jember 68121</li>
                        <li><a href="https://www.facebook.com/profile.php?id=370628093098908&fref=ts"><span class="lnr lnr-earth"></span> Olimpiade TI 2017</a></li>
                        
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer" class="brown">
        <div class="wrapper">
            <div class="upper tcenter"><b>Copyright &copy; Olimpiade TI 2017 - All Rights Reserved<b></div>         
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('la-assets/js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('la-assets/js/animatedModal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('la-assets/js/smooth-scroll.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".close-login").click(function(){
                $(".login-bg").slideToggle();
            });
            $(".open-login").click(function(){
                $(".login-bg").slideToggle();
            });
            $("#register, #re2").animatedModal();
            smoothScroll.init();

            // FIXED MENU ON SCROLL
            $('.menus').addClass('original').clone().insertAfter('.menus').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

            scrollIntervalID = setInterval(stickIt, 10);


            function stickIt() {

              var orgElementPos = $('.original').offset();
              orgElementTop = orgElementPos.top;               

              if ($(window).scrollTop() >= (orgElementTop)) {
                // scrolled past the original position; now only show the cloned, sticky element.

                // Cloned element should always have same left position and width as original element.     
                orgElement = $('.original');
                coordsOrgElement = orgElement.offset();
                leftOrgElement = coordsOrgElement.left;  
                widthOrgElement = orgElement.css('width');
                $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
                $('.original').css('visibility','hidden');
              } else {
                // not scrolled past the menu; only show the original menu.
                $('.cloned').hide();
                $('.original').css('visibility','visible');
              }
            }


        });
    </script>
</body>
</html>