<?php
declare(strict_type=1);

namespace Models;

class Libro {
    private titulo;
    private autor;
    private genero;
    private anio;
    private paginas;
    private portada;

    public function __construct($titulo, $autor, $genero, $anio, $paginas, $portada) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->genero = $genero;
        $this->anio = $anio;
        $this->paginas = $paginas;
        $this->portada = $portada;
    }

    private static $archivo = __DIR__ . "/../data/biblioteca.txt";

    public static function existe() {
        if (!file_exists(self::$archivo)) {
            return [];
        }

        $datos = file_get_contents(self::$archivo);
        return json_decode($datos, true) ?? [];
    }

    public static function guardar($libros) {
        $datos = json_encode($libros, JSON_UNESCAPED_UNICODE);
        file_put_contents(self::$archivo, $datos);
    } 

    public static function crear($titulo, $autor, $genero, $anio, $paginas, $portada = null) {
        $libros = self::existe();

        $nuevo = [
            "titulo" => $titulo,
            "autor" => $autor,
            "genero" => $genero,
            "anio" => $anio,
            "portada" => $portada
        ]

        $usuarios[] = $nuevo;

        self::guardar($libros);
    }

}

