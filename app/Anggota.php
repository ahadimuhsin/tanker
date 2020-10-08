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
        'id_status_pekerja',
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
        'id_bagian',
        'id_status_anggota',
        'tgl_mulai_potong',
    ];

    protected $guarded =['_method', '_token'];

    public function status_pekerja()
    {
        return $this->hasOne(statusPekerja::class, 'id_status_pekerja', 'id_status_pekerja');
    }

    public function status_anggota()
    {
        return $this->hasOne(statusAnggota::class, 'id_status_anggota', 'id_status_anggota');
    }

    public function bagian ()
    {
        return $this->hasOne(Bagian::class, 'id_bagian', 'id_bagian');
    }

    public function penyertaan()
    {
        return $this->hasMany(Penyertaan::class, 'no_anggota', 'id_penyertaan');
    }

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'no_anggota', 'id_ambil_simpanan');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'no_anggota', 'id_peminjaman');
    }

}
