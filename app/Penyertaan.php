<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyertaan extends Model
{
    //
    protected $table = "tbl_penyertaan";
    protected $primaryKey = "id_penyertaan";
    public  $timestamps = false;
    protected $fillable = [
        "no_admin",
        'no_anggota',
        "tgl_input_penyertaan",
        "jumlah",
        'status1',
        'status2'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'no_anggota', 'id');
    }
}
