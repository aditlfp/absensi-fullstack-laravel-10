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
			<span class="sub-title" style="vertical-align: 20px; font-weight: bolder; font-size: 25px;">Laporan PT. Surya
				Amanah Cendekia</span>
		</div>
		<div style="text-align: center; margin: 16px auto 12px auto; font-size: 14px; ">
				<span style="display: inline-block; font-weight: bold;">
					{{ Auth::user()?Auth::user()->kerjasama->client->name:'PT SAC Ponrogo'}}
				</span>
			<br>
			<span style="text-align: center; display: inline-block;">{{ $starte->isoFormat('D-MMMM-Y') }} /
				{{ $ende->isoFormat('D-MMMM-Y') }}</span>
		</div>
		<div class="table-wrapper">
			<table class="border">
				<thead>
					<tr>
						<th rowspan="2">No.</th>
						<th rowspan="2">Nama</th>
						<th colspan="{{ $totalHari + 1 }}">Foto Progress Pekerjaan</th>
					</tr>
                    <tr>
                        <th>Before</th>
                        <th>Progress</th>
                        <th>After</th>
                        <th>Ruangan</th>
                        <th>Keterangan</th>
                    </tr>
				</thead>
				<tbody>
                    @php
                        $no = 1;
                    @endphp
					@forelse ($expPDF as $arr)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $arr->user->nama_lengkap}}</td>
                            <td><img src="{{ asset('storage/images/' . $arr->image1) }}" alt="no image" width="120px"></td>
                            @if ($arr->image2)
                                <td><img src="{{ asset('storage/images/' . $arr->image2) }}" alt="no image" width="120px"></td>
                            @elseif($arr->image2 != asset('storage/images/' . $arr->image2))
                                <td>
                                    <x-no-img />
                                </td>
                            @endif
                            <td><img src="{{ asset('storage/images/' . $arr->image3) }}" alt="no image" width="120px"></td>
                            <td>{{ $arr->ruangan->nama_ruangan}}</td>
                            <td>{{ $arr->keterangan}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td style="text-align: center">KOSONG</td>
                        </tr>
                    @endforelse
				</tbody>
			</table>
		</div>

	</main>
    {{-- <div style="text-align: end; margin: 30px 10px 0 0">
        <span style="">Ponorogo, {{ Carbon\Carbon::now()->format('d-m-Y') }}</span>
        <div style="margin-right: 50px">
            <span style="right: 0; top: 100px; left: 60px;">TTD</span>
        </div>
        <div>
            <span style="right: 0; bottom: 10rem;">PT. Surya Amanah Cendekia</span>
        </div>
    </div> --}}
<script>
	window.print();
</script>
</body>

</html>
