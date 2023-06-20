<x-app-layout>
	<x-main-div>
		<span class="p-2 bg-yellow-200 mt-2 py-1 px-2 rounded-br-xl shadow-sm text-sm font-semibold">Wellcomeback,
			Admin !!</span>
		<p class="text-center text-2xl uppercase font-bold">Toolbox Admin</p>
		<div class="flex justify-center mx-5">
			<div class="w-full">
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
			</div>
			<div class="w-full">
				{{-- menu kerjasama --}}
				<div class="flex justify-center px-2 menu3">
					<button id="menuKerjasama" class="btn btn-warning w-full mt-5">Menu Kerjasama</button>
				</div>
				<div id="kerjasama" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2">
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
				<div class="flex justify-center px-2 menu4">
					<button id="menuAbsen" class="btn btn-warning w-full mt-5">Menu Absensi</button>
				</div>
				<div id="absen" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2">
						<a href="{{ route('admin.absen') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Data
							Absensi</a>
						<a href="{{ route('admin.izin') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Data
							Izin</a>
					</div>
				</div>
				{{-- End Menu --}}
				{{-- Menu Perlengkapan --}}
				<div class="flex justify-center px-2 menu6">
					<button id="menuPerlengkapan" class="btn btn-warning w-full mt-5">Menu Perlengkapan</button>
				</div>
				<div id="perlengkapan" class="hidden">
					<div class="flex justify-center gap-x-2 mx-2">
						<a href="{{ route('perlengkapan.index') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Index
							Perlengkapan</a>
						<a href="{{ route('perlengkapan.create') }}"
							class="btn-warning hover:bg-yellow-500 hover:text-white w-full shadow-md hover:shadow-none text-center uppercase font-semibold text-sm rounded-md px-4 py-2 mt-5 transition-all ease-linear .2s">Tambah
							Perlengkapan</a>
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
				<span class="mx-3 pt-2">Status Website : {{ $mytime }}</span>
				<div class="grid grid-cols py-1">
					<span class="mx-3">user : {{ $user }}</span>
					<span class="mx-3">client : {{ $client }}</span>
					<span class="mx-3">Credit By : <a href="https://github.com/aditlfp" target="_blank"><i
								class="ri-github-fill"></i>aditlfp</a> | <a href="https://github.com/syafi-M" target="_blank"><i
								class="ri-github-fill"></i> syafi-M</a></span>
				</div>
			</div>
		</div>
	</x-main-div>
</x-app-layout>
