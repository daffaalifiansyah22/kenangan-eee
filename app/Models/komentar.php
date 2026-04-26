<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    use HasFactory;

    public function kenangan()
{
    return $this->belongsTo(Kenangan::class);
}
protected $fillable = [
    'kenangan_id',
    'nama',
    'isi',
];
}
