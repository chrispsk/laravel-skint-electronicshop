<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicController extends Controller
{
    function index(){
		return view('public.default');
	}
	
	function detalii($idul){
	$p = App\Produs::find($idul);
	if($p){
    return view('public.details',["sto" => $p]); //se duce la details.blade cu produsul corect
	} else {
		dd("This product is not in database");
	}
	}
	
	function cosGet(){
	if(session('cart')==true){  	
	$s = session('cart');
	foreach($s as $i => $q){
		$p[] = ["pr" => App\Produs::find($i), "qnt" => $q];
	}
	//dd($p);
    return view('public.cos', ["all" => $p]);
	  } else{
		  return view('public.cos');
	  }
	}
	function cosPost(Request $r){
	$inp = $r->validate([ 
      'hide' => 'required|integer|min:1|max:99999',
    ]);	
	$j = $r->input("hide");
	$coco = new App\Clase\Cos();
	$coco -> adaugaProdus($j); //adauga in sesiune
    return redirect('cos');
	}
	
	function cosPut(Request $r){
    $nr = $r->input("hi"); //validate TODO
	
	if($r->input("del")=="as1"){
	$arr = session()->forget("cart.$nr");
	
	}
	
	if($r->input("upd")=="as2"){
		$inp = $r->validate([ 
      'qu' => 'required|integer|min:1|max:99999',
    ],
	[
	'qu.integer' => 'Pretul nu e numeric',
	'qu.required' => 'Cantitatea produsului nu poate lipsi',
	'qu.min' => 'Pretul este mai mic ca 1',
	]);	
		$nou = $r->input("qu");
		session()->put("cart.$nr", $nou);
	}
	
    return redirect('cos');
	}
	
	function formular(){
	 if(session('cart')==false){ return redirect("cos")->with("ord", "Please add a product"); }
	 $s = session('cart');
	 foreach($s as $i => $q){
		$p[] = ["pr" => App\Produs::find($i), "qnt" => $q];
	}
	 return view('public.formular', ["all" => $p]);
	}
	function comenziInsert(Request $r){
    if(session('cart')== false){dd("Cart Is Empty");}
     
	 $inp = $r->validate([ 
      'nume' => 'required|regex:/^([A-Z][a-z]+)\s([A-Z][a-z]+)$/',
	  'adresa' => 'required|min:1|max:70|regex:/^[a-zA-Z0-9 ]+$/',
	  'telefon' => ['required','regex:/^((00|\+)?4)?07\d\d([\.\- ]?\d{3}){2}$/'], //contains | pipe... use array 
	  'email' => 'required|min:1|max:30|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/',
    ],
	[
	'nume.*' => 'Name Invalid ex: John Smith',
	'adresa.required' => 'Address Is Missing',
	'adresa.min' => 'Address Is Too Short',
	'adresa.max' => 'Address Is Too Large',
	'adresa.regex' => 'Only Letters, Numbers And Spaces are allowed',
	'telefon.*' => 'Phone Invalid',
	'email.required' => 'Email is missing',
	'email.min' => 'Email too short',
	'email.max' => 'Email too long',
	'email.regex' => 'Email Invalid',
	]);	
	 
    $nume = $r->input("nume");
	$adresa = $r->input("adresa");
	$telefon = $r->input("telefon");
	$email = $r->input("email");
	 
	 $coco = new App\Clase\Cos();
	 $coco->insertion($nume, $adresa, $telefon, $email);
	 return redirect('cos')->with("ord", "Order Done ✓");
	}
	
	//LOGIN AUTENTIFICARE
	function loginPost(Request $r){ //AUTENTIFICARE
	$inp = $r->validate([
	'user' =>'required',
	'pass' =>'required',
	]);
	$userul = $r->input("user");
	$u=App\User::where('username', $userul)->first();
	if (!is_null($u)) {
	$p = $u->password;
       if(password_verify($r->input("pass"), $p)){
        session()->put("msj", $userul); //CREATE SESSION
		return redirect("admin")->with("suc", "You are logged in!");
	   } else {
         return redirect("login");
       }	   
	}else{
		return redirect("login");
	}
} //END AUTENTIFICARE
	
	function loginGet(){
    if(session('msj')==true){ return redirect("admin"); }	
	echo "<br>";
	 
    return view('admin.login');
	}
	
	function logout(){
		session()->forget('msj');
    return redirect()->back();
	}
}
