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
      <li><a href="{{ route('compra.main') }}"><i class="fa fa-shopping-cart"></i> Compra Assistida</a></li>
      <li>
        <a href="{{ route('orcamento') }}">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <span>Orçamentos</span>
        </a>
      </li>

      <li class="treeview">
        <a href="">
          <i class="fa fa-ticket"></i>
          <span>Chamados de Suporte</span>
        </a>
        <ul class="treeview-menu">
          <li >
            <a href="{{ route('ticketadmin') }}">
              <i class="fa fa-check-circle"></i>
              <span>Chamados Abertos</span>
            </a>
          </li>
          <li>
            <a href="{{ route('tickets.historico') }}">
              <i class="fa fa-window-close"></i>
              <span>Chamados Fechados</span>
            </a>
          </li>
        </ul>
      </li>
      {{--<li>
        <a href="{{ route('ticketadmin.closed') }}">
          <i class="fa fa-close"></i>
          <span>Chamados de Fechados</span>
        </a>
      </li>--}}

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
