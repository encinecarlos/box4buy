<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Box4Buy</title>
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Global Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/careers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
</head>
<body id="page-top">
    <!--====================================================
                       LOGIN E REGISTRO
    ======================================================-->
    <section id="login">
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" align="center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="fa fa-times" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div id="div-forms">
                   
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====================================================
                             HOME
    ======================================================-->
    <section id="home">
        <div id="carousel" class="carousel slide carousel-fade-2" data-ride="carousel">
            <!-- Carousel items -->
            <div class="carousel-inner-2">
                <div class="carousel-item-2 active slides">
                    <div class="overlay"></div>
                    <div class="slide-1"></div>
                    <div class="hero ">                        
                        <hgroup class="wow fadeInUp">
                            <h1 style="margin: 0 auto">
                                Cadastro realizado com <span class="wrap">sucesso</span> 
                                {{-- Cadastro realizado com <span>
                                    <a href="" class="typewrite" data-period="2000" data-type='[ "Sucesso"]'>
                                        <span class="wrap"></span>
                                    </a>
                                </span>                                 --}}
                            </h1>
                            <h5 class="corWhite" style="margin-top: 30px">Enviamos um E-mail com as informações de acesso a sua conta. Verifique sua caixa de spam.</h5><br />
                        </hgroup>
                        <a href="/" class="btn btn-general buttonPrimary wow fadeInUp">Voltar ao site</a>
                        <br><br><br>
                        <img class="wow fadeInUp" src="img/logo-s.png" width="200px" height="44px" alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====================================================
                          FOOTER
    ======================================================-->
    <footer>
        <div id="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="footer-copyrights">
                            <p>Copyrights &copy; {{ date('Y') }} All Rights Reserved by <strong><a href="https://devhousesolutions.com.br/">DevHouse Solutions</a></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#page-top" id="back-to-top" class="btn btn-sm btn-green btn-back-to-top smooth-scrolls hidden-sm hidden-xs" title="home" role="button">
            <i class="fa fa-angle-up"></i>
        </a>
    </footer>
    <!--Global JavaScript -->
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/wow/wow.min.js') }}"></script>
    <script src="{{ asset('js/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
