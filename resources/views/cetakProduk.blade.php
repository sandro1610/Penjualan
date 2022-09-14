<!DOCTYPE html>
<html>
<head>
	<title>Produk Bulan Ini</title>
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
				<th>Jenis Produk</th>
				<th>Nama Produk</th>
				<th>Stok Awal</th>
				<th>Terjual</th>
				<th>Stok Akhir</th>
				<th>Cluster</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($tampil_produk as $produk)
				<tr>
					@php
						if ($produk->id_jenis == 1) {
							$jenis = 'Kebutuhan bayi';
						} elseif ($produk->id_jenis == 2) {
							$jenis = 'Makanan ringan';
						} elseif ($produk->id_jenis == 3) {
							$jenis = 'Makanan instan';
						} elseif ($produk->id_jenis == 4) {
							$jenis = 'Minuman';
						} elseif ($produk->id_jenis == 5) {
							$jenis = 'Kebutuhan Pokok';
						}
					@endphp
					@php
						if ($produk->cluster == 'C1') {
							$clus = 'Penjualan Tinggi';
						} elseif ($produk->cluster == 'C2') {
							$clus = 'Penjualan Rendah';
						}
					@endphp
					<td>{{ $produk->no_produk }}</td>
					<td>{{ $jenis }}</td>
					<td>{{ $produk->nama_produk }}</td>
					<td>{{ $produk->stok_awal }}</td>
					<td>{{ $produk->terjual }}</td>
					<td>{{ $produk->stok_kardus }}</td>
					<td>{{ $clus }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>










