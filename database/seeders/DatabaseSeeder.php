<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Carbon\Carbon; // Import Carbon for date handling
use GuzzleHttp\Promise\Create;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        self::seedUsers();
        $this->command->info('Tabla de usuarios iniciada con éxito!');

        self::seedCategorias();
        $this->command->info('Tabla de categorias iniciada con éxito!');

        self::seedLibros();
        $this->command->info('Tabla de libros iniciada con éxito!');

        self::seedValoraciones();
        $this->command->info('Tabla de valoraciones iniciada con éxito!');
    }

    private function seedLibros() {
        DB::table('libros')->delete();
        
        foreach($this->libros as $libro) {
            Libro::create($libro);
        }
    }

    private $libros = [
        [
            'titulo' => 'Los Juegos del Hambre',
            'autor' => 'Suzanne Collins',
            'resumen' => 'En un futuro distópico, un gobierno totalitario obliga a los jóvenes a participar en una competición mortal en la que solo uno puede sobrevivir.',
            'fecha_publicacion' => '2008-09-14',
            'precio' => 12.99,
            'portada' => 'https://m.media-amazon.com/images/I/71e4kjCsuAL.jpg',
            'edad_minima' => 14,
            'leido' => false,
            'categoria_id' => 8, // Juvenil
        ],
        [
            'titulo' => 'Los Juegos del Hambre. En llamas',
            'autor' => 'Suzanne Collins',
            'resumen' => 'En la secuela de "Los Juegos del Hambre", Katniss Everdeen se enfrenta a nuevos desafíos en una rebelión que amenaza con desbordar el sistema establecido.',
            'fecha_publicacion' => '2009-09-01',
            'precio' => 14.99,
            'portada' => 'https://m.media-amazon.com/images/I/71FrCRrMJ%2BL.jpg',
            'edad_minima' => 14,
            'leido' => false,
            'categoria_id' => 8, // Juvenil
        ],
        [
            'titulo' => 'Dune',
            'autor' => 'Frank Herbert',
            'resumen' => 'La historia de "Dune" sigue a Paul Atreides en un futuro lejano, en el planeta desértico de Arrakis, donde se libra una lucha por el control de la especia más valiosa del universo.',
            'fecha_publicacion' => '1965-08-01',
            'precio' => 18.99,
            'portada' => 'https://m.media-amazon.com/images/I/81Ua99CURsL.jpg',
            'edad_minima' => 16,
            'leido' => false,
            'categoria_id' => 2, // Ciencia Ficción
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'resumen' => 'En una sociedad totalitaria donde el Partido controla todas las actividades humanas, Winston Smith lucha contra la opresión en el gobierno de "El Gran Hermano".',
            'fecha_publicacion' => '1949-06-08',
            'precio' => 9.99,
            'portada' => 'https://m.media-amazon.com/images/I/71sOSrd+JxL._SL1500_.jpg',
            'edad_minima' => 16,
            'leido' => true,
            'categoria_id' => 11, // Novela
        ],
        [
            'titulo' => 'Antifrágil',
            'autor' => 'Nassim Nicholas Taleb',
            'resumen' => 'Taleb explora cómo algunos sistemas, personas y empresas pueden volverse más fuertes frente a la adversidad y el caos, una característica que él denomina "antifragilidad".',
            'fecha_publicacion' => '2012-11-27',
            'precio' => 19.99,
            'portada' => 'https://m.media-amazon.com/images/I/712sGGX5CuL._SL1500_.jpg',
            'edad_minima' => 18,
            'leido' => false,
            'categoria_id' => 4, // Ensayo
        ],
        [
            'titulo' => 'El hombre que confundió su mujer con un sombrero',
            'autor' => 'Oliver Sacks',
            'resumen' => 'El libro reúne una serie de casos neurológicos extraños, incluidos aquellos donde los pacientes sufren trastornos que les impiden reconocer objetos o a las personas cercanas.',
            'fecha_publicacion' => '1985-10-01',
            'precio' => 12.50,
            'portada' => 'https://m.media-amazon.com/images/I/6187a8gNhvL._SL1500_.jpg',
            'edad_minima' => 16,
            'leido' => true,
            'categoria_id' => 4, // Ensayo
        ],
        [
            'titulo' => 'Once Anillos',
            'autor' => 'Phil Jackson y Hugh Delehanty',
            'resumen' => 'El legendario entrenador Phil Jackson narra sus experiencias y lecciones aprendidas durante su carrera, incluyendo su éxito con los Chicago Bulls y Los Angeles Lakers.',
            'fecha_publicacion' => '2004-10-01',
            'precio' => 14.50,
            'portada' => 'https://m.media-amazon.com/images/I/719nmyp4qPL._SL1500_.jpg',
            'edad_minima' => 18,
            'leido' => false,
            'categoria_id' => 3, // Deporte
        ]
    ];
    

    private function seedCategorias() {
        DB::table('categorias')->delete();

        // Fem un array dels noms de les categories, ja que és l'únic camp que em d'omplir
        $categorias = [
            'Autoayuda',
            'Ciencia Ficción',
            'Deporte',
            'Ensayo',
            'Fantasía',
            'Fútbol',
            'Histórica',
            'Juvenil',
            'Manga', 
            'Misterio',
            'Novela',
            'Romántica',
            'Terror',
        ];

        foreach($categorias as $nombre) {
            Categoria::create(['nombre' => $nombre]);
        }
    }

    private function seedUsers() {
        DB::table('users')->delete();

        $usuario1 = new User();
        $usuario1->name = 'Raul Navarro';
        $usuario1->email = 'admin@admin.es';
        $usuario1->password = bcrypt('admin1234');    
        // La data en format yyyy/mm/dd per que es com millor la llegeix SQL i es l'estil per defecte de Carbon
        $usuario1->fecha_nacimiento = '2000-12-11';
        $usuario1->save();

        $usuario2 = new User();
        $usuario2->name = 'Raul Jr';
        $usuario2->email = 'rnavarro.jr@gmail.com';
        $usuario2->password = bcrypt('raul1234');
        $usuario2->fecha_nacimiento = '2015-12-11';
        $usuario2->save();

        $usuario3 = new User();
        $usuario3->name = 'Usuario Prueba';
        $usuario3->email = 'usuarioprueba@gmail.com';
        $usuario3->password = bcrypt('usuario1234');
        $usuario3->fecha_nacimiento = '2012-10-25';
        $usuario3->save();
    }

    private function seedValoraciones() {

        $usuario2 = User::where('email', 'rnavarro.jr@gmail.com')->first();
        $usuario3 = User::where('email', 'usuarioprueba@gmail.com')->first();

        // Agafem tots els llibres, utilitzant el títol com a clau, per si la clau canviés que no es perdin 
        // les relacions i per que s'entengui millor.
        $libros = Libro::all()->keyBy('titulo');


        $usuario2->libros()->attach([
            $libros['Dune']->id => ['nota' => 8, 'valoracion' => 'Muy buen libro!'],
            $libros['1984']->id => ['nota' => 7, 'valoracion' => 'Entretenido, de menos a más.'],
            $libros['Once Anillos']->id => ['nota' => 5, 'valoracion' => 'No me ha gustado, vocabulario muy denso.'],
        ]);

        $usuario3->libros()->attach([
            $libros['Dune']->id => ['nota' => 6, 'valoracion' => 'Me esperaba más... '],
            $libros['1984']->id => ['nota' => 5, 'valoracion' => 'Prefiero la película, algunas partes no me han quedado claras.'],
            $libros['Antifrágil']->id => ['nota' => 8, 'valoracion' => 'Muy bueno, me ha hecho reflexionar.'],
        ]);
    }
}
