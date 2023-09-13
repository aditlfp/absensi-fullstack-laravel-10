<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>export, {{ Auth::user()->kerjasama->client->name }}</title>
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

		.page-break {
			page-break-before: always;
		}
	</style>
</head>

<body>
	<main>
		@php
			$starte = \Carbon\Carbon::createFromFormat('Y-m-d', $str1);
			$ende = \Carbon\Carbon::createFromFormat('Y-m-d', $end1);
		@endphp
		<div class="title">
			<img class="hero" src="{{ $base64 }}" width="60px">
			<span class="sub-title" style="vertical-align: 20px; font-weight: bolder; font-size: 25px;">Jadwal PT. Surya
				Amanah Cendekia</span>
			<span></span>
		</div>
		<div style="text-align: center; margin: 16px auto 12px auto; font-size: 14px; ">
			<span style="display: inline-block; font-weight: bold;">
			    @if(Auth::user()->divisi->jabatan->code_jabatan != 'LEADER')
			    @forelse($kerj as $i)
			        @if($i->id == $filter)
				        {{ $i->client->name }}
			        @endif
			    @empty
			    @endforelse
			    @else
			    {{ Auth::user()->kerjasama->client->name }}
			    @endif
			</span>
			<br>
			<span style="text-align: center; display: inline-block;">{{ $starte->isoFormat('D-MMMM-Y') }} /
				{{ $ende->isoFormat('D-MMMM-Y') }}</span>
		</div>
		<div>
			<table>
				<thead>
					<tr>
						<th rowspan="2">No.</th>
						<th rowspan="2">Nama lengkap</th>
						<th colspan="{{ $totalHari + 1 }}">Tanggal</th>
					</tr>

					<tr>
						@for ($date = $starte->copy(); $date->lte($ende); $date->addDay())
							<th class="p-2 bg-stone-300 border-r-slate-400 border-r-[1.1px]">{{ $date->format('d') }}</th>
						@endfor
					</tr>
				</thead>
				<tbody>
				@if(Auth::user()->divisi->jabatan->code_jabatan == 'MITRA' )
					@php
						$sortedData = collect($expPDF)->sortBy('user_id');
						$previousUser = null;
						$n = 1;
					@endphp
					@forelse ($sortedData as $data)
    					    @if ($previousUser != $data->nama_lengkap && Auth::user()->kerjasama_id == $data->kerjasama_id && $data->nama_lengkap != 'admin' && $data->nama_lengkap != 'user')
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
										$jadwal = $data->jadwalUser->firstWhere('tanggal', $date->format('Y-m-d'));
										$hasil = $jadwal ? $jadwal->status : 'off';
									@endphp
									@if ($hasil == 'M')
										<td>{{ $hasil }}</td>
									@else
										<td style="background-color: yellow;  font-size: 15px;">{{ $hasil }}</td>
									@endif
								@endfor
							</tr>
						@endif
					@empty
                        <h2>AKU KOSONG</h2>
					@endforelse
				@else
				    @php
						$sortedData = collect($expPDF)->sortBy('jadwalUser.user_id');
						$previousUser = null;
						$n = 1;
					@endphp
					@forelse ($sortedData as $data)
    					     @if ($previousUser != $data->nama_lengkap && Auth::user()->kerjasama_id == $data->kerjasama_id && $data->nama_lengkap != 'admin' && $data->nama_lengkap != 'user')
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
										$jadwal = $data->jadwalUser->firstWhere('tanggal', $date->format('Y-m-d'));
										$hasil = $jadwal ? $jadwal->status : 'off';
									@endphp
									@if ($hasil == 'M')
										<td>{{ $hasil }}</td>
									@else
										<td style="background-color: yellow;  font-size: 15px;">{{ $hasil }}</td>
									@endif
								@endfor
							</tr>
						@endif
					@empty
                        <h2>AKU KOSONG</h2>
					@endforelse
				@endif
				</tbody>
			</table>
		</div>
	</main>
</body>

</html>
