<div class="column" style="background-color:#aaa;">
    <div class="rowImages">
  	<br><br>  
  @if(isset($fetches))
    @foreach ($fetches as $num)
     
	<a href="/detalii/{{ $num->idP }}" onclick="altFunction()">
	<div class="imageColumn">
	
    <img src="{{ asset('images/'.$num->poza) }}" alt="Forest" id="poz" style="width:100%">
    <div class="text-block">{{ $num->denumire }}</div>	
  </div>
  </a>
  @endforeach
  @endif
  
  </div>
</div>

