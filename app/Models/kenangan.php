<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kenangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'nama_teman'
    ];
    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
