<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = 
        [
            'nombre',
        ];
    
    // Una categoria pot tindre n llibres, per tant millor que la funció sigui libros()
    public function libros() {
        return $this->hasMany(Libro::class);
    }
}
