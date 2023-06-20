<x-app-layout>
	<x-main-div>
		<div class="py-10">
			<p class="text-center text-2xl font-bold py-5 uppercase">Data Absensi</p>
			<div class="flex justify-end mx-10 mb-2 "><a href="{{ route('admin.export') }}"
					class="bg-yellow-400 px-4 py-2 shadow rounded-md text-2xl"><i class="ri-file-download-line"></i></a>
			</div>
			<div class="flex justify-between mx-10 my-5">
				<a href="{{ route('admin.index') }}" class="btn btn-error">back</a>
				<div class="flex gap-4">
					<div class="flex items-center">
						<label for="">Mulai</label>
						<div>
							<input type="date" name="startDate" id="datepickers"
								class="text-md block px-3 py-2 rounded-lg bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
						</div>
						<label for="">Sampai</label>
						<div>
							<input type="date" name="endDate" id="datepickersV2"
								class="text-md block px-3 py-2 rounded-lg bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
						</div>
						<div class="flex justify-end mx-10 mb-2 "><a href=""
								onclick="this.href='/admin/exportV2/' + document.getElementById('datepickers').value + '/' + document.getElementById('datepickersV2').value"
								class="bg-yellow-400 px-4 py-2 shadow rounded-md text-2xl"><i class="ri-file-download-line"></i></a></div>
					</div>
					<div class="input">
						<x-search />
					</div>
				</div>

			</div>
			<div class="flex items-center justify-center flex-col mx-10">
				<table class="table table-zebra w-full" id="searchTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama User</th>
							<th>Shift</th>
							<th>Client</th>
							<th>Jam Masuk</th>
							<th>Jam Pulang</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						@php
							$no = 1;
						@endphp
						@foreach ($absen as $i)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $i->user->name }}</td>
								<td>{{ $i->shift->shift_name }}</td>
								<td>{{ $i->kerjasama->client->name }}</td>
								<td>{{ $i->absensi_type_masuk }}</td>
								@if ($i->keterangan == 'izin')
									<td class="underline text-red-600">izin</td>
								@else
									<td>{{ $i->absensi_type_pulang }}</td>
								@endif
								@if ($i->keterangan == 'izin')
									<td class="underline text-red-600">{{ $i->keterangan }}</td>
								@else
									<td>{{ $i->keterangan }}</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</x-main-div>
</x-app-layout>
