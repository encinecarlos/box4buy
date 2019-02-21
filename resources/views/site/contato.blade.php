<!DOCTYPE html>
<html lang="pt-br">
@include('site.head-site')
<body id="page-top">
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
                           HOME-P
    ======================================================-->
    <div id="home-p" class="home-p pages-head5 text-center">
        <div class="container">
            <h1 class="wow fadeInUp" data-wow-delay="0.1s">contato</h1>
            <p>Entre em contato usando o formulário abaixo que responderemos o mais breve possível.</p>
        </div>
        <!--/end container-->
    </div>
    <!--====================================================
                            ABOUT-P1
    ======================================================-->
    <section id="about-p1">
        <h1 class="text-center"><i class="fa fa-envelope"></i> Enviar E-mail</h1>
        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-lable="Fechar"><i class="fa fa-close"></i></button>
                {{ session('msg') }}
            </div>
        @endif
        <div class="container">
            <form action="{{ route('site-contact') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nome:</label>
                    <input type="text" name="nome" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">E-mail:</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mensagem</label>
                    <textarea name="mensagem" class="form-control" cols="30" rows="15"></textarea>
                </div>
                <div class="form-group">                    
                    <button class="btn btn-success btn-block" type="submit"><i class="fa fa-send"></i> Enviar</button>
                </div>
            </form>
        </div>
        
    </section>

    <!--====================================================
                          FOOTER
    ======================================================-->
    @include('site.footer')
    <!--Global JavaScript -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/popper/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/wow/wow.min.js"></script>
    <script src="js/owl-carousel/owl.carousel.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="js/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="js/custom.js"></script>
</body>
</html>