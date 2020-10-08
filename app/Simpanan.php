<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    //
    protected $table = "tbl_ambil_simpanan";
    protected $primaryKey = "id_ambil_simpanan";
    public $timestamps = false;
    protected $fillable =
        [
            "no_admin",
            "no_anggota",
            "tgl_input_ambil_simpanan",
            "alasan",
            "jumlah",
            "cara_bayar",
            "status1",
            "status2"
        ];
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'no_anggota', 'id');
    }
}
