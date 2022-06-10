<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-{{ $cor }}">
      <div class="inner">
        <h3>{{ $valor }}</h3>

        <p>{{ $legenda }}</p>
      </div>
      <div class="icon">
        {{-- <i class="ion ion-bag"></i> --}}
        <i class="{{ $icon }}"></i>
      </div>
      @if (isset($link) && $link != "#")
        <a href="{{ $link }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>  
      @endif
    </div>
</div>