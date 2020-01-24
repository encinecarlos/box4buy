<!DOCTYPE html>
<html lang="pt-br">
@include('site.head-site')
<body>
    <header>
        <!-- Top Navbar  -->
        @include('site.topbar')

        <!-- Navbar -->
        @include('site.menu')
    </header>
    @include('site.login-site')

    <div class="row">
        <div class="col-sm-12 calculadora-title">
            <h1 class="text-uppercase text-center "><i class="fa fa-calculator"></i> Calculadora</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mt-3 mb-5">
            <h4 class="text-center">Informe o peso do produto <span class="text text-info">(Libras)</span></h4>
        </div>        
    </div>
    <div class="center-block mt-3 mb-3">        
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal">
                    <div class="form-group center-block">
                        <div class="col-md-2 offset-md-5 slidercontainer">
                            <label for="slidepeso"><b>Peso: <span id="peso-display"></span> Libra(s)</b></label>
                                <input type="range"
                                       class="bxby-slider"
                                       name="peso"
                                       min="1"
                                       max="66"
                                       value="1"
                                       id="slidepeso">
                            {{--<input type="text" class="form-control form-lg input-peso" name="peso" id="pesoinput" placeholder="Peso">                            --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container">
                            <div class="col-md-12 mt-2 text-center">
                                <button type="button" class="btn btn-gradient btn-rounded btn-lg" id="btn-peso"><i class="fa fa-calculator"></i> Calcular Frete</button>
                            </div>
                        </div>
                                                
                    </div>
                </form>
            </div>            
        </div>

        <div class="row">
            <div class="col-md-12">                
                @if(Session::has('frete'))					
                <div class="row ml-2 mr-2 mb-3">
                    @foreach(session('frete') as $f)
						@foreach($f as $value)
						    <div class="col-sm-4">
							    <ul class="price">
							    @switch($value['id'])
								    @case(1)
									    <li class="header">Priority Express</li>
									@break
								    @case(2)
									    <li class="header">Priority Mail</li>
									@break
								    @case(15)
									    <li class="header">First Class</li>	
								    @default										
							    @endswitch								
							    <li><b>Peso (Libras):</b> {{ $value['peso'] }}</li>
							    <li><b>Peso (KG):</b> {{ number_format($value['peso'] / 2.2, 2) }}</li>
							    <li><b>Taxa de Frete:</b> {{ $value['valor_frete'] }} USD</li>
							    <li><b>Taxa de Cartão:</b> {{ $value['taxa_cartao'] }}</li>
							    <li><b>Taxa Box4Buy :</b> {{ $value['taxa_box'] }} USD</li>
							    <li><b>Valor Total :</b> {{ $value['valor_total'] }} USD</li>
				    	    </ul>
					    </div>
						@endforeach
					@endforeach    
                </div>										
				@endif
            </div>
        </div>
    </div>    

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="{{ asset('js/frete.js') }}"></script>
</body>
</html>
