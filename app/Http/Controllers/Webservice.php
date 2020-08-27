<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Webservice extends Controller
{
    function doit($da, $dd="", $idul=""){
		
if($da == "listareproduse"){
//echo $_GET["sort"];
	if($dd=="json"){
		if(isset($_GET["sort"]) && $_GET["sort"]=="desc"){
			if(isset($_GET["filter"])){
				$cuv = $_GET["filter"];
				return App\Produs::where("denumire","like","%$cuv%")->get();
			}
			return App\Produs::orderBy('denumire', 'desc')->get();
		}
		elseif(isset($_GET["sort"]) && $_GET["sort"]=="asc"){
			if(isset($_GET["filter"])){
				$cuv = $_GET["filter"];
				return App\Produs::where("denumire","like","$cuv%")->get();
			}
			return App\Produs::orderBy('denumire')->get();
		}
		
	return App\Produs::all()->toArray();
	}//END JSON
		
	//XML
	if($dd=="xml"){
		if(isset($_GET["sort"]) && $_GET["sort"]=="desc"){
			if(isset($_GET["filter"])){
				$cuv = $_GET["filter"];
				$p = App\Produs::where("denumire","like","%$cuv%")->get();
                return response(lafetch($p), 200)->header('Content-Type', 'application/xml');			
			}
			$p = App\Produs::orderBy('denumire', 'desc')->get();
			return response(lafetch($p), 200)->header('Content-Type', 'application/xml');
		}
		elseif(isset($_GET["sort"]) && $_GET["sort"]=="asc"){
			if(isset($_GET["filter"])){
				$cuv = $_GET["filter"];
				$p = App\Produs::where("denumire","like","%$cuv%")->get();
                return response(lafetch($p), 200)->header('Content-Type', 'application/xml');			
			}
			$p = App\Produs::orderBy('denumire', 'asc')->get();
			return response(lafetch($p), 200)->header('Content-Type', 'application/xml');
		}
	    $p = App\Produs::all()->toArray();	
        return response(lafetch($p), 200)->header('Content-Type', 'application/xml');	
			}//END XML
		}//END listareproduse
		
		//---------
		elseif($da == "detaliiprodus"){
			if($dd=="json"){
				$f = App\Produs::find($idul);
				if($f){
					$f = $f->toArray();
				} else{
					dd("Wrong Number");
				}
				return $f;
			}
			if($dd=="xml"){
				$f = App\Produs::find($idul);
				if($f){
					$f = $f->toArray();
					//dd($f);
				} else{
					dd("Wrong Number");
				}
				return response(ladetalii($f), 200)->header('Content-Type', 'application/xml');
			}
		}
		else {
			echo "Exemple<br>";
			echo "localhost/webservice/listareproduse.xml?sort=desc<br>";
			echo "localhost/webservice/listareproduse.json<br>";
			echo "localhost/webservice/listareproduse.xml<br>";
			echo "localhost/webservice/listareproduse.json?sort=desc&filter=cre<br>";
      		echo "localhost/webservice/detaliiprodus.json/15<br>";
       		echo "localhost/webservice/detaliiprodus.xml/15<br>";
			exit;
		}
		return "";
	} //end function controller
	
} //end class

function lafetch($z){
	$xml = new \SimpleXMLElement("<products/>");
	foreach($z as $n){
		$member = $xml->addChild('product');
		$member->addChild('id', $n["idP"]);
		$member->addChild('nume', $n["denumire"]);
		$member->addChild('pret', $n["pret"]);
		$member->addChild('poza', $n["poza"]);
		$member->addChild('detalii', $n["detalii"]);
				}
$xx = $xml->asXML();
return $xx;			
	}
	
function ladetalii($n){
$xml = new \SimpleXMLElement("<products/>");
$member = $xml->addChild('product');
$member->addChild('id', $n["idP"]);
$member->addChild('nume', $n["denumire"]);
$member->addChild('pret', $n["pret"]);
$member->addChild('poza', $n["poza"]);
$member->addChild('detalii', $n["detalii"]);				
$xx = $xml->asXML();
return $xx;			
	}
