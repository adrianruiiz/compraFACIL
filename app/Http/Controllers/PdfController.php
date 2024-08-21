<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pedido;

class PdfController extends Controller
{
    public function exportToPdf($id)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.pedidoPDF', compact('pedido'));

        return $pdf->download('pedido-' . $pedido->codigo_pedido . '.pdf');
    }
}
