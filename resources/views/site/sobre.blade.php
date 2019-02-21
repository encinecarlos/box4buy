<!DOCTYPE html>
<html lang="en">
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
    <div id="home-p" class="home-p pages-head2 text-center">
        <div class="container">
            <h1 class="wow fadeInUp" data-wow-delay="0.1s">SAIBA MAIS SOBRE</h1>
            <p>Armazenamento e Redirecionamento</p>
        </div><!--/end container-->
    </div>
    <!--====================================================
                        FINANCIAL-P1
    ======================================================-->
    <section id="financial-p1">
        <div class="overlay-financial-p1"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 financial-p1-pos"></div>
                <div class="col-md-8 financial-p1-pos">
                    <div class="financial-p1-cont justificarTexto">
                        <h3 class="text-center">Box4Buy</h3>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Com a finalidade de proporcionar aos nossos clientes a experiência de compras online nas mais variadas lojas dos Estados Unidos e do mundo, e terem suas compras entregues direto no conforto de sua casa, oferecemos nossos serviços de armazenamento e redirecionamento. Um serviço ágil, de baixo custo e de confiança, basta realizar o cadastro em nosso site e então forneceremos um endereço americano onde receberemos suas encomendas para então redirecionar para seu endereço.
                        </p>                        
                        <p class="wow fadeInUp" data-wow-delay="0.8s">
                            <br />
                            <h4 class="text-center">Como funciona nosso processo de redirecionamento</h4>
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1s">
                            <br />
                            <h5><small>1.º Passo:</small></h5>
                            Cadastre-se conosco (gratuitamente)
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1.2s">
                            <br />
                            <h5><small>2.º Passo:</small></h5>
                            Compre online nos EUA e em outros países (aproveite o conforto do seu lar e compre em qualquer lugar, através de lojas online das mais diversas marcas).
                            <br />
                            Encaminhe as suas compras para nosso endereço fornecido no seu cadastro.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1.4s">
                            <br />
                            <h5><small>3.º Passo:</small></h5>
                            Nós iremos receber a sua compra, armazenar, e você será notificado via e-mail e pela área de cliente da Box4Buy. Você será informado, com fotos, de todos os detalhes do pacote como etiqueta de remessa e o próprio pacote com produtos que vieram na encomenda, para que possa visualizar se chegaram os produtos corretos que você comprou
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1.6s">
                            <br />
                            <h5><small>4.º Passo:</small></h5>
                            Consolidamos e armazenamos a sua compra. Após recebermos todos os seus pacotes, você poderá solicitar os produtos para envio, preenchendo corretamente o formulário enviado, onde irá colocar o endereço para envio, método de envio, se quer consolidar caixas ou não, seguro e declaração alfandegária, etc., tudo que se refere à entrega de sua encomenda. Efetuar todos os pagamentos das taxas para envio, após confirmação de pagamento iremos enviar a encomenda para você.

                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            <br />
                            <h4 class="text-center">Não consegue comprar online da sua casa?</h4>
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            <br />
                            Confira nossos serviços de<h5><small>COMPRA ASSISTIDA.</small></h5>
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.6s">
                            Se você não conseguir fazer as suas compras online, nós iremos ajudá-lo. A Box4Buy oferece também o serviço de Compra Assistida, onde você informa o produto e a loja (site) e nós realizamos as compras.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.8s">
                            As taxas dos serviços para compras assistidas em lojas online são:
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1s">
                            15% do valor das compras até US$100 (+ taxa do cartão)
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1.2s">
                            10% do valor das compras acima de US$100 (+ taxa do cartão)
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="1.4s">
                            Para utilizar o serviço de compra assistida em loja física, faça o seu orçamento por e-mail.
                        </p>
                    </div>
                </div>
                <div class="col-md-2 financial-p1-pos"></div>
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
