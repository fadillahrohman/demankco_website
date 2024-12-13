<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="container">
		<center>
			<h4>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
			<h5><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-dompdf-laravel/">www.malasngoding.com</a></h5>
		</center>
		<br/>
		<table class='table table-bordered'>
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
					<td>{{ $order->id }}</td>
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