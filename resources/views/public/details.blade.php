@extends('public.master_public')  

@section('continut')
<div class="column" id="fix" style="background-color:#aaa;">
@if(isset($sto))
	<br><br>
  <img src="{{ asset('images/'.$sto->poza) }}" alt="Forest" style="width:100%;">
  <div class="text-block-details">
  PRICE:£{{$sto->pret}}<br>
  DETAILS:{{$sto->detalii}}
  <form method='POST' action='/cos'>
  @csrf
  <input type="hidden" name="hide" value="{{$sto->idP}}">
  <input type="submit" name='sub' id="fsubmit" value='Add Product'>
  </form>
  <br>
  </div>
  
  @endif
</div> 
@endsection