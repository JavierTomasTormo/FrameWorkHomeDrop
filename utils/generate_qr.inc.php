<?php

require_once 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Label;

class QRCodeGenerator
{
    public function generate($text, $filepath)
    {
        try {
            $qrCode = new QrCode($text);
            $qrCode->setSize(300);

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // Verifica si $result es un objeto válido antes de proceder
            if ($result === false) {
                throw new Exception('No se pudo generar el código QR');
            }

            // Guardar la imagen QR en el archivo especificado por $filepath
            file_put_contents($filepath, $result->getString());

            return $filepath;
        } catch (Exception $e) {
            // Log de errores para depuración
            error_log('Error en QRCodeGenerator: ' . $e->getMessage());
            return false;
        }
    }
}


