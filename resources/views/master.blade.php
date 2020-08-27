<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function altFunction(){
	var y = window.pageYOffset;
    sessionStorage.setItem("rememberScroll", y);
}

function myFunction() {
    var z = sessionStorage.getItem("rememberScroll");
	window.scrollBy(z, z);
	}
	
function showHint(str) {
    console.log(str);
    if (str.length === 0) {
        document.getElementById("lista_found").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  //start 
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
				var data = JSON.parse(this.responseText);
				document.getElementById("lista_found").innerHTML=""; //delete append
				
				for (var i = 0; i < data.length; i++) { 
				document.getElementById("lista_found").innerHTML += '<a id="links" href="/detalii/'+data[i].idP+'">'+data[i].denumire+'</a> | ';
        }
            }
        };
		
        xmlhttp.open("GET", "http://127.0.0.1:8000/webservice/listareproduse.json?sort=asc&filter=" + str, true); //webservice
        xmlhttp.send();
    
}	
</script>
</head>
<body onload="myFunction();">
@section('banner')
@show('banner')

<div class="row">
@section('produse')
@show('produse')

@section('continut')
@show('continut')
</div>

</body>
</html>
