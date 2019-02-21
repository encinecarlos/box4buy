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
    <div id="home-p" class="home-p pages-head1 text-center">
        <div class="container">
            <h1 class="wow fadeInUp" data-wow-delay="0.1s">TEM DÚVIDAS?</h1>
            <p>Veja as dúvidas frequentes.</p>
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
                    <div class="about-p1-cont justificarTexto">
                        <h4 class="text-center">Como funciona?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Faça o cadastro no nosso site e receba o seu endereço nos EUA juntamente com um número de suíte para efetuar suas compras online. Certifique-se que o seu cartão de crédito está habilitado para uso internacional.
                        </p><br />
                        <h4 class="text-center">Quais produtos não podem ser<br /> enviados para o Brasil?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            <ul class="wow fadeInUp" data-wow-delay="0.6s">
                                <li>Fogos de artifício;</li>
                                <li>Animais Vivos;</li>
                                <li>Produtos Químicos;</li>
                                <li>Peles;</li>
                                <li>Jóias em Geral;</li>
                                <li>Bombas, Explosivos em geral;</li>
                                <li>Moeda Corrente;</li>
                                <li>Alimentos Perecíveis;</li>
                                <li>Tabacaria;</li>
                                <li>Bebidas;</li>
                                <li>Drogas;</li>
                                <li>Pesticidas e fertilizantes</li>
                                <li>Armas de Fogo e Acessórios.</li>
                            </ul>
                            Se tiver alguma dúvida entre em contato conosco.
                        </p><br />
                        <h4 class="text-center">Minha encomenda está sujeita a ser tributada?<br /><small>(impostos alfandegários)</small></h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Toda encomenda internacional enviada para o Brasil tem o risco de ter impostos alfandegários.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.6s">
                            O limite máximo para isenção de impostos difere de país para país (consulte qual o limite máximo que pode ser declarado com isenção de impostos junto ao orgão responsável em seu país). Mas se o seu pacote for tributado esteja ciente que a tributação é única e exclusivamente por sua conta.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.8s">
                            A Box4Buy não se responsabiliza pela taxa alfandegária que possa vir a ser emitida nos países de destino.
                        </p><br />

                        <h4 class="text-center">Quem preenche a declaração alfandegária do envio?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Você é o único responsável por declarar o que tem dentro de cada pacote a ser enviado. Antes do envio fornecemos o formulário da declaração para preenchimento. Lembre-se que é seu dever e responsabilidade  declarar o conteúdo de cada encomenda. Informamos que o seguro do envio da encomenda, quando solicitado, é cobrado em cima do valor declarado, não é possível fazer seguro de valor maior que o declarado. A declaração deve ser feita em INGLÊS (Com nosso auxílio).
                        </p><br />
                        <h4 class="text-center">Os envios das encomendas têm seguro?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            O seguro fica a seu critério, ele é opcional. No pagamento do envio do seu pacote você terá a opção de pagar pelo seguro. O seguro é 5% do valor dos produtos (valor total declarado dos produtos). Lembre-se, não é possível fazer um seguro com valor superior ao valor declarado das mercadorias. Se você deseja que o valor gasto com envio (frete) esteja segurado você também deve informá-lo na declaração alfandegária.
                        </p><br />
                        <h4 class="text-center">Quais são as formas de envios usadas e prazos?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            <ul class="wow fadeInUp" data-wow-delay="0.6s">
                                <li>
                                    USPS First Class: A modalidade de envio mais econômica é apenas para pacotes até 4 Libras (1,800 kg). O tempo de entrega demora em média de 30-60 dias* úteis - Serviço com rastreio. O valor total do conteúdo deve ser inferior a US$ 400 dólares. O envio via First Class não tem como contratar seguro. Todos os pacotes recebem um código de rastreamento (tracking), permitindo que o cliente verifique onde se encontra o pacote.
                                </li>
                                <br />
                                <li>
                                    USPS Priority Mail: A modalidade de médio custo. O frete mais utilizado e recomendado, além de dificilmente ser extraviado, o tempo de entrega é em média 12-21 dias* úteis - Serviço com rastreio. O valor total do conteúdo deve ser inferior a US$ 2.499 dólares. Pode ser contratado seguro com adicional de 5% em cima do valor declarado (recomendamos assegurar encomendas de alto valor). Todos os pacotes recebem um código de rastreamento (tracking), permitindo que o cliente verifique onde se encontra o pacote.
                                </li>
                                <br />
                                <li>
                                    USPS Express Mail: A modalidade mais rápida, no território americano, de saída para o destino (o país de entrega pode ter o mesmo procedimento de tempo de trânsito que o Priority Mail) . Porém os riscos de tributação aumentam 99,99% nessa modalidade. O tempo estimado de entrega é em média 8-10 dias* úteis - Serviço com rastreio. O valor do conteúdo não pode ultrapassar o limite de US$ 2.499. Pode ser contratado seguro com adicional de 5% em cima do valor declarado. Todos os pacotes recebem um código de rastreamento (tracking), permitindo que o cliente verifique onde se encontra o pacote.
                                </li>
                            </ul>
                        </p>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            *A entrega pode variar muito. Capitais e cidades próximas à entrada dos pacotes no destino sempre terão entrega mais rápida. Dependendo do serviço dos fiscais da aduaneira e se seu produto foi taxado de imposto ou não. Se o seu produto não for taxado, deverá ser liberado pela fiscalização em um tempo mais rápido, caso contrário, demora um pouco mais, pois irá para o setor de tributação e emissão de nota.
                        </p><br />
                        <h4 class="text-center">Qual o limite de peso e tamanhos de pacotes que posso enviar</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Peso máximo permitido = 66 lbs + ou – 29,930 kg.<br />
                            Volume máximo permitido = inferior a 79” = (197cm).<br />
                            Calculando da seguinte forma = (1 x o lado maior) + (2 x lado menor 1) + (2 x lado menor 2), sendo que o lado maior não pode ultrapassar a medida de 41” (104 cm).<br />
                            O valor máximo que pode ser importado em 1 só pacote é de até US$2.499 dólares.<br />
                        </p><br />
                        <h4 class="text-center">Quais os métodos de pagamento que aceitamos?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Pagamentos via Paypal com os principais cartões de crédito internacionais.<br />
                            Western Union
                        </p><br />
                        <h4 class="text-center">Em quais lojas posso comprar?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            No geral você pode comprar em quase todas as lojas dos Estados Unidos e do mundo, que enviem para USA.<br />
                            Cadastre-se conosco e após receber o seu endereço você compra como se morasse nos USA.<br />
                            Lembre-se de verificar se o seu cartão de crédito está habilitado para uso internacional.<br /><br />
                            Algumas lojas com proteção à marca podem cancelar suas compras (por exemplo Hollister A&F).<br />
                            Você pode optar por tentar comprar com pickup em loja. Entre em contato conosco por e-mail para maiores informações.
                        </p><br />
                        <h4 class="text-center">Não possuo cartão internacional, como faço<br /> para comprar nos Estados Unidos?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Se você não tem cartão internacional ou seu cartão não tenha sido aceito pela loja dos Estados Unidos, você poderá utilizar o nosso serviço de COMPRA ASSISTIDA, onde o cliente nos indica os produtos e a loja (site) e nós fazemos a compra. Aceitamos pagamentos por Western Union. Entre em contato conosco por e-mail para maiores informações.
                        </p><br />
                        <h4 class="text-center">Minha encomenda chegou e não fui informado o que fazer?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Caro cliente se a sua encomenda foi entregue no final do dia, final de semana ou feriado, não temos expediente para registrar e inserir produtos no estoque.<br />
                            Você pode nos enviar um e-mail com o código de rastreio após a compra para agilizar nosso processo e posteriormente lhe informar.<br />
                            Não esqueça de informar seu número de cliente fornecido no cdastro em nosso site.
                        </p><br />
                        <h4 class="text-center">Minha encomenda foi cadastrada, quando irei receber as fotos?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            As fotos das encomendas que são cadastradas em sua conta são colocadas em até 48h úteis. Caso não tenha foto após as 48h úteis nos envie e-mail com o seu número de cliente, rastreio do pacote e o que consta dentro do pacote para verificarmos tudo com atenção.
                        </p><br />
                        <h4 class="text-center">Como irei saber o peso para calcular o frete?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Nós receberemos suas encomendas, abriremos, tiraremos foto da caixa e de todos os produtos e disponibilizaremos todos as informações por e-mail (fotos, pesos, quantidades e outras informações necessárias). Então você poderá calcular o peso por alto de seus pacotes vendo as fotos que são colocadas em seu cadastro onde tem os pesos das caixas que chegam, basta somar os pesos informados nas fotos e calcular.
