<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statusAnggota extends Model
{
    //
    protected $table = "m_status_anggota";
    protected $primaryKey = "id_status_anggota";
    public $timestamps = false;
    protected $fillable =
        [
            "status_anggota"
        ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_status_anggota', 'id_status_anggota');
    }
}
