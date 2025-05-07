<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keringanan extends Model
{
    use HasFactory;

    protected $table = 'keu_keringanan';
    protected $primaryKey = 'id_keringanan';
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'id_tahun',
        'jenis_keringanan',
        'jumlah_potongan',
        'deskripsi_keringanan',
        'status_keringanan'
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun');
    }
}