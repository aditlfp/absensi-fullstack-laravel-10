<x-app-layout>
	<x-main-div>
		<div class="py-10">
			<p class="text-center text-2xl uppercase font-bold">History absensi</p>
			<div class="flex flex-col items-center mx-2 my-2 justify-center ">
				<div class="overflow-x-scroll md:overflow-hidden w-full">
					<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-10">Back</a>
					<table class="table w-full text-sm sm:text-md scale-100 md:scale-90">
						<thead>
							<tr>
								<th>#</th>
								<th>Shift</th>
								<th>Absen Masuk</th>
								<th>Absen Keluar</th>
								<th>Status</th>
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
									<td>{{ $arr->absensi_type_masuk }}</td>
									@if ($arr->keterangan == 'izin')
										<td>
											<div class="badge badge-warning overflow-hidden">
												Izin
											</div>
										</td>
									@elseif($arr->absensi_type_pulang == null)
										<td class="text-red-500 font-bold underline">Belum Absen Pulang</td>
									@else
										<td>{{ $arr->absensi_type_pulang }}</td>
									@endif
									@if ($arr->shift_id == 1)
										@if ($arr->keterangan == 'izin')
											<td>
												<div class="badge badge-warning overflow-hidden">
													Izin
												</div>
											</td>
										@elseif ($arr->absensi_type_masuk <= '08:00:00')
											<td>
												<div class="badge badge-success overflow-hidden">
													Masuk
												</div>
											</td>
										@else
											<td>
												<div class="badge badge-error gap-2 overflow-hidden">
													Telat
												</div>
											</td>
										@endif
									@elseif($arr->shift_id == 2)
										@if ($arr->keterangan == 'izin')
											<td>
												<div class="badge badge-warning overflow-hidden">
													Izin
												</div>
											</td>
										@elseif ($arr->absensi_type_masuk <= '14:00:00')
											<td>
												<div class="badge badge-success overflow-hidden">
													Masuk
												</div>
											</td>
										@else
											<td>
												<div class="badge badge-error gap-2 overflow-hidden">
													Telat
												</div>
											</td>
										@endif
									@else
										<td>
											<div class="badge badge-error gap-2 overflow-hidden">
												Telat
											</div>
										</td>
									@endif

								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
			<div id="pag-1" class="hidden mb-5 mx-5">
				{{ $absen->links() }}
			</div>
		</div>
</x-main-div>
</x-app-layout>
