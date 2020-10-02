<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    //
    protected $table = "m_bagian";
    protected $primaryKey = "id_bagian";
    public $timestamps = false;
    protected $fillable =
        [
            "nama_bagian"
        ];
}
