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
    <div id="home-p" class="home-p pages-head4 text-center">
        <div class="container">
            <h1 class="wow fadeInUp" data-wow-delay="0.1s">ONDE PAGAR?</h1>
            <p>pague com seu cartão de crédito ou Saldo de sua conta Paypal.</p>
        </div>
        <!--/end container-->
    </div>
    <!--====================================================
                            ABOUT-P1
    ======================================================-->
    <section id="about-p1">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 main-center">
                    <a class="text-center"><img src="img/paypal.png" /></a>
                    <br />
                    <br />
                    <br />
                    <span class="text text-info"><i class="fa fa-info"></i> Para outras formas de pagamento entre em contato conosco no E-mail info@box4buy.com, ou caso seja cliente abra um ticket de suporte no painel do usuário.</span>
</div>
                <div class="col-md-4">
                </div>
            </div>
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
    <script src="js/custom.js"></script>
</body>
</html>