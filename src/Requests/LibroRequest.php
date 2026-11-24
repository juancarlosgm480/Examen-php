<?php
declare(strict_types=1);

use Models\Libro;
use Models\archivo;

require_once __DIR__ . '/../Model/Libro.php';
require_once __DIR__ . '/../Model/archivo.php';

class LibroRequest {
    public function procesarLibros () {
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $genero = $_POST['genero'] ?? '';
        $anio = $_POST['anio'] ?? '';
        $portada = $_FILES['portada'] ?? null;

        $rutaImagen = null;

        $nuevoLibro = new Libro($titulo, $autor, $genero, $anio, $paginas, $portada);

        $errores = $nuevoLibro->validarDatos();

        if (!empty($errores)) {
            
        $_SESSION['errores_validacion'] = $errores;
        $_SESSION['datos_viejos'] = [
            'usuario' => $nombre,
            'correo' => $correo
        ];

    }

    public function validarDatos(): array {
        $verificar = true;
        $errores[];
        $contadorErrores = 0;

        if (!preg_match('/^[a-zA-z0-9]{1,20}$/' , this->titulo)) {
            $errores['titulo'] = "El título debe de contener mínimo 1 caracter";
            $contadorErrores++;
        }

        if (!preg_match('/^[a-zA-Z ñ]{1,20}$/' , $this->autor)) {
            $errores['autor'] = "El formato del nombre no es correcto";
            $contadorErrores++;
        }

        if (!preg_match('/^[1-9]$/' , $this->paginas)) {
            $errores['anio'] = "El  año no puede ser igual o menor que 0";
            $contadorErrores++;
        }

        if (!preg_match('/^[1-9]$/' , $this->paginas)) {
            $errores['paginas'] = "Las páginas no pueden ser 0";
            $contadorErrores++;
        }

        if ($imagen !== null && $imagen['error'] !== UPLOAD_ERR_NO_FILE) {

            if ($imagen['error'] === UPLOAD_ERR_OK) {

                if ($imagen['size'] > 2 * 1024 * 1024) {
                    $errores['portada'] = "La imagen no puede superar los 2 MB";
                    $contadorErrores++;
                }

                $tipoImagen = mime_content_type($imagen['tmp_name']);

                $tiposPermitidos = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!in_array($tipoImagen, $tiposPermitidos)) {
                    $errores['portada'] = "El archivo debe ser JPG, PNG o WEBP";
                    $contadorErrores++;
                }
            }
            if ($contadorErrores > 0) {
                $verificar = false;
            }
    
            return $verificar;
        
    }
