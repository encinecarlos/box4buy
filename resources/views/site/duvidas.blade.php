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
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
    <div id="home-p" class="home-p pages-head1 text-center">
        <div class="container">
            <h1 class="wow fadeInUp" data-wow-delay="0.1s">TEM DÚVIDAS?</h1>
            <p>Veja as dúvidas mais frequentes.</p>
        </div>
        <!--/end container-->
    </div>
    <!--====================================================
                            ABOUT-P1
    ======================================================-->
    <section id="about-p1">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    {!! $configurations[0]->cfg_faq !!}
                    {{--<div class="about-p1-cont justificarTexto">


                    </div>--}}
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>

    <!--====================================================
                          FOOTER
    ======================================================-->
    @include('site.footer')
    @include('site.javascript')
</body>
</html>
