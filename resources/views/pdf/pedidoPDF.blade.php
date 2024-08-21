<!DOCTYPE html>
<html>
<head>
    <title>Pedido {{ $pedido->codigo_pedido }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pedido {{ $pedido->codigo_pedido }}</h1>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre_producto }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->precio, 2) }}</td>
                        <td>${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p><strong>Subtotal:</strong> ${{ number_format($pedido->subtotal, 2) }}</p>
            <p><strong>IVA:</strong> ${{ number_format($pedido->iva, 2) }}</p>
            <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
        </div>
    </div>
</body>
</html>
