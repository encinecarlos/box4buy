@extends('base.usuario-base')

@section('content')
    <!-- Essa DIV deverá aparecer no HOME CLIENTE -->
    <div class="row" style="display: {{ $enable_pay[0]->libera_pagamento == '2' ? 'none' : 'block'}}">
        <div class="col-sm-12">
            <div class="alert alert-warning">
                <i class="fa fa-warning"></i> Conta não verificada. Por favor valide clicando em Validar conta nesta pagina para utilizar os serviços da Box4buy.
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-3">
            <div class="box box-info box-solid">
                <div class="box-header with-border text-center">
                    <h4><b><i class="fa fa-address-card"></i> ENDEREÇO NOS ESTADOS UNIDOS</b></h4>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td><b>Name:</b></td>
                            <td>{{ Auth::user()->nome_completo }} {{ Auth::user()->sobrenome }}</td>
                        </tr>
                        <tr>
                            <td><b>Street Address:</b></td>
                            <td>{{ $configs->cfg_address }}</td>
                        </tr>
                        <tr>
                            <td><b>Suite:</b></td>
                            <td><b class="badge boxColorTema">{{ session('suite_prefix') }}{{ Auth::user()->codigo_suite }}</b></td>
                        </tr>
                        <tr>
                            <td><b>City:</b></td>
                            <td>{{ $configs->cfg_city }}</td>
                        </tr>
                        <tr>
                            <td><b>State:</b></td>
                            <td>{{ $configs->cfg_state }}</td>
                        </tr>
                        <tr>
                            <td><b>Zip Code:</b></td>
                            <td>{{ $configs->cfg_zipcode }}</td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b></td>
                            <td>{{ $configs->cfg_phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="box box-info box-solid">
                <div class="box-header with-border text-center">
                    <h4><b><i class="fa fa-link"></i> ATALHOS</b></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6" style="display: {{ $enable_pay[0]->libera_pagamento == '2' ? 'none' : 'block'}}">
                            <a href="#upload-modal" rel="modal:open" >
                                <div class="small-box boxColorTema text-center">
                                    <div class="inner">
                                        <h3>
                                            <i class="fa fa-check-circle"></i>
                                        </h3>
                                        <p>VALIDAR CONTA</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="{{ $enable_pay[0]->libera_pagamento == '2' ? 'col-sm-12' : 'col-sm-6' }}">
                            <a href="{{ route('calculadora') }}">
                                <div class="small-box boxColorTema text-center">
                                    <div class="inner">
                                        <h3>
                                            <i class="fa fa-calculator"></i>
                                        </h3>
                                        <p>CALCULADORA</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="https://www.youtube.com/channel/UCTzviBmGqe6vP7JuGLA59Fw" target="_blank">
                                <div class="small-box boxColorTema text-center">
                                    <div class="inner">
                                        <h3>
                                            <i class="fa fa-video-camera"></i>
                                        </h3>
                                        <p>TUTORIAL</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('ticketadd') }}">
                                <div class="small-box boxColorTema text-center">
                                    <div class="inner">
                                        <h3>
                                            <i class="fa fa-ticket"></i>
                                        </h3>
                                        <p>ABRIR CHAMADO DE SUPORTE</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @include('usuario.partials.docModal')
                </div>
            </div>
        </div>

        <div class="col-sm-6 ">
            <div class="box box-info box-solid">
                <div class="box-header with-border text-center">
                    <i class="fa fa-newspaper-o"> NOVIDADES BOX4BUY</i>
                </div>
                <div class="box-body box-scroll">
                    @foreach($novidades as $news)
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <div class="user-block">
                                    <img src="{{ asset('favicon-32x32.png') }}" alt="">
                                    <span class="username">Equipe Box4Buy - {{ $news->title }}</span>
                                    <span class="description">Publicado em {{ $news->created_at->format('d/m/Y') }} as {{ $news->created_at->format('h:i') }}</span>
                                </div>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        {!! $news->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-6">
            <div class="box box-info box-solid">
                <div class="box-header with-border text-center">
                    <i class="fa fa-youtube-play"> CONHEÇA A BOX4BUY</i>
                </div>
                <div class="box-body">
                    <iframe width="100%"
                            height="560"
                            src="https://www.youtube.com/embed/tiO78LF_nCA"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-info box-solid">
                <div class="box-header with-border text-center">
                    <i class="fa fa-youtube-play"> ULTIMOS VIDEOS POSTADOS</i>
                </div>
                <div class="box-body">
                    <iframe width="100%"
                            height="560"
                            src="https://www.youtube.com/embed/videoseries?list=PLbumAGpgT6JpJ5fdpRVAWJO30yp_KT04u"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                </div>
            </div>
        </div>
    </div>

    {{--<div class="row">
        <div class="col-sm-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border text-center">
                    <i class="fa fa-newspaper-o"> NOVIDADES BOX4BUY</i>
                </div>
                <div class="box-body">
                    @foreach($novidades as $news)
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <div class="user-block">
                                    <img src="{{ asset('favicon-32x32.png') }}" alt="">
                                    <span class="username">Equipe Box4Buy - {{ $news->title }}</span>
                                    <span class="description">Publicado em {{ $news->created_at->format('d/m/Y') }} as {{ $news->created_at->format('h:i') }}</span>
                                </div>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                {!! $news->description !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>--}}
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@stop

@section('js')
    {{-- <script src="{{ asset('js/usuario-estoque.js') }}"></script> --}}
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/upload.js') }}"></script>
@stop
