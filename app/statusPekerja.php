<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statusPekerja extends Model
{
    //
    protected $table = "m_status_pekerja";
    protected $primaryKey = "id_status_pekerja";
    public $timestamps = false;
    protected $fillable =
        [
            "status_pekerja"
        ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_status_pekerja', 'id_status_pekerja');
    }
}
