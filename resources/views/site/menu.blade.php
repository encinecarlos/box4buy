<nav class="navbar navbar-expand-lg navbar-light" id="mainNav" data-toggle="affix">
            <div class="container-fluid">
                <a class="navbar-brand" href="/" style="margin-left: 5rem">
                    <img src="img/logo-s.png" width="200px" height="44px" alt="logo">
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link"  href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('sobre') }}">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('duvidas') }}">Dúvidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('pagamentos') }}">Pagamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('ondecomprar') }}">Onde Comprar?</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('calculadora-site') }}">Calculadora</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('contato') }}">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link smooth-scroll">ÁREA DO CLIENTE</a>
                        </li>
                        <li>
                            <div class="top-menubar-nav">
                                <div class="topmenu ">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <ul class="list-inline top-contacts">
                                                    <li>
                                                        <i class="fa fa-envelope"></i> Email:
                                                        <a href="mailto:info@box4buy.com">info@box4buy.com</a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-whatsapp"></i> Whatsapp: +1 (770) 899-6392
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul class="list-inline top-data">
                                                    <li class="infodolar visible-sm-block">Dolar Comercial: <span>R$ {{ $dolar[0]->cfg_dolar }}</span></li>
                                                    <a>Siga-nos</a>
                                                    <li>
                                                        <a href="https://www.facebook.com/Box-4-Buy-1933271053371600/" target="_empty">
                                                            <i class="fa top-social fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.instagram.com/box4buy/" target="_empty">
                                                            <i class="fa top-social fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                    <!-- <li><a href="#" target="_empty"><i class="fa top-social fa-google-plus"></i></a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>