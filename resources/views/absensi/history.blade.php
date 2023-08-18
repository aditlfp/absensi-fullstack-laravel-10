<x-app-layout> 
	<x-main-div>
		<div class="py-10">
			<p class="text-center text-2xl uppercase font-bold text-white">Riwayat absensi Saya</p>
			<div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
				<div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
					<table class="table w-full table-xs sm:table-md text-sm sm:text-md scale-90 md:scale-90">
						<thead>
							<tr>
								<th class="hidden sm:block">#</th>
								<th>Shift</th>
								<th>Tanggal</th>
								<th>Absen Masuk</th>
								<th>Absen Keluar</th>
								<th>Status</th>
								<th>Poin</th>
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
									<td class="hidden sm:block">{{ $no++ }}</td>
									<td>{{ $arr->shift->shift_name }}</td>
									<td>{{ $arr->tanggal_absen }}</td>
									<td>{{ $arr->absensi_type_masuk }}</td>
									{{-- Handle Absensi Type Pulang --}}
								<td>
									@if ($arr->absensi_type_pulang == null)										
										<span class="text-red-500 underline font-bold">Belum Absen Pulang</span>
									@else
										{{ $arr->absensi_type_pulang}}
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
                            
                            
                            {{-- Handle Point Samping --}}
							@if($arr->point_id != null)
							    <td>
							        	{{ $arr->point->sac_point}}

							    </td>
							@else
							    <td class="text-red-500">0</td>
							@endif
								</tr>
							@endif
							{{-- EndHandle Point Samping --}}
						@endforeach
					</tbody>
				</table>
			</div>
				<span class=" bg-white p-4 rounded-md">
				    @forelse($absen as $arr)
					            @if($arr->point_id != null)
							        	@php
										    $p = $arr->point->sac_point;
										    $kali = $point->count();
										@endphp
                                        @if($arr->point_id != null)
										    Total point anda <span class="underline font-semibold text-green-500">{{ $kali * $p }}</span>
										@else
										    Total point anda <span class="underline font-semibold text-green-500">0</span>
										@endif
							    @break
							   
							    @endif
							    
							    @empty
							    @endforelse
				</span>
		</div>
			<div id="pag-1" class="mt-5 mb-5 mx-10">
				{{ $absen->links() }}
			</div>
		<div class="flex justify-end">
		<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
	</div>
</x-main-div>
</x-app-layout>
