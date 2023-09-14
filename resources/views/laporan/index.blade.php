<x-app-layout>
	<x-main-div>

		<div>
			<p class="text-center text-2xl font-bold py-10 uppercase">Index Laporan</p> 
		</div>
		<div class="flex justify-end">
			<div class="input flex w-fit mx-10 items-center justify-end mb-5 input-bordered">
				<i class="ri-search-2-line"></i>
				<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
			</div>
		</div>

		<div class="overflow-x-auto mx-5">
			<table class="table table-zebra table-xs sm:table-md bg-slate-50 w-full" id="searchTable">
				<!-- head -->
				<thead>
					<tr>
						<th class="bg-slate-300 rounded-tl-2xl">#</th>
						<th class="bg-slate-300">Sebelum</th>
						<th class="bg-slate-300 px-3">Proses</th>
						<th class="bg-slate-300">Sesudah</th>
						<th class="bg-slate-300 ">Nama</th>
						<th class="bg-slate-300 ">Mitra</th>
						<th class="bg-slate-300 ">Ruangan</th>
						@if (Auth::user()->role_id == 2)
							<th class="bg-slate-300 ">Keterangan</th>
							<th class="bg-slate-300 rounded-tr-2xl">Action</th>
						@else
							<th class="bg-slate-300 rounded-tr-2xl">Keterangan</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@forelse ($laporan as $i)
						<tr>
							<td>{{ $no++ }}</td>
							@if ($i->image == 'no-image.jpg')
								<td>
									<x-no-img />
								</td>
							@else
								<td><img src="{{ asset('storage/images/' . $i->image1) }}" alt="" srcset="" width="100px">
								</td>
							@endif
							@if ($i->image2 == null)
								<td>
									<x-no-img />
								</td>
							@else
								<td><img src="{{ asset('storage/images/' . $i->image2) }}" alt="" srcset="" width="100px">
								</td>
							@endif
							<td><img src="{{ asset('storage/images/' . $i->image3) }}" alt="" srcset="" width="100px"></td>
							<td>{{ $i->user->nama_lengkap }}</td>
							<td>{{ $i->client->name }}</td>
							<td>{{ $i->ruangan->nama_ruangan }}</td>
							<td>{{ $i->keterangan }}</td>
							@if (Auth::user()->role_id == 2)
								<td>
									<form action="{{ url('laporans/' . $i->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<x-btn-submit></x-btn-submit>
									</form>
								</td>
							@else
							@endif
						</tr>
					@empty
						<tr>
							<td colspan="8" class="text-center">Laporan Saat Ini Kosong</td>
						</tr>
					@endforelse
				</tbody>
			</table>

		</div>
		<div>
			<div class="flex justify-center sm:justify-end my-3 gap-2 mr-0 sm:mr-9">
				<a href="{{ route('dashboard.index') }}"
					class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
				<a href="{{ route('laporan.create') }}"
					class="btn btn-warning hover:bg-yellow-600 border-none transition-all ease-in-out .2s">+ Laporan</a>

			</div>
	</x-main-div>
</x-app-layout>
