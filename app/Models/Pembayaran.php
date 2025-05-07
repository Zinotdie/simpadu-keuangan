<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'keu_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'id_tagihan',
        'nominal',
        'tgl_bayar',
        'metode_bayar',
        'bukti_bayar'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
}