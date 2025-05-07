<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'keu_tahun_ajaran';
    protected $primaryKey = 'id_tahun';
    public $timestamps = true;

    protected $fillable = [
        'nama_tahun',
        'semester',
        'aktif'
    ];

    public function tagihan()
    {
        return $this->hasMany(JenisTagihan::class, 'id_tahun');
    }

    public function keringanan()
    {
        return $this->hasMany(Keringanan::class, 'id_tahun');
    }
}