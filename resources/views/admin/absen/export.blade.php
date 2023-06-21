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

		{{ }} {{ }} table,
		{{ }} th,
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
					<th rowspan="2">Nama</th>
					<th colspan="30">Rekab Bulanan</th>
					<th colspan="4">Total</th>
				</tr>
				<tr>
					@for ($i = 1; $i <= $totalHari; $i++)
						<th>{{ $i }}</th>
					@endfor
					<th>M</th>
					<th>I</th>
					<th>T</th>
					<th>Persentase</th>
				</tr>
			</thead>
			<tbody>
				@php
					$previousUser = null;
				@endphp
				@forelse ($dataAbsen as $data)
					@if ($previousUser != $data['user']->name)
						<tr>
							@php
								$previousUser = $data['user']->name;
								$userAbsensi = collect($dataAbsen)->where('user', $data['user']);
							@endphp
							<td>{{ $data['user']->name }}</td>
							@for ($i = 1; $i <= $totalHari; $i++)
								@php
									$tanggal = date('Y-m-') . $i;
									$absensi = $userAbsensi->firstWhere('tanggal_absen', $tanggal);
								@endphp
								@if ($absensi)
									@if ($absensi['keterangan'] == 'masuk')
										<td style="background-color: rgb(112, 226, 112)">M</td>
									@elseif ($absensi['keterangan'] == 'izin')
										<td style="background-color: rgb(250, 114, 65)">I</td>
									@elseif ($absensi['keterangan'] == 'telat')
										<td style="background-color:rgb(202, 5, 5)">T</td>
									@endif
								@else
									<td>-</td>
								@endif
							@endfor
							@php
								$startDate = $user->min('created_at')->startOfMonth();
								$endDate = $user->max('created_at')->endOfMonth();
								
								$period = Carbon\CarbonPeriod::create($startDate, $endDate);
								$numberOfDays = $period->count();
								$m = $data['user']->absensi->where('keterangan', 'masuk')->count();
								$z = $data['user']->absensi->where('keterangan', 'izin')->count();
								$t = $data['user']->absensi->where('keterangan', 'telat')->count();
								$total = $m + $z + $t;
								
								if ($total != 0) {
								    $total = round($m / $total, 2) * 100;
								} else {
								    $total = '0';
								}
								
							@endphp
							<td id="masuk">{{ $m }}</td>
							<td id="izin">{{ $z }}</td>
							<td id="telat">{{ $t }}</td>
							<td id="persen">{{ $total }}%</td>

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
		<li><span class="box-color false"></span> - : Kosong</li>
	</ul>

	<div style="right: 0; position:absolute;">
		<span>Ponorogo, {{ Carbon\Carbon::now()->format('d-m-Y') }}</span>
		<span style="right: 0; top: 100px; left: 60px; position:absolute;">TTD</span>
	</div>
	<span style="right: 0; bottom: 150px; position:absolute;">PT. Surya Amanah Cendekia</span>
</main>
</body>

</html>
