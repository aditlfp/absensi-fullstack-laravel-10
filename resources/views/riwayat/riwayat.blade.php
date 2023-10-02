<x-app-layout>
	<x-main-div>
		<div class="py-10">
			<div>
				<p class="text-center text-lg sm:text-2xl font-bold uppercase">Index Riwayat</p>
			</div>
			<div class="flex flex-col gap-2 mx-5 mt-5">
				{{-- absensi --}}
				<div id="btnIzin"
					class="col-span-2 w-full flex justify-center text-white items-center gap-2 bg-[#3A4F50] rounded-md py-2 px-4 hover:bg-[#3A4F50]/80 hover:text-gray-800 transition-all ease-linear .2s">
					<i class="ri-todo-line text-xl"></i>
					<a href="{{ url('historyAbsensi') }}" class="uppercase font-semibold text-sm  text-slate-100/90">
						Riwayat Kehadiran
					</a>
				</div>
				{{-- lembur --}}
				<div id="btnIzin"
					class="col-span-2 w-full flex justify-center text-white items-center gap-2 bg-[#3A4F50] rounded-md py-2 px-4 hover:bg-[#3A4F50]/80 hover:text-gray-800 transition-all ease-linear .2s">
					<i class="ri-todo-line text-xl"></i>
					<a href="{{ route('lemburIndexUser') }}" class="uppercase font-semibold text-sm  text-slate-100/90">
						Riwayat Lembur
					</a>
				</div>
				{{-- izin --}}
				<div id="btnIzin"
					class="col-span-2 w-full flex justify-center text-white items-center gap-2 bg-[#3A4F50] rounded-md py-2 px-4 hover:bg-[#3A4F50]/80 hover:text-gray-800 transition-all ease-linear .2s">
					<i class="ri-todo-line text-xl"></i>
					<a href="{{ route('izin.index') }}" class="uppercase font-semibold text-sm  text-slate-100/90">
						Riwayat Izin
					</a>
				</div>
				{{-- laporan --}}
				<div id="btnIzin"
					class="col-span-2 w-full flex justify-center text-white items-center gap-2 bg-[#3A4F50] rounded-md py-2 px-4 hover:bg-[#3A4F50]/80 hover:text-gray-800 transition-all ease-linear .2s">
					<i class="ri-todo-line text-xl"></i>
					<a href="{{ route('laporan.index') }}" class="uppercase font-semibold text-sm  text-slate-100/90">
						Riwayat Laporan
					</a>
				</div>
				{{-- CP --}}
				<div id="btnIzin"
					class="col-span-2 w-full flex justify-center text-white items-center gap-2 bg-[#3A4F50] rounded-md py-2 px-4 hover:bg-[#3A4F50]/80 hover:text-gray-800 transition-all ease-linear .2s">
					<i class="ri-todo-line text-xl"></i>
					<a href="{{ route('checkpoint-user.index') }}" class="uppercase font-semibold text-sm  text-slate-100/90">
						Riwayat Check Point
					</a>
				</div>
			</div>
            <div class="flex justify-center sm:justify-end mt-5">
				<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Kembali</a>
			</div>
		</div>
	</x-main-div>
</x-app-layout>
