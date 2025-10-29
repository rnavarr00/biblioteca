<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';

    protected $fillable =
        [
            'titulo',
            'autor',
            'resumen',
            'fecha_publicacion',
            'precio',
            'portada',
            'edad_minima',
            'categoria_id',
            'leido'
        ];

    // Ens assegurem que les dades es guardaràn i s'utilitzaràn en el mateix format que estan en la migració
    // i no com un String
    protected $casts = 
        [
            'fecha_publicacion' => 'date',
            'precio' => 'decimal:2',
            'edad_minima' => 'integer',
            'leido' => 'boolean',
        ];
    
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)
            ->withPivot('nota', 'valoracion')
            ->withTimestamps();
    }
}
