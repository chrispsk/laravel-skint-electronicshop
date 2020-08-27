@extends('public.master_public')

@section('continut')

<div class="column" id="fix" style="background-color:#aaa;">
@if(isset($fetches))
	<br><br>
  <img src="{{ asset('images/'.$fetches[0]->poza) }}" alt="Forest" style="width:100%">
  <div class="text-block-details">
  PRICE:£{{$fetches[0]->pret}}<br>
  DETAILS:{{$fetches[0]->detalii}}
  <form method='POST' action='/cos'>
  @csrf
  <input type="hidden" name="hide" value="{{$fetches[0]->idP}}">
  <input type="submit" name='sub' value='Add Product' id="fsubmit">
  </form>
  <br>
  </div>
  @endif
</div> 
@endsection

@section('produse')
@parent 
@endsection