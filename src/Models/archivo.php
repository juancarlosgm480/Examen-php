<?php
namespace Models;

class archivo {
    private static $archivo = __DIR__ . '/../data/biblioteca.txt';

    public static function obtenertodos() {
        if (!file_exists(self::$archivo)) {
            return [];
        }

        $datos = file_get_contents(self::$archivo);
        return json_decode($datos, true) ?? [];
    }

    public static function guardarTodos($archivos) {
        $datos = json_encode($archivos, JSON_PRETTY_PRINT);
        file_put_contents(self::$archivo, $datos);
    }

    public static function crear($nomrbe, $ruta, $libro) {
        $archivos = self::obtenertodos();

        $nuevoArchivo = [
            "id" => count($archivos) + 1,
            "nombre" => $nomrbe,
            "ruta" => $ruta,
            "libro" => $libro
        ];

        $archivos[] = $nuevoArchivo;
        self::guardarTodos($archivos);
    }
}