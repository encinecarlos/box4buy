<header class="main-header">
  <!-- Logo -->
  <a href="{{url('/pessoas')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
      <b>B4B</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      <b>Box4Buy</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(file_exists(public_path().DIRECTORY_SEPARATOR.Auth::user()->caminho_foto_perfil))
            <img id="foto_perfil" src="{{ Auth::user()->caminho_foto_perfil }}" class="user-image" alt="{{ Auth::user()->nome_completo }}">@else
            <img id="foto_perfil" src="{{ asset('img/user/user_default.png') }}" class="user-image" alt="{{ Auth::user()->nome_completo }}">@endif
            <span class="hidden-xs">{{ Auth::user()->nome_completo }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ Auth::user()->caminho_foto_perfil }}" class="img-circle" alt="User Image">

              <p>
                {{ Auth::user()->nome_completo }}
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sair</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>