<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Serviço de redirecionamento de encomendas. Do mundo até vc">
    <meta name="author" content="Box4buy">
    <meta property="og:url" content="https://box4buy.com">
    <meta property="og:type" conntent="website">
    <meta property="og:title" conntent="Serviço de redirecionamento de encomendas">
    <meta property="og:description" conntent="Cadastre-sem gratuitamente e receba seu endereço americano.">
    <meta property="og:image:secure_url" conntent="https://www.box4buy.com/postimage.jpg">
    <title>Box4Buy - Redirecionamento de encomendas</title>
            
    <link rel="shortcut icon" href="{{asset('img')}}">

    <!-- Global Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel/owl.theme.default.min.css') }}">    
    {{--<link rel="stylesheet" href="{{ asset('css/careers.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('css/pricing.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
</head>

<body id="page-top">
    {{--@include('chat.plugin')--}}
    <meta name="referrer" content="unsafe-url">
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v3.2'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/pt_BR/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="1933271053371600"
         theme_color="#2095f4"
         logged_in_greeting="Olá, como podemos ajuda-lo?"
         logged_out_greeting="Olá, como podemos ajuda-lo?">
    </div>
    <!--====================================================
                             HEADER
    ======================================================-->
    <header>
        <!-- Top Navbar  -->
        @include('site.topbar')

        <!-- Navbar -->
        @include('site.menu')
    </header>
    <!--====================================================
                       LOGIN E REGISTRO
    ======================================================-->
    @include('site.login-site')
    <!--====================================================
                             HOME
    ======================================================-->
    <section id="home">

        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- Carousel items -->
            <div class="carousel-inner">
                @if($images[0]->is_overlay)
                <div class="overlay-slide">
                </div>
                @endif
                <div class="carousel-item active slides">
                    <div class="overlay"></div>
                    <div class="slide-1"></div>
                    <div class="hero ">

                        <hgroup class="wow fadeInUp">
                            <h1>
                                {{ $configurations[0]->cfg_main_text }}
                            </h1>
                            <h4 class="corWhite">do mundo até vc</h4>
                            <br>
                        </hgroup>
                        <a href="#"
                           class="btn btn-gradient btn-rounded btn-lg"
                           data-toggle="modal"
                           data-target="#cadastro-modal">Cadastre-se já, é Gratis! <i class="fa fa-arrow-right"></i></a>
                        {{--OU
                        <a href="{{ route('login') }}" class="btn btn-general buttonPrimary wow fadeInUp btnMain btn-rounded">
                            <i class="fa fa-lock"></i> ACESSE SUA CONTA
                        </a>--}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--====================================================
                            ABOUT
    ======================================================-->
    <section id="about" class="about">
        <div class="container">
            <div class="row title-bar">
                <div class="col-md-12">
                    <h1 class="wow fadeInUp">Nós ajudamos você.</h1>
                    <div class="heading-border"></div>
                    <p class="wow fadeInUp" data-wow-delay="0.4s">Redirecionamento de Encomendas nos EUA
                        <br /> Compre nos Estados Unidos e no mundo e tenha suas compras redirecionadas para você!</p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="story-descb">
                            <img src="img/news/news-10.jpg" class="img-fluid" alt="...">
                            <h6>Primeiro Passo</h6>
                            <p>Cadastre-se gratuitamente na Box4Buy e obtenha seu endereço nos EUA</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="story-descb">
                            <img src="img/news/news-2.jpg" class="img-fluid" alt="...">
                            <h6>Segundo Passo</h6>
                            <p>Compre em qualquer loja online e envie para o endereço que fornecemos!</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="story-descb">
                            <img src="img/news/news-8.jpg" class="img-fluid" alt="...">
                            <h6>Terceiro Passo</h6>
                            <p>Recebemos e armazenamos sua compra sem custo.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="story-descb">
                            <img src="img/news/news-15.jpg" class="img-fluid" alt="...">
                            <h6>Passo Final</h6>
                            <p>Consolidamos e enviamos suas compras conforme a sua solicitação.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====================================================
                           CAREER-P3
    ======================================================-->
    <div class="overlay-career-p3"></div>
    <section id="career-p3">
        <div class="container-fluide">
            <div class="row career-p3-title">
                <div class="col-md-12">
                    <h3 class="text-center">Descubra nossas vantagens</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="career-p3-cont text-center">
                        <i class="fa fa-user-plus"></i>
                        <h5>ATENDIMENTO</h5>
                        <br />
                        <small>Nosso atendimento é personalizado.</small>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="career-p3-cont text-center">
                        <i class="fa fa-money"></i>
                        <h5>ARMAZENAMENTO</h5>
                        <br />
                        <small>Até 60 dias de armazenamento grátis.</small>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="career-p3-cont text-center">
                        <i class="fa fa-shopping-bag"></i>
                        <h5>CONSOLIDAÇÃO</h5>
                        <br />
                        <small>Para sua economia juntamos vários pacotes em apenas um.</small>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="career-p3-cont text-center">
                        <i class="fa fa-id-badge"></i>
                        <h5>FOTOS</h5>
                        <br />
                        <small>Receba fotos das encomendas e produtos gratuitamente.</small>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="career-p3-cont text-center">
                        <i class="fa fa-rocket"></i>
                        <h5>ENVIO DA MERCADORIA.</h5>
                        <br />
                        <small>Total agilidade no envio das suas mercadorias.</small>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="career-p3-cont text-center">
                        <i class="fa fa-handshake-o"></i>
                        <h5>COMPROMISSO</h5>
                        <br />
                        <small>Confiabilidade e profissionalismo.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====================================================
                      PRICE
    ======================================================-->
    <section id="price">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricing-icon">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="price-Value">
                            <div class="line-currency">até 4 LBS <small>(1,8 kg)</small></div>
                            <div class="custom-price">
                                US$ {{ str_replace('.', ',', $configurations[0]->cfg_taxa_01) }}
                            </div>                            
                        </div>
                        
                        <div class="pricingHeader">
                            <br>
                        </div>
                        <div class="pricing-content">
                            <ul>
                                <li>+ Frete</li>
                                <li>+ Taxa do Cartão</li>
                                <li>
                                    <small>(5% do total)</small>
                                </li>
                                <li>
                                    <small>*valores em dólares</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricing-icon">
                            <i class="fa fa-rocket"></i>
                        </div>
                        <div class="price-Value">
                            <div class="line-currency">4.1 ATÉ 10 LBS <small>(1,85 até 4,5 kg)</small></div>
                            <div class="custom-price">
                                US$ {{ str_replace('.', ',', $configurations[0]->cfg_taxa_02) }}
                            </div>                            
                        </div>
                        {{-- <span class="month">
                            <smal></smal>
                        </span> --}}
                        <div class="pricingHeader">
                            <br>
                        </div>
                        <div class="pricing-content">
                            <ul>
                                <li>+ Frete</li>
                                <li>+ Taxa do Cartão</li>
                                <li>
                                    <small>(5% do total)</small>
                                </li>
                                <li>
                                    <small>*valores em dólares</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricing-icon">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <div class="price-Value">
                            <div class="line-currency">ACIMA DE 10.1 LBS <small id="up10">(mais de 4,5 kg)</small></div>
                            <div class="custom-price">
                                US$ {{ str_replace('.', ',', $configurations[0]->cfg_taxa_03) }}
                            </div>
                        </div>
                        {{-- <span class="month">
                            A PARTIR DE 10.1 LBS (mais de 4,5 kg)
                        </span> --}}
                        <div class="pricingHeader">
                            <br>
                        </div>
                        <div class="pricing-content">
                            <ul>
                                <li>+ Frete</li>
                                <li>+ Taxa do Cartão</li>
                                <li>
                                    <small>(5% do total)</small>
                                </li>
                                <li>
                                    <small>*valores em dólares</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <p class="text-center">As formas de envio que trabalhamos são: USPS First Class, USPS Priority Mail e USPS Express Mail</p>
        </div>
    </section>

    <!--====================================================
                      SIMULAÇÂO FRETE
    ======================================================-->
    <div class="overlay-career-p3"></div>
    <section id="career-p3">
        <div class="container-fluide">
            <div class="row career-p3-title">
                <div class="col-md-12">
                    <h3 class="text-center">Faça uma simulação do frete agora!</h3>
                    <br />
                </div>
            </div>
            <a href="{{ route('calculadora-site') }}" target="_blank">
                <h3 class="text-center">
                    <button class="btn btn-white btn-lg btn-rounded" role="button">
                        SIMULAR MEU FRETE
                    </button>
                </h3>
            </a>
        </div>
    </section>
    <!--====================================================
                          MODALS
    ======================================================-->



    <!-- Modal -->
    <div class="modal fade" id="cadastro-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title titulo-modal-cadastro">CADASTRE-SE</h4>
                    <button type="button" class="close btn_fechar_modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('site.partials.cadastro')
                </div>
            </div>
        </div>
    </div>
    <!--====================================================
                          FOOTER
    ======================================================-->
    @include('site.footer')

    @include('site.javascript')

    <script src="{{ asset('js/main.js') }}"></script>

    {{--<script>
        var botmanWidget = {
            frameEndpoint: '/bxby/chat',
            chatServer: 'https://messenger.carlosencine.com/botman',
            title: 'Atendimento Online',
            introMessage: 'Seja bem vindo a Box4buy. Em que podemos ajuda-lo?',
            mainColor: '#2095f4',
            placeholderText: 'Enviar Mensagem...',
            bubbleBackground: '#2095f4',
            bubbleAvatarUrl: 'img/chat/me_imgnger1.png'
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>--}}
    <script>
        $('.carousel-fade').css('background-image', "url('{{ $images[0]->home_image }}')");
    </script>
</body>

</html>
