<?php
require 'vendor/autoload.php';

class PDF {
    public function generatePDF($data) {
        $order = $data['order'];
        $orderItems = $data['order_items'];

        if (empty($orderItems)) {
            return 'No hay artículos en la orden.';
        }

        // Configuración del documento PDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('HomeDrop');
        $pdf->SetAuthor('HomeDrop');
        $pdf->SetTitle('Factura de Orden');
        $pdf->SetSubject('Factura');
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->SetFillColor(221, 186, 107); // Color de fondo dorado
        $pdf->SetTextColor(51, 51, 51); // Color de texto oscuro

        // Añadir la página
        $pdf->AddPage();

        // Encabezado
        $pdf->SetFont('dejavusans', 'B', 16); // Fuente en negrita y tamaño 16
        $pdf->Cell(0, 20, 'Factura de Orden', 0, 1, 'C', true); // Relleno de color dorado
        $pdf->Ln(10);

        // Texto en lugar de la imagen
        $pdf->SetFont('dejavusans', '', 12); // Restablecer la fuente
        $pdf->WriteHTMLCell(0, 0, '', '', '<h1 style="font-size: 3em; color: #ddba6b; text-align: center;">H&#920;M&#926;DR&#920;P</h1>', 0, 1, false, true, '');
        $pdf->Ln(10);

        // Detalles de la orden
        $pdf->SetFontSize(12); // Tamaño de fuente 12
        $pdf->Cell(30, 10, 'Orden nº#:', 0, 0);
        $pdf->Cell(0, 10, $order['ID_Order'], 0, 1);
        $pdf->Cell(30, 10, 'Fecha:', 0, 0);
        $pdf->Cell(0, 10, date('Y-m-d', strtotime($order['Order_Date'])), 0, 1);
        $pdf->Cell(30, 10, 'Total:', 0, 0);
        $pdf->Cell(0, 10, number_format($order['Total_Amount'], 2). ' €', 0, 1);
        $pdf->Ln(10);

        // Encabezados de la tabla
        $pdf->SetFontSize(12); // Restablecer el tamaño de fuente
        $pdf->SetFillColor(51, 51, 51); // Color de fondo oscuro
        $pdf->SetTextColor(255, 255, 255); // Color de texto blanco
        $pdf->Cell(100, 10, 'Producto', 1, 0, 'C', true); // Relleno de color oscuro
        $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

        // Restablecer colores
        $pdf->SetFillColor(221, 186, 107);
        $pdf->SetTextColor(51, 51, 51);

        // Detalles de los productos
        foreach ($orderItems as $item) {
            $pdf->Cell(100, 10, $item['Calle'], 1, 0);
            $pdf->Cell(30, 10, $item['Quantity'], 1, 0, 'C');
            $pdf->Cell(30, 10,  number_format($item['Price'], 2). ' €', 1, 0, 'R');
            $pdf->Cell(30, 10, number_format($item['Quantity'] * $item['Price'], 2). ' €', 1, 1, 'R');
        }

        // Guardar el archivo PDF
        $pdfFilePath = SITE_ROOT . 'uploads/factura_orden_' . $order['ID_Order'] . '.pdf';
        $pdf->Output($pdfFilePath, 'F');

        return $pdfFilePath;
    }
}
