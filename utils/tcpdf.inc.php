<?php
require_once __DIR__ . '/vendor/autoload.php';

class PDF {
    public function generatePDF($data) {

        // return $data;

        $order = $data['order'];
        $order_items = $data['order_items'];

        // return $order_items;

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('HomeDrop');
        $pdf->SetAuthor('HomeDrop');
        $pdf->SetTitle('Factura de Orden');
        $pdf->SetSubject('Factura');
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Factura de Orden', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->Cell(30, 10, 'Orden #:', 0, 0);
        $pdf->Cell(0, 10, $order['ID_Order'], 0, 1);
        $pdf->Cell(30, 10, 'Fecha:', 0, 0);
        $pdf->Cell(0, 10, date('Y-m-d', strtotime($order['Order_Date'])), 0, 1);
        $pdf->Cell(30, 10, 'Total:', 0, 0);
        $pdf->Cell(0, 10, '$ ' . number_format($order['Total_Amount'], 2), 0, 1);
        $pdf->Ln(10);

        $pdf->Cell(50, 10, 'Producto', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Precio', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Total', 1, 1, 'C');

        // return $order_items;

        foreach ($order_items as $item) {
            $pdf->Cell(50, 10, $item['Calle'], 1, 0); 
            $pdf->Cell(30, 10, $item['Quantity'], 1, 0, 'C');
            $pdf->Cell(30, 10, '$ ' . number_format($item['Price'], 2), 1, 0, 'R');
            $pdf->Cell(30, 10, '$ ' . number_format($item['Quantity'] * $item['Price'], 2), 1, 1, 'R');
        }

        return $pdf->Output('', 'S');
    }
}
