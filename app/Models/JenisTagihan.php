<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTagihan extends Model
{
    use HasFactory;

    protected $table = 'keu_jenis_tagihan';
    protected $primaryKey = 'id_jenis';
    public $timestamps = true;

    protected $fillable = [
        'nama_jenis_tagihan',
        'deskripsi_tagihan'
    ];

    public function tagihan()
    {
        return $this->hasMany(JenisTagihan::class, 'id_jenis');
    }
}