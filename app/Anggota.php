<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    //
    protected $table = 'tbl_anggota';
    protected $primaryKey = 'id';
    public $timestamps = false; //menonaktifkan updated_at, created_at
    protected $fillable = [
        'id',
        'nik',
        'nama',
        'no_anggota',
        'email',
        'no_hp',
        'status',
        'identitas',
        'nomor_identitas',
        'alamat_kantor',
        'no_rek_payroll',
        'bank',
        'nama_rekening',
        'kebutuhan',
        'simpanan_pokok',
        'simpanan_wajib',
        'simpanan_sukarela',
        'cara_pembayaran',
        'no_admin',
        'tgl_input',
        'no_pekerja',
        'bagian',
        'tgl_mulai_potong',
    ];

    protected $guarded =['_method', '_token'];

}
