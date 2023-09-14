<x-app-layout>
    <x-main-div>
        <div class="py-10 sm:mx-10">
            <p class="text-center text-lg sm:text-2xl font-bold mb-10 uppercase">Index Jadwal Karyawan, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex justify-center sm:justify-end w-full">
                <x-search/>
            </div>
            @if(Auth::user()->role_id == 2)
                 <div class="flex sm:justify-end justify-center gap-2 mx-5 py-3 ">
                    <form action="{{ route('store.processDate.admin') }}" method="GET" class="flex flex-col justify-center gap-2 bg-slate-100 rounded px-5 py-3">
                        <div class="flex justify-between items-center flex-col sm:flex-row gap-2 ">
                            <div>
                                <label class="label text-xs sm:text-base">Mulai</label>
                                <input class="input input-bordered input-xs" type="date" name="str1" id="str1">
                            </div>
                            <div>
                                <label class="label text-xs sm:text-base">Selesai</label>
                                <input class="input input-bordered input-xs" type="date" name="end1" id="end1">
                            </div>
                            <div>
                                <label class="label text-xs sm:text-base">Pilih Mitra</label>
                                <select name="filter" class="select select-bordered w-full text-black select-xs">
                                    <option class="disabled">~Pilih Mitra~</option>
                                    @forelse($kerj as $i)
                                        <option value="{{ $i->id }}">{{ $i->client->name}}</option>
                                    @empty
                                        <option class="disabled">~Mitra Kosong~</option>
                                    @endforelse
                                </select>
                            </div>
                            <button><a class="btn btn-primary btn-sm sm:btn-md">+ Jadwal</a></button>
                        </div>
                        
                    </form>
    			</div>
    		@elseif(Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
    		
            @else
                <div class="flex sm:justify-end justify-center gap-2 mx-5 py-3 ">
                    <form action="{{ route('store.processDate') }}" method="GET" class="flex flex-col justify-center gap-2 bg-slate-100 rounded px-5 py-3">
                        <div class="flex justify-between flex-col md:flex-row gap-2 ">
                            <div>
                                <label class="label text-xs sm:text-base">Mulai</label>
                                <input class="input input-bordered input-xs" type="date" name="str1" id="str1">
                            </div>
                            <div>
                                <label class="label text-xs sm:text-base">Selesai</label>
                                <input class="input input-bordered input-xs" type="date" name="end1" id="end1">
                            </div>
                        </div>
                        <button><a class="btn btn-primary btn-sm sm:btn-md">+ Jadwal</a></button>
                        
                    </form>
    			</div>
            @endif
            
            <div class="flex justify-center mx-2 pb-10 text-xs">
                <div class="overflow-x-scroll md:overflow-hidden w-full">
                    <table class="table table-zebra table-lg bg-slate-50  shadow-md scale-[70%] text-xs md:text-base text-center" id="searchTable">
                        <thead class="text-slate-700">
                            <tr>
                                <th class="text-xs md:text-lg bg-slate-300 rounded-tl-2xl">#</th>
                                <th class="text-xs md:text-lg bg-slate-300 px-10">Nama Lengkap</th>
                                <th class="text-xs md:text-lg bg-slate-300 px-10">Tanggal</th>
                                <th class="text-xs md:text-lg bg-slate-300">Shift</th>
                                <th class="text-xs md:text-lg bg-slate-300 rounded-tr-2xl">Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($jadwalUser as $item)
                            @if ($item->user->kerjasama_id == Auth::user()->kerjasama_id)
                            <tr>
                                <td class="p-1">{{ $no++ }}</td>
                                <td class="p-1">{{ $item->user->nama_lengkap }}</td>
                                <td class="p-1 ">{{ $item->tanggal }}</td>
                                <td class="p-1">{{ $item->shift->shift_name }}</td>
                                <td class="p-1 flex justify-center items-center overflow-hidden"><span class="alert alert-info px-2 font-semibold text-slate-700">{{ $item->area }}</span></td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="5" class="text-center">Kosong</td>
                            </tr>
                            @break
                            @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5 mx-10">
                {{ $jadwalUser->links() }}
            </div>
            <div class="flex justify-center sm:justify-end my-5">
				<a href="{{ route('dashboard.index') }}" class="btn btn-error">Back</a>
            </div>
        </div>
    </x-main-div>
</x-app-layout>