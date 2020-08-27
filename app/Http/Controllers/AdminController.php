<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class AdminController extends Controller
{
    function admin(){
		if(session('msj')==false){ return redirect("login"); }
        echo "<br><br><br>".session("suc");		
		return view('admin.dashboard');
	}
	
	function produse(){
       if(session('msj')==false){ return redirect("login"); }		
		$p = App\Produs::all()->pluck('denumire', 'idP');
		return view('admin.produse')->with("det", $p);
	}
	
	function adauga_produse(){
		if(session('msj')==false){ return redirect("login"); }		
		return view('admin.adauga_produse');
	}
	
	function comenzi(){
       if(session('msj')==false){ return redirect("login"); }	
	   $p = App\Comanda::all(); //
	   $content = "";
	   foreach($p as $d){ 
	   $content .= "<div id='comenzi'>";
	   $content .= $d->nume." a comandat:►";
	   
	   foreach(App\Comanda::find($d->idC)->comand as $r){
	   $content .= " [ "."<b>".$r->denumire."</b>"." | Cantitate". $r->pivot->cantitate." ] ";
				}
	   $content .= "</div>";
	   }
	   $exceptionString = '<br>,<b>,</b>,<div>,</div>';
       $cont = strip_tags($content,$exceptionString );
		return view('admin.comenzi')->with("content", $cont);
	}
	//ADAUGA PRODUS
	function post_produs(Request $r){
		$inp = $r->validate([
	    'denumire' => 'required|min:3|max:199',
		'pret' => 'required|integer|min:1|max:9999999',
        'poza' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		'detalii' => 'required|min:1|max:499',
    ]);
	    $nou1 = $r->input("denumire");
	    $nou2 = $r->input("pret");
	    $nou4 = $r->input("detalii");
        if ($r->hasFile('poza')){
		$image = $r->file('poza');
		$name = time().".".$image->getClientOriginalExtension();
		$destinationPath = public_path('/images');
		$image->move($destinationPath, $name);
	}
        $bag = array('denumire'=>$nou1,'pret'=>$nou2, 'poza'=>$name, 'detalii'=>$nou4);
	    App\Produs::create($bag);	
		return redirect("/admin/produse")->with("ok", "Product added");
	}
	
	function post_produs_get(){
		return redirect("/admin");
	}
	
	function pro(Request $r, $idul){
		$p = App\Produs::find($idul);
		if($p){
		$prodArray = array($p->idP, $p->denumire, $p->pret, $p->poza, $p->detalii);
		session()->put("idul",$p->idP); //folosit la editarePut()
		return view('admin.editari')->with("as", $prodArray);
		}else{
			dd("This product does not exist in database");
		}
	}
	
	//FUNCTIE EDITARE PRODUS
	function editarePut(Request $r){	
	
	$idul = session()->get("idul");
	//DELETE
	if($r->input("del")=="as1"){
		$asul = $r->input("idd");
		if($idul == $asul){ //fucked up situation, daca id hidden se potriveste cu id din sesiune => (sayonara inspect element) just in case
	    App\Produs::destroy($idul);
		return redirect("/admin/produse")->with('ok', 'Product Deleted ✓');
		} else {
			dd("Something unexpected!");
		}
	}
	
	//UPDATE
	if($r->input("upd")=="as2"){
    $asul = $r->input("idd");		
	$inp = $r->validate([
	    'denumire' => 'required|min:3|max:199',
		'pret' => 'required|integer|min:1|max:9999999',
        'addPic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		'detalii' => 'required|min:1|max:499',
    ]);
	    $nou1 = $r->input("denumire");
	    $nou2 = $r->input("pret");
	    $nou4 = $r->input("detalii");
	if ($r->hasFile('addPic')){
		$image = $r->file('addPic');
		$name = time().".".$image->getClientOriginalExtension();
		$destinationPath = public_path('/images');
		$image->move($destinationPath, $name);
	} else {
     $name = $r->input("pname");
	}
    if($idul == $asul){	//fucked up situation, daca id hidden se potriveste cu id din sesiune => (sayonara inspect element) just in case
	App\Produs::where('idP', '=', $idul)
    ->update([
        'denumire' => $nou1,
		'pret' => $nou2,
		'poza' => $name,
		'detalii' => $nou4,
		]);
		return redirect("/admin/produse")->with('ok', 'Product Updated ✓');
	}
	else{
		dd("Something unexpected!");
	}
	}//end upd
	return "";
	}
	
	function editareGet(){
		return redirect("/admin");
	}
	
}
