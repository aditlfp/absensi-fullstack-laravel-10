<x-app-layout>
	<div class="flex">
		<x-main-menu>
			<span class="w-[19rem]">
				<ul class="menu menu-sm bg-base-200 rounded-lg w-full">
					<li><a>
					  List Menu
					</a></li>
					<li>
						{{-- absen --}}
					  <details close>
						<summary>
						<i class="ri-calendar-todo-line text-lg"></i>
						  Menu Absensi
						</summary>
						<ul>
						  <li><a>
							<i class="ri-list-check-3 text-lg"></i>
							Data Kehadiran
						  </a></li>
						  <li><a>
							<i class="ri-shield-user-line text-lg"></i>
							Data Izin
						  </a></li>
						</ul>
					  </details>
					  {{-- Lembuur --}}
					  <details close>
						<summary>
						<i class="ri-calendar-todo-line text-lg"></i>
						  Menu Lembur
						</summary>
						<ul>
						  <li><a>
							<i class="ri-list-check-3 text-lg"></i>
							Data Lembur
						  </a></li>
						</ul>
					  </details>
					</li>
				  </ul>
			</span>
		</x-main-menu>
		<x-main-div>
			
			<span class="p-2 mt-2 py-1 px-2 rounded-br-xl shadow-sm text-sm font-semibold text-white" style="background-color: #03a157;">Wellcomeback,
				Admin !!</span>
				
			<p class="text-center text-2xl uppercase font-bold">Toolbox Admin</p>
			<span>
				<div style="margin-bottom: 7rem" class=" flex items-start justify-center mx-5">
					<div class="grid grid-cols-4 grid-flow-row justify-items-center w-fit">
						{{-- menu user --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuUser">
								<button id="btnUser" class="btn btn-warning w-full mt-5"><i class="ri-folder-user-line text-lg"></i>Menu User</button>
							</div>
							<div id="user" class="hidden absolute">
								<div style="width: 17rem;">
									<span class=" flex flex-col justify-center gap-x-2 mx-2">
										<a href="{{ route('users.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-user-line text-lg"></i>Index
											User</a>
										<a href="{{ route('users.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-user-add-line text-lg"></i>Tambah
											User</a>
									</span>
								</div>
							</div>
						</div>
						{{-- end menu --}}
			
						{{-- menu devisi --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuDevisi">
								<button id="btnDevisi" class="btn btn-warning w-full mt-5"><i class="ri-group-2-line text-lg"></i> Menu Devisi</button>
							</div>
							<div id="devisi" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2">
										<a href="{{ route('devisi.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-team-line text-lg"></i> Index
											Devisi</a>
										<a href="{{ route('devisi.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											Devisi</a>
									</span>
								</div>
							</div>
						</div>
						{{-- end menu --}}
			
						{{-- menu client --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuClient">
								<button id="btnClient" class="btn btn-warning w-full mt-5"><i class="ri-p2p-line text-lg"></i> Menu Client</button>
							</div>
							<div id="client" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2">
										<a href="{{ route('data-client.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-user-5-line text-lg"></i> Index
											Client</a>
										<a href="{{ route('data-client.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											Client</a>
									</span>
								</div>
							</div>
						</div>
						{{-- end menu --}}
			
						{{-- menu shift --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuShift">
								<button id="btnShift" class="btn btn-warning w-full mt-5"><i class="ri-timer-line text-lg"></i> Menu Shift</button>
							</div>
							<div id="shift" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2">
										<a href="{{ route('shift.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-timer-flash-line text-lg"></i> Index
											Shift</a>
										<a href="{{ route('shift.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											Shift</a>
									</span>
								</div>
							</div>
						</div>
						{{-- end menu --}}
			
						{{-- Menu Ruangan --}}
						<div style="width: 17rem;">
							<div>
								<div class="flex justify-center px-2 btnRuangan">
									<a href="{{ route('ruangan.index') }}" class="btn btn-warning w-full mt-5"><i class="ri-door-open-line text-lg"></i> Index Ruangan</a>
								</div>
							</div>
						</div>
						{{-- End Menu Ruangan --}}
			
						{{-- Menu Point --}}
						<div style="width: 17rem;">
							<div>
								<div class="flex justify-center px-2 btnPoint">
									<a href="{{ route('point.index') }}" class="btn btn-warning w-full mt-5"><i class="ri-coins-line text-lg font-normal"></i> Index Point</a>
								</div>
							</div>
						</div>
						{{-- End Menu Ruangan --}}
			
						{{-- Menu area --}}
						<div style="width: 17rem;">
							<div>
								<div class="flex justify-center px-2 btnArea">
									<a href="{{ route('area.index') }}" class="btn btn-warning w-full mt-5"><i class="ri-map-pin-2-line text-lg"></i> Index Area</a>
								</div>
							</div>
						</div>
						{{-- End Menu area --}}
			
						{{-- menu kerjasama --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuKerjasama">
								<button id="btnKerjasama" class="btn btn-warning w-full mt-5"><i class="ri-shake-hands-line text-lg"></i> Menu Kerjasama</button>
							</div>
							<div id="kerjasama" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px]">
										<a href="{{ route('kerjasamas.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-hand-coin-line text-lg"></i> Index
											Kerjasama</a>
										<a href="{{ route('kerjasamas.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											Kerjasama</a>
									</span>
								</div>
							</div>
						</div>
						{{-- end menu --}}
			
						{{-- Menu Absen --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuAbsen">
								<button id="btnAbsen" class="btn btn-warning w-full mt-5"><i class="ri-calendar-todo-line text-lg"></i> Menu Absensi</button>
							</div>
							<div id="absen" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('admin.absen') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-list-check-3 text-lg"></i> Data
											Absensi</a>
										<a href="{{ route('data-izin.admin') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-shield-user-line text-lg"></i> Data
											Izin</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu Absen --}}
			
						{{-- Menu Perlengkapan --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuPerlengkapan">
								<button id="btnPerlengkapan" class="btn btn-warning w-full mt-5"><i class="ri-tools-line text-lg"></i> Menu Perlengkapan</button>
							</div>
							<div id="perlengkapan" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px]">
										<a href="{{ route('perlengkapan.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-hammer-line text-lg"></i> Index
											Perlengkapan</a>
										<a href="{{ route('perlengkapan.create') }}"
											class="btn-info hover:bg-sky-500  hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											Perlengkapan</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
			
						{{-- Menu Lembur --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuLembur">
								<button id="btnLembur" class="btn btn-warning w-full mt-5"><i class="ri-time-line text-lg"></i> Menu Lembur</button>
							</div>
							<div id="lembur" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('lemburList') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-hourglass-2-line text-lg"></i> Index
											Lembur</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
			
						{{-- Menu Jabatan --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuJabatan">
								<button id="btnJabatan" class="btn btn-warning w-full mt-5"><i class="ri-medal-line text-lg"></i> Menu Jabatan</button>
							</div>
							<div id="jabatan" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('jabatan.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-award-line text-lg"></i> Index
											Jabatan</a>
										<a href="{{ route('jabatan.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											Jabatan</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
			
						{{-- Menu holiday --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuHoliday">
								<button id="btnHoliday" class="btn btn-warning w-full mt-5 "><i class="ri-cup-line text-lg"></i> Menu hari libur</button>
							</div>
							<div id="holiday" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('holiday.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-flight-takeoff-line text-lg"></i> Index
											holiday</a>
										<a href="{{ route('holiday.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-add-line text-lg"></i> Tambah
											holiday</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
			
						{{-- Menu lokasi --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuLokasi">
								<button id="btnLokasi" class="btn btn-warning w-full mt-5"><i class="ri-road-map-line text-lg"></i> Menu Lokasi</button>
							</div>
							<div id="lokasi" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('lokasi.index') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-pin-distance-line text-lg"></i> Index
											Lokasi</a>
										<a href="{{ route('lokasi.create') }}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-map-pin-add-line text-lg"></i> Tambah
											lokasi</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
						{{-- Menu Jadwal --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuJadwal">
								<button id="btnJadwal" class="btn btn-warning w-full mt-5"><i class="ri-calendar-event-line text-lg"></i> Menu Jadwal</button>
							</div>
							<div id="jadwal" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('admin-jadwal.index')}}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-calendar-2-line text-lg"></i> Index
											Jadwal User</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
						{{-- Menu Laporan --}}
						<div style="width: 17rem;">
							<div class="flex justify-center px-2 menuLaporan">
								<button id="btnLaporan" class="btn btn-warning w-full mt-5"><i class="ri-task-line text-lg"></i> Menu Laporan</button>
							</div>
							<div id="laporan" class="hidden absolute">
								<div style="width: 17rem;">
									<span class="flex flex-col justify-center gap-x-2 mx-2 pb-[148px] ">
										<a href="{{ route('laporan.index')}}"
											class="btn-info hover:bg-sky-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s"><i class="ri-calendar-2-line text-lg"></i> Index
											Laporan</a>
									</span>
								</div>
							</div>
						</div>
						{{-- End Menu --}}
					</div>
				</div>
		
				<div>
					@php
						$mytime = Carbon\Carbon::now()->isoFormat('dddd, D/MMMM/Y');
					@endphp
					<div class="bg-lime-400 font-semibold shadow mt-5 rounded-tr-md" style="width: 29%;">
						<div class="grid grid-cols py-1">
						<span class="mx-3 pt-2">Status Website : <span class="badge badge-info overflow-hidden" id="uptime"></span></span>
							<span class="mx-3">Jumlah Karyawan : {{ $user }}</span>
							<span class="mx-3">Jumlah Mitra : {{ $client }}</span>
							<span class="mx-3 flex flex-col items-center textarea textarea-bordered text-center">
								<span>Created And Development </span>
									<span>
										<span>
											<a href="https://github.com/aditlfp" target="_blank">
												<i class="ri-github-fill text-xl"></i>aditlfp</a>
										</span>
										<span>
											<a href="https://github.com/syafi-M" target="_blank">
												<i class="ri-github-fill text-xl"></i> syafi-M</a>
										</span>
									</span>
							</span>
						</div>
					</div>
				</div>
			</span>
		</x-main-div>
		
	</div>
	<script>
		$(document).ready(function() {
    		function updateUptime() {
                $.get('/get-uptime', function(data) {
                    $('#uptime').text("Running : " + data.uptime);
                });
            }
        
            // Mulai pembaruan secara berkala (misalnya, setiap 5 detik)
            setInterval(updateUptime, 1000); // 5000 milidetik = 5 detik
    		});
	</script>
</x-app-layout>
