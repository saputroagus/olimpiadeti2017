<!DOCTYPE html>
<html >
<head>
  <title>Tanda Bukti Pendaftaran Online</title>
	<meta name="google-site-verification" content="O8-KV_7a8Kihi6oQ4vfpEnYfjjPPCneV8sVkuRl1lSE" />
  <link rel="stylesheet" href="{{ asset('la-assets/css/pdf.css') }}">
</head>
<body>
	<header>
		<h1>Tanda Bukti Pendaftaran Online</h1>
		<img alt="" src="{{ asset('la-assets/img/pdf.jpg') }}">
	</header>
	<article>
		<address>
			<p style="color: red;">Kode Pendaftaran  : {{ $peserta->regnum }}</p>
			<p>Nomor Identitas : {{ $peserta->numid }}</p>
		</address>
		<table class="inventory">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Tanggal Lahir</th>
					<th>Asal Sekolah</th>
					<th>Nomor HP</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $peserta->nama }}</td>
					<td>{{ $peserta->gender }}</td>
					<td>{{ $peserta->birthdate }}</td>
					<td>{{ $peserta->school }}</td>
					<td>{{ $peserta->phone }}</td>
				</tr>
			</tbody>
		</table>
		<table class="meta">
			<tr>
				<th>Verifikator</th>
				<td>Fitri Febriyanti</td>
			</tr>
		</table>
	</article>
	<aside>
		<h1><span>Catatan</span></h1><ht>
		<div>
			<p>* Cetak bukti pendaftaran ini dan tukarkan dengan kartu peserta sebelum acara berlangsung</p>
		</div>
	</aside>
</body>
</html>
