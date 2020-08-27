<?php
namespace App\Clase;
use Iterator;
use App;

class Cos implements Iterator{

private $productors = array();
private $iteratedElements = 0;

public function __construct()
        {
        $this->productors = session('cart');
        }

public function adaugaProdus($prodId){
	if(!isset($this->productors[$prodId])){
	$this->productors[$prodId] = 1;	
	session()->put("cart",$this->productors);
	}else{
	$this->productors[$prodId] += 1;	
	session()->put("cart",$this->productors);
	}
}

public function rewind(){reset($this->productors); $this->iteratedElements = 0; }
public function current(){return current($this->productors);}
public function key(){return key($this->productors);}
public function next(){next($this->productors); $this->iteratedElements++; }
public function valid(){return $this->iteratedElements >= count($this->productors);}

public function insertion($nume, $adresa, $telefon, $email){
	//GOOD
	$p = new App\Comanda();
	$p->nume = $nume;
	$p->adresa = $adresa;
	$p->telefon = $telefon;
	$p->email = $email;
	$p->save();
	//$k = $p->idC;
	//$user = App\Comanda::find($k);
	//AICI INCEPE FOREACH in sesiune
	foreach($this->productors as $idP => $qnt){
	$p->comand()->attach([$idP],['cantitate'=>$qnt]);
	}
	session()->flush("cart"); //In The End FLUSH CART 
	
	//DUPLICATE
	/*foreach($this->productors as $idP => $qnt){
	$tl = App\Produs::find($idP);
	$category = new App\Comanda(['nume' => 'Gou', 'adresa' => 'London', 'telefon' => '072420', 'email' => 'chris@gmail.com']);
	$tl->clase()->save($category, ['cantitate' => $qnt]);
	}*/
	}

}