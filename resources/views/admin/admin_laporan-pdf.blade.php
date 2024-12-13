<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penjualan Demankco</title>
    <style>
        th, td{
            border: 1px solid black;
            padding: 2px;
        }
    </style>
</head>

<body>
	<div class="container" >
		<center>
			<h4>Laporan Penjualan DEMANKCO</h4>
		</center>
		<br/>
		<table style="text-align: center">
			<thead>
				<tr>
					<th>Id order</th>
					<th>Nama Produk</th>
					<th>Nama Pemesan</th>
					<th>Jumlah Pesanan</th>
					<th>Ukuran</th>
					<th>Harga</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($orders as $order)
				<tr>
					<td>{{ $order->order_id }}</td>
					<td>{{ $order->product_name }}</td>
					<td>{{ $order->name }}</td>
					<td>{{ $order->number_of_orders }}</td>
					<td>{{ $order->list_size }}</td>
					<td>{{ $order->total_price }}</td>
					<td>{{ $order->created_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
 
	</div>
 
</body>
</html>