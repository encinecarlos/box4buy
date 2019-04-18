<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <br>
      <li>
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-home"></i><span>Home</span>
        </a>
      </li>
      <li>
        <a href="{{route('pessoas')}}">
          <i class="fa fa-address-book-o" aria-hidden="true"></i><span>Clientes</span></a>
      </li>
      <li>
        <a href="{{route('estoqueAdmin')}}">
          <i class="fa fa-archive"></i>
          <span>Estoque</span>
        </a>
      </li>
      @if(App::environment(['local', 'staging']))
        <li><a href="{{ route('compra.main') }}"><i class="fa fa-shopping-cart"></i> Compra Assistida</a></li>
      @endif
      <li>
        <a href="{{ route('orcamento') }}">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <span>Orçamentos</span>
        </a>
      </li>

      <li>
        <a href="{{ route('ticketadmin') }}">
          <i class="fa fa-ticket"></i>
          <span>Chamados de Suporte</span>
        </a>
      </li>

      <li>
        <a href="{{ route('send-direct-message') }}">
          <i class="fa fa-envelope"></i>
          <span>Envio de Mensagens</span>
        </a>
      </li>

      <li>
        <a href="{{ route('configuracoes') }}">
          <i class="fa fa-cog"></i>
          <span>Configurações</span>          
        </a>
      </li>

      {{--
      <li>
        <a href="{{url('/enderecos')}}">
          <i class="fa fa-map-o" aria-hidden="true"></i>
          <span>Endereços</span>
        </a>
      </li> --}} {{--
      <li class="treeview">
        <a href="#">
			  <i class="fa fa-commenting-o"></i> <span>Enviar mensagens</span>
			  <span class="pull-right-container">
			    <i class="fa fa-angle-left pull-right"></i>
			  </span>
			</a>
        <ul class="treeview-menu">
          <li><a href="{{url('/alerta')}}"><i class="fa fa-circle-o text-red"></i> Mensagem Direcionada</a></li>
          <li><a href="{{url('/provisorio')}}"><i class="fa fa-circle-o text-aqua"></i> Mensagem para Todos</a></li>
        </ul>
      </li> --}}
      <li>
        <a href="{{ route('logout') }}">
          <i class="fa fa-power-off"></i>
          <span>Sair</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
