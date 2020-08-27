<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table = 'comenzi';
	protected $primaryKey = 'idC';
	public $timestamps = false; //dezactivare
	protected $fillable = ['nume', 'adresa', 'telefon', 'email'];
	
	function comand(){
		return $this->belongsToMany(Produs::class, 'comenzi_produse', 'idCom', 'idPro')->withPivot('cantitate');
	}
}
