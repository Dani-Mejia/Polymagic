<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'categoria_id',
        'titulo',
        'imagen',
        'precio'
    ]; 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
