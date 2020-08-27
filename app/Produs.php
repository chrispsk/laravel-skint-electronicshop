<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produs extends Model {
    protected $table = 'produse';
	protected $primaryKey = 'idP';
	public $timestamps = false;
	protected $fillable = ['denumire','pret','poza','detalii'];
	//protected $hidden = ['idP'];
	
	function clase(){
		return $this->belongsToMany(Comanda::class, 'comenzi_produse', 'idPro', 'idCom')->withPivot('cantitate');
	}
}
