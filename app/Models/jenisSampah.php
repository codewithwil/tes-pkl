<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jenisSampah extends Model
{
    use HasFactory;
    protected $table = 'jenis_sampah';
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'nama',
        'foto',
        'deskripsi',
        'kategori_id',
        'harga',
    ];
    public function Kategori(): BelongsTo{return $this->belongsTo(kategori::class, 'kategori_id', 'id_kategori');}
}
