<style>
  li.nav-item > a.nav-link, #username{
    color: #eeeeee;
  }
</style>

<aside class="main-sidebar elevation-4 sidebar-dark-light" style="background-color: #3675bd;">
        
      <a href="{{ route('home') }}" class="brand-link">
    
      <img src="{{ asset('img/logo-crea.png') }}" alt="LOGO DO CREA-DF" width="100%">      
    </a>

    <div class="sidebar">
      
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" >
      
        <div class="info"> 
          <a href="#" class="d-block" id="username">
            @if (!!session('dadosCA'))
                <i class="fa fa-crown text-warning"></i>
            @endif
            {{ Auth::user()->name ?? "" }} 
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="fa fa-th" aria-hidden="true"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('act.index') }}" class="nav-link">
              <i class="fas fa-building"></i>
              <p>
                ACTs
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="fas fa-barcode"></i>
              <p>
                Gerar Boleto
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
