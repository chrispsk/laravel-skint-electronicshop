<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'useri';
	protected $primaryKey = 'iduser';
	public $timestamps = false;
	//protected $fillable = ['denumire','pret','poza','detalii'];
}
