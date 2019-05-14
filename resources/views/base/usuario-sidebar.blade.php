<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li onclick="addAcitve();"><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Início</span></a>
            </li>
            <li><a href="{{ route('perfil', Auth::user()->codigo_suite) }}"><i class="fa fa-user"></i>
                    <span>Meu Perfil</span></a></li>
            <li><a href="{{ route('estoque') }}" data-toggle="tooltip"
                   title="Gerenciamento de estoque, orçamentos e produtos enviados"><i class="fa fa-archive"></i> <span>Meus Produtos</span></a>
            </li>
            <li><a href="{{ route('compra.main') }}"><i class="fa fa-shopping-cart"></i> Compra Assistida</a></li>
            <li><a href="{{ route('tickets.usuario') }}"><i class="fa fa-bullhorn"></i> <span>Suporte</span></a></li>
            @if (Auth::user()->type_user == '1')
                <li><a href="{{ route('pessoas') }}"><i class="fa fa-home"></i> <span>Admin</span></a></li>
            @endif
            <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> <span>Sair</span></a></li>
        </ul>
    </section>
</aside>
