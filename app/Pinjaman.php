<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    //
    protected $table = "tbl_peminjaman";
    protected $primaryKey = "id_peminjaman";
    public $timestamps = false;
    protected $fillable =
        [
            'no_admin',
            'no_anggota',
            'tgl_input_pinjam',
            'kebutuhan',
            'jumlah',
            'termin',
            'angsuran',
            'status'
        ];
}
