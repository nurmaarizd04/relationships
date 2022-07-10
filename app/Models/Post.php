<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ["nama", "kelas", "alamat", "jurusan_id"];

    // relasi ke category
    public function categories()
    {
        return $this->belongsTo(Category::class, "jurusan_id");
    }
}
