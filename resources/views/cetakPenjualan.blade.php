<!DOCTYPE html>
<html>
<head>
	<title>Penjualan Bulan Ini</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No Produk</th>
				<th>Nama Produk</th>
				<th>Kardus</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($penjualan as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nama_produk}}</td>
				<td>{{$p->kardus}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>










