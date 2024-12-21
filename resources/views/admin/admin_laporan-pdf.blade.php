<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Pengaturan umum */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Heading */
        h4 {
            font-size: 24px;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        /* Tabel styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        /* Styling untuk baris ganjil dan genap */
        tr:nth-child(odd) td {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) td {
            background-color: #ffffff;
        }

        /* Menambahkan hover effect pada baris tabel */
        tr:hover td {
            background-color: #dcdcdc;
        }

        /* Responsif pada layar kecil */
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 6px;
            }

            h4 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h4>Laporan Penjualan DEMANKCO</h4>
        <table>
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Nama Produk</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah Pesanan</th>
                    <th>Ukuran</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPendapatan = 0; // Variabel untuk menghitung total pendapatan
                @endphp
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->number_of_orders }}</td>
                        <td>{{ $order->list_size }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    @php
                        $totalPendapatan += $order->total_price; // Menjumlahkan total pendapatan
                    @endphp
                @endforeach
            </tbody>
            <!-- Baris Total Pendapatan -->
            <tfoot>
                <tr>
                    <td colspan="5"><strong>Total Pendapatan</strong></td>
                    <td colspan="2"><strong>Rp{{ number_format($totalPendapatan, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
