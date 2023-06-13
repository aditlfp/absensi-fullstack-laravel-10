<x-app-layout>
	<x-main-div>
		<p class="text-center text-2xl font-bold py-5 uppercase">Table Index</p>
		<div class="flex justify-end mx-10 mb-2 "><a href="{{ route('admin.export') }}"
				class="bg-yellow-400 px-4 py-2 shadow rounded-md text-2xl"><i class="ri-file-download-line"></i></a></div>
		<input type="search" id="searchInput"
			class="block shadow-md w-52 h-10 p-4 pl-10 text-sm text-dark border border-dark rounded-lg bg-white dark:bg-white dark:border-dark-600 dark:placeholder-dark dark:text-dark dark:focus:border-dark"
			placeholder="Search...." required>
		<div class="flex items-center justify-center flex-col mx-10">
			<table class="table w-full" id="searchTable">
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
	</x-main-div>
</x-app-layout>
