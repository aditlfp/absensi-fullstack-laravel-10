<x-app-layout>
	<x-main-div>
		<span class="p-2 bg-yellow-200 mt-2 py-1 px-2 rounded-br-xl shadow-sm text-sm font-semibold">Wellcomeback,
			Admin !!</span>
			
		<p class="text-center text-2xl uppercase font-bold">Toolbox Admin</p>
		<div class="flex justify-center  h-[30rem] mx-5">
			<div class="w-full overflow-y-hidden ">


				<div class="w-full overflow-y-hidden">
					{{-- menu user --}}
	
					<div class="flex justify-center px-2 menu1">
						<button id="menuUser" class="btn btn-warning w-full mt-5">Menu User</button>
					</div>
					<div id="user" class="hidden">
						<div class="flex justify-center gap-x-2 mx-2">
							<a href="{{ route('users.index') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
								User</a>
							<a href="{{ route('users.create') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
								User</a>
						</div>
					</div>
					{{-- end menu --}}
					{{-- menu devisi --}}
	
					<div class="flex justify-center px-2 menu5">
						<button id="menuDevisi" class="btn btn-warning w-full mt-5">Menu Devisi</button>
					</div>
					<div id="devisi" class="hidden">
						<div class="flex justify-center gap-x-2 mx-2">
							<a href="{{ route('devisi.index') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
								Devisi</a>
							<a href="{{ route('devisi.create') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
								Devisi</a>
						</div>
					</div>
					{{-- end menu --}}
	
					{{-- menu client --}}
					<div class="flex justify-center px-2 menu2">
						<button id="menuClient" class="btn btn-warning w-full mt-5">Menu Client</button>
					</div>
					<div id="client" class="hidden">
						<div class="flex justify-center gap-x-2 mx-2">
							<a href="{{ route('data-client.index') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
								Client</a>
							<a href="{{ route('data-client.create') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
								Client</a>
						</div>
					</div>
					{{-- end menu --}}
	
	
					{{-- menu client --}}
					<div class="flex justify-center px-2 menu8">
						<button id="menuShift" class="btn btn-warning w-full mt-5">Menu Shift</button>
					</div>
					<div id="shift" class="hidden">
						<div class="flex justify-center gap-x-2 mx-2">
							<a href="{{ route('shift.index') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
								Shift</a>
							<a href="{{ route('shift.create') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
								Shift</a>
						</div>
					</div>
					{{-- end menu --}}
	
					{{-- Menu Ruangan --}}
					<div>
						<div class="flex justify-center px-2 menu12">
							<a href="{{ route('ruangan.index')}}" class="btn btn-warning w-full mt-5">Ruangan</a>
						</div>
					</div>
					{{-- End Menu Ruangan --}}
	
					{{-- Menu Ruangan --}}
					<div>
						<div class="flex justify-center px-2 menu11">
							<a href="{{ route('point.index')}}" class="btn btn-warning w-full mt-5">Index Point</a>
						</div>
					</div>
					{{-- End Menu Ruangan --}}
	
				</div>
			</div>
			<div class="w-full">

				{{-- menu kerjasama --}}
				<div class="flex justify-center px-2 menu3">
					<button id="menuKerjasama" class="btn btn-warning w-full mt-5">Menu Kerjasama</button>
				</div>
				<div id="kerjasama" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2 pb-[148px]">
						<a href="{{ route('kerjasamas.index') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							Kerjasama</a>
						<a href="{{ route('kerjasamas.create') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
							Kerjasama</a>
					</div>
				</div>
				{{-- end menu --}}

				{{-- Menu Absen --}}
					{{-- Menu Absen --}}
					<div class="flex justify-center px-2 menu4">
						<button id="menuAbsen" class="btn btn-warning w-full mt-5">Menu Absensi</button>
					</div>
					<div id="absen" class="hidden">
						<div class="flex justify-center gap-x-2 mx-2 pb-[148px] ">
							<a href="{{ route('admin.absen') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Data
								Absensi</a>
							<a href="{{ route('admin.izin') }}"
								class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Data
								Izin</a>
						</div>
					</div>
				{{-- End Menu Absen --}}


				{{-- Menu Perlengkapan --}}
				<div class="flex justify-center px-2 menu6">
					<button id="menuPerlengkapan" class="btn btn-warning w-full mt-5">Menu Perlengkapan</button>
				</div>
				<div id="perlengkapan" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2 pb-[148px]">
						<a href="{{ route('perlengkapan.index') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							Perlengkapan</a>
						<a href="{{ route('perlengkapan.create') }}"
							class="btn-warning hover:bg-yellow-500  hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
							Perlengkapan</a>
					</div>
				</div>
				{{-- End Menu --}}

				{{-- Menu Lembur --}}
				<div class="flex justify-center px-2 menu7">
					<button id="menuLembur" class="btn btn-warning w-full mt-5">Menu Lembur</button>
				</div>
				<div id="lembur" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2 pb-[148px] ">
						<a href="{{ route('lemburList') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							Lembur</a>
					</div>
				</div>

				{{-- End Menu --}}
				{{-- Menu Jabatan --}}
				<div class="flex justify-center px-2 menu9">
					<button id="menuJabatan" class="btn btn-warning w-full mt-5">Menu Jabatan</button>
				</div>
				<div id="jabatan" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2 pb-[148px] ">
						<a href="{{ route('jabatan.index') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							Jabatan</a>
						<a href="{{ route('jabatan.create') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
							Jabatan</a>
					</div>
				</div>
				{{-- End Menu --}}
				{{-- Menu holiday --}}
				<div class="flex justify-center px-2 menu10">
					<button id="menuHoliday" class="btn btn-warning w-full mt-5">Menu hari libur</button>
				</div>
				<div id="holiday" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2 pb-[148px] ">
						<a href="{{ route('holiday.index') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							holiday</a>
						<a href="{{ route('holiday.create') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
							holiday</a>
					</div>
				</div>
				{{-- End Menu --}}
				
				{{-- Menu lokasi --}}
				<div class="flex justify-center px-2 menu13">
					<button id="menuLokasi" class="btn btn-warning w-full mt-5">Menu Lokasi</button>
				</div>
				<div id="lokasi" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2 pb-[148px] ">
						<a href="{{ route('lokasi.index') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							Lokasi</a>
						<a href="{{ route('lokasi.create') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
							lokasi</a>
					</div>
				</div>
				{{-- End Menu --}}
			</div>
		</div>

		<div>
			@php
				$mytime = Carbon\Carbon::now()->isoFormat('dddd, D/MMMM/Y');
			@endphp
			<div class="bg-lime-400 w-[25%] font-semibold shadow mt-5 rounded-tr-md">
				<div class="grid grid-cols py-1">
				<span class="mx-3 pt-2">Status Website :{{ $mytime }}</span>
					<span class="mx-3">user : {{ $user }}</span>
					<span class="mx-3">client : {{ $client }}</span>
					<span class="mx-3">Credit By : <a href="https://github.com/aditlfp" target="_blank"><i
								class="ri-github-fill"></i>aditlfp</a> | <a href="https://github.com/syafi-M" target="_blank"><i
								class="ri-github-fill"></i> syafi-M</a></span>
					<span></span><img href="https://www.animatedimages.org/cat-indonesia-flag-781.htm"><img src="https://www.animatedimages.org/data/media/781/animated-indonesia-flag-image-0001.gif" border="0" alt="animated-indonesia-flag-image-0001" class="border-none w-10 ml-5 rounded-r-full"/></span>
				</div>
			</div>
		</div>
	</x-main-div>
</x-app-layout>
