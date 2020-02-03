<header class="main-header boxColorTema">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
        <img src="{{asset('img/logo-mini.png')}}" alt="">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top header-gradient">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                {{--<li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">
                            {{ Auth::user()->unreadNotifications()->groupBy('notifiable_type')->count() }}
                        </span>
                    </a>
                    <ul class="dropdown-menu notification">
                        <li class="header">
                            <a href="" class="btn btn-link">Apagar notificações</a>
                        </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(Auth::user()->unreadNotifications as $notification)
                                    <li>
                                        @switch($notification->data['type'])
                                            @case('suporte')
                                            <a href="{{ route('ticketshow', $notification->data['extrainfo']) }}">
                                                <i class="{{ $notification->data['icon'] }}"></i>
                                                {{ $notification->data['message'] }}
                                            </a>
                                            @break
                                            @case('usuario')
                                            <a href="{{ route('usuario.exibir', $notification->data['extrainfo']) }}">
                                                <i class="{{ $notification->data['icon'] }}"></i>
                                                {{ $notification->data['message'] }}
                                            </a>
                                            @break
                                            @case('compra_assistida')
                                            <a href="{{ route('compra.edit', $notification->data['extrainfo']) }}">
                                                <i class="{{ $notification->data['icon'] }}"></i>
                                                {{ $notification->data['message'] }}
                                            </a>
                                            @break
                                        @endswitch
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        --}}{{--<li class="footer"><a href="#">View all</a></li>--}}{{--
                    </ul>
                </li>--}}

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="foto_perfil">
                        @if(Auth::user()->caminho_foto_perfil != '')
                            <img id="foto_perfil" src="{{ Auth::user()->caminho_foto_perfil }}" class="user-image" alt="{{ Auth::user()->nome_completo }}">
                        @else
                            <img id="foto_perfil" src="{{ asset('img/user/user_default.png') }}" class="user-image" alt="{{ Auth::user()->nome_completo }}">
                        @endif
                        <span class="hidden-xs">{{Auth::user()->nome_completo}} {{ Auth::user()->sobrenome }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if(Auth::user()->caminho_foto_perfil)
                                <img src="{{ Auth::user()->caminho_foto_perfil }}" class="img-circle" alt="{{ Auth::user()->nome_completo }}">
                            @else
                                <img src="{{ asset('img/user/user_default.png') }}" class="img-circle" alt="{{ Auth::user()->nome_completo }}">
                            @endif
                            <p>
                                {{ Auth::user()->nome_completo }} {{ Auth::user()->sobrenome }}
                                <small><b>{{ session('suite_prefix') }}{{ Auth::user()->codigo_suite }}</b></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('perfil', Auth::user()->codigo_suite) }}" class="btn boxColorTema">Meu Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn boxColorTema"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
