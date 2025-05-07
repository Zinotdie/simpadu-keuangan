<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'keu_tagihan';
    protected $primaryKey = 'id_tagihan';
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'id_jenis',
        'id_tahun',
        'nominal',
        'status_tagihan',
        'tgl_terbit'
    ];

    public function jenisTagihan()
    {
        return $this->belongsTo(JenisTagihan::class, 'id_jenis');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_tagihan');
    }
}