<x-app-layout>
	<x-main-div>
		<div class="py-10">
            <div class="flex justify-center mb-10">
                <div class="bg-slate-400 shadow-inner rounded-lg py-2 px-10 w-fit">
                    <p class="text-center text-white font-semibold">Riwayat,</p>
                    <p class="text-center text-white font-bold text-lg underline underline-offset-2">{{ $user->nama_lengkap }}</p>
                </div>
            </div>
			<p class="text-center text-xl sm:text-2xl uppercase pb-10 font-bold ">Riwayat kehadiran</p>
			<div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
				<div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
					<table class="table w-full table-xs bg-slate-50 table-zebra sm:table-md text-sm sm:text-md scale-90 md:scale-90">
						<thead>
							<tr>
								<th class="bg-slate-300 rounded-tl-2xl">#</th>
								<th class="bg-slate-300 px-7">Shift</th>
								<th class="bg-slate-300 px-7">Tanggal</th>
								<th class="bg-slate-300">Absen Masuk</th>
								<th class="bg-slate-300">Absen Keluar</th>
								<th class="bg-slate-300 rounded-tr-2xl">Status</th>
							</tr>
						</thead>
						<tbody>
							@php
								$no = 1;
							@endphp
							@forelse ($absensi as $arr)
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $arr->shift->shift_name }}</td>
									<td>{{ $arr->tanggal_absen }}</td>
									<td>{{ $arr->absensi_type_masuk }}</td>
									{{-- Handle Absensi Type Pulang --}}
									<td>
										@if ($arr->absensi_type_pulang == null)
											<span class="text-red-500 underline font-bold">Belum Absen Pulang</span>
										@else
											{{ $arr->absensi_type_pulang }}
										@endif
									</td>
									{{-- End Handle Absensi Type Pulang --}}

									{{-- Handle Keterangan --}}
									<td>
										@if ($arr->keterangan == 'masuk')
											<div class="badge badge-success gap-2 overflow-hidden">

												{{ $arr->keterangan }}
											</div>
										@elseif ($arr->keterangan == 'izin')
											<div class="badge badge-warning gap-2 overflow-hidden">

												{{ $arr->keterangan }}
											</div>
										@else
											<div class="badge badge-error gap-2 overflow-hidden">

												{{ $arr->keterangan }}
											</div>
										@endif
									</td>

								</tr>
							@empty
								<tr>
									<td class="text-center">~ Kosong ~</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div id="pag-1" class="mt-5 mb-5 mx-10">
					{{ $absensi->links() }}
				</div>
			</div>
	<div>
		<p class="text-center text-xl sm:text-2xl font-bold py-10 uppercase">Riwayat Laporan</p>
	</div>
	<div class="overflow-x-auto mx-5">
		<table class="table table-zebra table-xs sm:table-md bg-slate-50 w-full scale-90 md:scale-90" id="searchTable">
			<!-- head -->
			<thead>
				<tr>
					<th class="bg-slate-300 rounded-tl-2xl">#</th>
					<th class="bg-slate-300">Sebelum</th>
					<th class="bg-slate-300 px-3">Proses</th>
					<th class="bg-slate-300">Sesudah</th>
					<th class="bg-slate-300 ">Ruangan</th>

					<th class="bg-slate-300 rounded-tr-2xl">Keterangan</th>
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
						<td>{{ $i->ruangan->nama_ruangan }}</td>
						<td>{{ $i->keterangan }}</td>

					</tr>
				@empty
					<tr>
						<td colspan="8" class="text-center">Laporan Saat Ini Kosong</td>
					</tr>
				@endforelse
			</tbody>
		</table>
		<div id="pag-1" class="mt-5 mb-5 mx-10">
			{{ $laporan->links() }}
		</div>
	</div>
	<div class="flex justify-center sm:justify-end ">
		<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
	</div>
	</x-main-div>

</x-app-layout>
