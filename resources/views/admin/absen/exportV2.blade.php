<!DOCTYPE html>
<html lang="en"> 

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<head>
	<style>
		*,
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		table,
		th,
		td {
			border: 1px solid black;
		}

		td {
			text-align: center;
		}

		th {
			background-color: rgb(19, 110, 170);
			color: white;
		}

		tr:nth-child(even) {
			background-color: #cbd5e1;
		}
	</style>
</head>

<main>
	<div class="title">
		<img class="hero" src="{{ $base64 }}" width="60px">
		<span class="sub-title" style="vertical-align: 20px; font-weight: bolder; font-size: 25px;">Rekab Absensi PT. Surya
			Amanah Cendekia</span>
	</div>
	<div class="table-wrapper">
		<table class="border">
			<thead>
				<tr>
					<th rowspan="2">No.</th>
					<th rowspan="2">Nama</th>
					<th colspan="{{ $totalHari + 1}}">Rekab Bulanan</th>
					<th colspan="5">Total</th>
				</tr>
				@php
					$starte = \Carbon\Carbon::createFromFormat('Y-m-d', $str1);
                    $ende = \Carbon\Carbon::createFromFormat('Y-m-d', $end1);
				@endphp
				<tr>
					@for ($date = $starte->copy(); $date->lte($ende); $date->addDay())
						<th>{{ $date->format('d') }}</th>
					@endfor
					<th>M</th>
					<th>I</th>
					<th>T</th>
					<th>L</th>
					<th>Persentase</th>
				</tr>
			</thead>
			<tbody>
				@php
                        $sortedData = collect($expPDF)->sortBy('user.nama_lengkap');
                        $previousUser = null;
                        $n = 1;
				@endphp
				@forelse ($sortedData as $data)
					@if ($previousUser != $data->nama_lengkap)
						<tr>
						    <!--Valid name cuy-->
							@php
								$previousUser = $data->nama_lengkap;
								$userAbsensi = collect($expPDF)->where('user', $data->user);
							@endphp
							<td>{{ $n++ }}</td>
							<td>{{ $data->nama_lengkap }}</td>
							@for ($date = $starte->copy(); $date->lte($ende); $date->addDay())
								@php
								    $absensi = $data->absensi->firstWhere('tanggal_absen', $date->format('Y-m-d'));
								    $keterangan = $absensi ? $absensi->keterangan : '-';
								@endphp
								    @if($keterangan == 'masuk')
								        <td style="background-color: rgb(112, 226, 112)">M</td>
								    @elseif($keterangan == 'izin')
								        <td style="background-color: rgb(250, 114, 65)">I</td>
								    @elseif($keterangan == 'telat')
								        <td style="background-color:rgb(202, 5, 5)">T</td>
								    @else
								        <td>-</td>
								    @endif
							@endfor
							@php
								$startDate = $user->min('created_at')->startOfMonth();
								$endDate = $user->max('created_at')->endOfMonth();

								$period = Carbon\CarbonPeriod::create($startDate, $endDate);
								$numberOfDays = $period->count();
								$m = $data->absensi->where('keterangan', 'masuk')->count();
								$z = $data->absensi->where('keterangan', 'izin')->count();
								$t = $data->absensi->where('keterangan', 'telat')->count();
								$total = $m + $z + $t;
								
								if ($total != 0) {
								    $total = round(100 / 26 * $m, 1) ;
								} else {
								    $total = '0';
								}
								
							@endphp
							<td id="masuk" style="background-color: #7dd3fc">{{ $m }}</td>
							<td id="izin" style="background-color: #7dd3fc">{{ $z }}</td>
							<td id="telat" style="background-color: #7dd3fc">{{ $t }}</td>
							<td id="libur" style="background-color: #7dd3fc">{{ $libur }}</td>
							@if($total >= 80)
							<td id="persen">{{ $total }}%</td>
							@else
							<td id="persen" style="background-color: rgb(250, 114, 65)">{{ $total }}%</td>
							@endif
						</tr>
					@endif
				@empty
					<td colspan="31" class="text-center">Kosong</td>
				@endforelse
			</tbody>
		</table>
	</div>

	<h2 style="padding-top: 10px">Keterangan</h2>

	<ul>
		<li><span class="box-color true"></span>M : Hadir</li>
		<li><span class="box-color false"></span> I : Izin</li>
		<li><span class="box-color false"></span> T : Telat</li>
		<li><span class="box-color false"></span> L : Libur</li>
		<li><span class="box-color false"></span> - : Kosong</li>
	</ul>

	<div style="right: 25px; position:absolute;">
		<span>Ponorogo, {{ Carbon\Carbon::now()->format('d-m-Y') }}</span>
		<span style="right: 0; top: 100px; left: 60px; position:absolute;">TTD</span>
	</div>
	<span style="right: 0; bottom: 150px; position:absolute;">PT. Surya Amanah Cendekia</span>
</main>

{{-- section jadwal user --}}
<section>

</section>
</body>

</html>
