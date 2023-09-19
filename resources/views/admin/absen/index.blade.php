<x-app-layout>
	<x-main-div>
		<div class="py-10">
			<p class="text-center text-2xl font-bold py-5 uppercase">Data Absensi</p>
			<div class="flex justify-between items-center mx-10">
			    <div class="flex justify-between items-center w-full">
    			    <div>
    					<form id="filterForm" action="{{ route('admin.absen') }}" method="GET" class="p-1 flex">
    						<select name="filterKerjasama" id="filterKerjasama" class="select select-bordered active:border-none border-none">
    							<option selected disabled>~ Kerja Sama ~</option>
    							@foreach ($absenSi as $i)
    								<option value="{{ $i->id }}">{{ $i->client->name }}</option>
    							@endforeach
    						</select>
    						<div>
    						<button type="submit"
    							class="bg-blue-500 px-5 py-2 rounded-md hover:bg-blue-600 transition-colors ease-in .2s font-bold uppercase ml-3">Filter</button>
    					        <a href="{{ route('admin.index') }}" class="btn btn-error py-1">back</a>
    						</div>
    					</form>
    				</div>
    				<div>
            			<form method="GET" action="{{route('admin.export')}}">
            			    <div class="flex items-center">
            			        <!--LIBUR-->
                				<div>
                				    <input type="text" name="libur" class="input input-bordered" placeholder="Hari libur untuk semua.."/>
                			    </div>
                			    <div class="flex justify-end mx-10 mb-2 ">
                			    <button type="submit"
                					class="bg-yellow-400 px-4 py-2 shadow rounded-md flex flex-col items-center">
                			        <i class="ri-file-download-line text-2xl"></i>
                			        <span class="text-sm">All</span>
                				</button>
                			    </div>
            			    </div>
            			</form>
    				</div>
			    </div>
			</div>	
			
				<form method="GET" action="{{route('admin.exportV2')}}">
			        <div class="flex items-center justify-center mx-10">
			            <div class="flex items-center gap-2">
        					    <div class="mr-5">
        						    <select name="kerjasama_id" id="selectInput" style="width: 10rem;" class="text-md py-2 rounded-lg bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
        						        <option disabled selected>Pilih Mitra</option>
        						        @forelse ($absenSi as $i)
        						        <option value="{{ $i->id}}" class="break-words whitespace-pre-wrap">{{ $i->client->name }}</option>
        						        @empty
        						        <option >~Kosong~</option>
        						        @endforelse
        					        </select>
        				        </div>
    			                <div class="flex mr-2">
    					            <div class="mr-2">
    						            <input type="date" name="str1" id="str1" placeholder="Tanggal Mulai"
    							            class="text-md block px-3 py-2 rounded-lg bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
    				                </div>
        					        <div class="ml-2">
        						         <input type="date" name="end1" id="end1"
        							        class="text-md block px-3 py-2 rounded-lg bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
        					        </div>
    			                </div>
			                <div class="flex justify-between items-center">
    					        <div class="mr-2">
        						    <select name="divisi_id" class="text-md block px-10 py-2 rounded-lg bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
        						        <option disabled selected>Pilih Divisi</option>
        						        @forelse($divisi as $i)
        						        <option value="{{$i->id}}">{{$i->name}}</option>
        						        @empty
        						        <option >~Kosong~</option>
        						        @endforelse
        						    </select>
    					        </div>
    						    <!--LIBUR-->
            				    <div>
            				        <input type="text" name="libur" class="input input-bordered" placeholder="Masukkan hari libur"/>
            					</div>
        						<div class="flex mx-10 mb-2 ">
        						    <button type="submit" class="bg-yellow-400 px-3 py-2 shadow rounded-md text-2xl">
        								<i class="ri-file-download-line"></i>
        						    </button>
        						</div>
			                </div>
				        </div>
                </form>
			</div>
			<div class="flex justify-end items-center mr-10 mt-5">
				<x-search/>
			</div>
			
			<div class="overflow-x-auto mx-10 my-10">
				<table class="table table-zebra w-full bg-slate-50" id="searchTable">
					<thead>
						<tr>
							<th class="bg-slate-300 rounded-tl-2xl">#</th>
							<th class="bg-slate-300 ">Photo</th>
							<th class="bg-slate-300 ">Nama User</th>
							<th class="bg-slate-300 px-10">Tanggal</th>
							<th class="bg-slate-300 ">Shift</th>
							<th class="bg-slate-300 ">Client</th>
							<th class="bg-slate-300 ">Jam Masuk</th>
							<th class="bg-slate-300 ">Jam Pulang</th>
							<th class="bg-slate-300 ">Keterangan</th>
							<th class="bg-slate-300 rounded-tr-2xl">Point</th>
						</tr>
					</thead>
					<tbody>
						@php
							$no = 1;
						@endphp
					@forelse ($absen as $arr)
							<tr>
								<td>{{ $no++ }}</td>
								<td><img class="lazy lazy-image" loading="lazy" src="{{asset('storage/images/'.$arr->image)}}" data-src="{{asset('storage/images/'.$arr->image)}}" alt="data-absensi-image" width="120px"/></td>
								<td class="break-words whitespace-pre-line">{{ $arr->user?$arr->user->nama_lengkap : $arr->user_id . 'AKU KOSONG' }}</td>
								<td>{{ $arr->tanggal_absen }}</td>
								@if($arr->shift != null)
								<td id="mitra">{{ $arr->shift->shift_name }}</td>
					            @else
					            <td class="break-words whitespace-pre-wrap text-red-500 font-semibold">Shift Kosong</td>
					            @endif
								<td class="break-words whitespace-pre-line">{{ $arr->kerjasama->client->name }}</td>
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

									<td>
										@if ($arr->keterangan != 'telat' && $arr->keterangan != 'izin')
											<form action="{{ route('claim.point', $arr->id) }}" method="POST">
											@csrf
											@method('PATCH')
											@forelse ($point as $item)
											
											    @if($arr->kerjasama->client_id == $item->client_id && $arr->point_id != null)
													{{ $arr->point->sac_point }}
												@endif
											@if($arr->point_id == null)
												<input type="text" name="point_id" id="point_id" value="{{ $item->id }}" class="hidden">
												<button class="px-2 py-1 w-16 rounded bg-amber-400" type="submit">+ Point</button>
											@break
											@endif
											
											@empty
												~
											@endforelse
																						    
											</form>
										@else
											
										@endif
									</td>

							</tr>
							@empty
							<tr>
								<td colspan="10" class="text-center">~ Kosong ~</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="mt-4 mx-10 ">
    				{{ $absen->links()}}
			</div>
		</div>
	</x-main-div>
	<script>
		$(document).ready(function () {
		// Saat halaman dimuat, ambil semua elemen dengan class "lazy-image"
		var lazyImages = $('.lazy-image');
	
		// Fungsi untuk memuat gambar ketika mendekati jendela pandangan pengguna
		function lazyLoad() {
			lazyImages.each(function () {
				var image = $(this);
				if (image.is(':visible') && !image.attr('src')) {
					image.attr('src', image.attr('data-src'));
				}
			});
		}
	
		// Panggil fungsi lazyLoad saat halaman dimuat dan saat pengguna menggulir
		lazyLoad();
		$(window).on('scroll', lazyLoad);
	});
	</script>
</x-app-layout>
