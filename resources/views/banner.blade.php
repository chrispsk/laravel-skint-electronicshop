<div id="banner">
 <div id="leftMenu">
@if(session()->has("msj"))
Hello {{ session("msj") }}
<a href="/logout">Logout</a> |
@else
<a href="/login">Login</a>	|
@endif
<a href="/cos">Vezi Cos</a> 
</div>
<div id="search">
<input type="text" id="fsearch" onkeyup="showHint(this.value)" placeholder="Search..">
</div> <div id="lista_found"></div>

</div>