Quando o cliente monta a caixa para envio, será acrescido 10% de peso referente a caixa utilizada para enviar os produtos, proteção, plástico bolha e afins. Para caixas até 4lbs, o acréscimo será de 15%. Caso o peso da caixa paga pelo cliente, seja maior que o peso final da caixa montada pela Box4Buy, o valor dessa diferença será devolvido ao cliente em forma de créditos no seu próximo envio.
                        </p><br />
                        {{-- <h4 class="text-center">Como irei saber o peso para calcular o frete?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Logo, quando o cliente monta a caixa para envio, será acrescido 10% de peso referente a caixa utilizada para enviar os produtos, proteção, plástico bolha e afins. Para caixas até 4lbs, o acréscimo será de 15%. Caso o peso da caixa paga pelo cliente seja maior do que o peso final da caixa a ser enviada montada pela Box4Buy, essa diferença será devolvida ao cliente em forma de créditos no seu próximo envio.
                        </p><br /> --}}
                        <h4 class="text-center">Quando posso solicitar o envio e como fazer?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Se chegou todos os produtos que deseja enviar e estão devidamente cadastrados, faça o seguinte procedimento:<br />

                            Entre em contato conosco pelo e-mail  solicitando o envio das suas compras (sempre envie o seu código de cliente para podermos identificar você), iremos encaminhar para você preencher um formulário de envio e declaração alfandegária conforme pedido.
                            <br />
                            Aguarde concluirmos o fechamento da sua caixa (fechamento de caixas é feito em até 48hs úteis) e lhe encaminharemos todos os valores para envio, após isso é só você efetuar o pagamento e encaminharemos a sua caixa para ser enviada no próximo dia útil ou no máximo em até 48 horas úteis.
                            <br />
                            *Lembrando que em algumas épocas de promoções podemos ter alguns atrasos devido ao aumento do fluxo.
                        </p><br />
                        <h4 class="text-center">Solicitei um pedido de envio e a caixa já foi fechada posso colocar mais itens ou cancelar?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Sim, podemos cancelar ou unificar pedidos de envio prontos para enviar. Para maiores informações sobre preço desse serviço entrar em contato por e-mail e solicitar um novo orçamento.
                        </p><br />
                        <h4 class="text-center">Por quando tempo posso deixar minhas compras armazenadas sem pagar taxa extra?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            O período de armazenamento para seus produtos em nosso estoque é de 60 dias GRÁTIS, após esse período é cobrado uma taxa de US$14,50 para cada 30 dias a mais. Após o período gratuito de 60 dias o cliente terá que entrar em contato conosco em até 3 dias úteis para manter os produtos em nosso estoque, realizar os pagamento das taxas extras e os mesmos não serem arquivados como abandonados e serem descartados, vendidos ou leiloados sem aviso prévio. 
                            <br />
                            O período de armazenamento de pacotes prontos para envio é de 30 dias GRÁTIS, após esse período é cobrado US$14,50 para cada 30 dias extras. Após o período gratuito de 30 dias o cliente terá que entrar em contato conosco em até 3 dias úteis para manter os produtos em nosso estoque, realizar os pagamento das taxas extras e os mesmos não serem arquivados como abandonados e serem descartados, vendidos ou leiloados sem aviso prévio
                            <br />
                            Todos os pacotes com o período de armazenamento gratuitos ultrapassados que não forem feito contato serão arquivados como abandonados e serão descartados, vendidos ou leiloados sem aviso prévio.
                        </p><br />
                        <h4 class="text-center">Minha dúvida não foi esclarecida?</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">
                            Quaisquer outras dúvidas sobre nossos serviços que não estejam esclarecidas aqui depois de ler, pode nos contatar via e-mail:
                        </p><br />
                    </div>
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