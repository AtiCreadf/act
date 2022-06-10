 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/logo-crea.png') }}" alt="LOGO DO CREA-DF" width="100%">
      {{-- <span class="brand-text font-weight-bold">GED - CREADF</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            {{-- <a href="#" class="d-block">{{ $payload["nome_solicitante"] }}</a> --}}
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('protocolo.profile') }}" class="nav-link">
              <i class="fas fa-dice"></i>              
              <p>
                Meu dados
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('protocolo.home', [
                'tipo' => 'protocolos',
            ]) }}" class="nav-link">
              <i class="fa fa-file-alt" aria-hidden="true"></i>
              <p>
                Meus Protocolos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('protocolo.home', [
                'tipo' => 'pendentes',
            ]) }}" class="nav-link">
              <i class="fas fa-exclamation"></i>
              <p>
                Protocolos pendentes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('protocoloOnline.minhasEmpresas') }}" class="nav-link">
              <i class="fas fa-building"></i>
              <p>
                Minhas empresas
              </p>
            </a>
          </li>
          <form action="https://mobile.creadf.org.br/sgf_web_21/meus_rmos.php" method="post" id="infracoes" class="text-decoration-none">
            <input name="token" type="hidden" value="{{ session('tokenSGF') }}">
            <input name="rmo_key" type="hidden" value="{{ session('rmo_key') }}">
          </form>
          <li class="nav-item">
            {{-- <a href="#" class="nav-link" onclick="document.getElementById('infracoes').submit()"> --}}
              <a href="#" class="nav-link" onclick="document.getElementById('infracoes').submit()">
                <i class="fas fa-gavel"></i>
                <p>
                  Infrações
                </p>
              </a>
          </li>
            {{-- <a href="{{ route('protocolo.home') }}" class="nav-link">
              <i class="fa fa-scroll" aria-hidden="true"></i>
              <p>
                Infrações
              </p>
            </a> --}}


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
