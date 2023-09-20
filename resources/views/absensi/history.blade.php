<x-app-layout>
	<x-main-div>
		<div class="py-10">
			<p class="text-center text-lg sm:text-2xl uppercase pb-10 font-bold ">Riwayat kehadiran Saya</p>
			<form action="{{ url('historyAbsensi') }}" method="GET" class="flex justify-center mx-2 sm:mx-10">
				<span class="p-4 rounded-md bg-slate-300">
					<label class="sm:mx-10 mx-5 label label-text font-semibold text-xs sm:text-base">Pilih Bulan</label>
					<div class="join  sm:mx-10 scale-[80%] sm:scale-100">
						<input type="month" placeholder="pilih bulan..." class="join-item input input-bordered" name="search"
							id="search" />
						<button type="submit" class="btn btn-info join-item">search</button>
					</div>
				</span>
			</form>
			<div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
				<div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
					<table class="table w-full table-xs bg-slate-50 table-zebra sm:table-md text-sm sm:text-md scale-90 md:scale-90">
						<thead>
							<tr>
								<th class="bg-slate-300 rounded-tl-2xl">#</th>
								<th class="bg-slate-300 px-7">Shift</th>
								<th class="bg-slate-300 px-7">Tanggal</th>
								<th class="bg-slate-300">Absen Masuk</th>
								<th class="bg-slate-300 px-5">Absen Keluar</th>
								<th class="bg-slate-300 rounded-tr-2xl">Status</th>
							</tr>
						</thead>
						<tbody>
							@php
								$no = 1;
							@endphp
							@foreach ($absen as $arr)
								@if (Auth::user()->id != $arr->user_id)
									@continue
									<tr>
										<td colspan="6" class="text-center">
											<div class="my-10 mx-3">
												<h2>Tidak Ada History Absen</h2>
											</div>
										</td>
									</tr>
								@break

							@else
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $arr->shift->shift_name }}</td>
									<td>{{ $arr->tanggal_absen }}</td>
									<td class="text-center">{{ $arr->absensi_type_masuk }}</td>
									{{-- Handle Absensi Type Pulang --}}
									<td class="text-center">
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
									{{-- EndHandle Keterangan --}}
							@endif
							{{-- EndHandle Point Samping --}}
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div id="pag-1" class="mt-5 mb-5 mx-10">
			{{ $absen->links() }}
		</div>
		<div class="flex justify-center sm:justify-end">
			<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Kembali</a>
		</div>
</x-main-div>
</x-app-layout>
