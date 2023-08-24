<x-app-layout>
    <x-main-div>
        <div class="py-10">
            <p class="text-center text-2xl font-bold mb-10 uppercase">Index Jadwal User</p>
            <div class="flex justify-end h-[35%] ml-10">
                <x-search/>
            </div>
            <div class="flex sm:justify-end justify-center gap-2 mx-5 py-3 ">
                <form action="{{ route('store.processDate') }}" method="GET" class="flex flex-col justify-center gap-2 bg-slate-100 rounded px-5 py-3">
                    <div class="flex justify-between flex-col gap-2 ">
                        <div>
                            <label class="label text-xs sm:text-base">Mulai</label>
                            <input class="input input-bordered input-xs" type="date" name="str1" id="str1">
                        </div>
                        <div>
                            <label class="label text-xs sm:text-base">Selesai</label>
                            <input class="input input-bordered input-xs" type="date" name="end1" id="end1">
                        </div>
                    </div>
                    <button><a class="btn btn-primary btn-xs sm:btn-md">+ Jadwal</a></button>
                </form>
			</div>
            <div class="flex justify-center overflow-x-auto mx-2 pb-10 text-xs">
                <table class="table table-auto shadow-md scale-[65%] text-xs" id="searchTable">
                    <thead>
                        <tr>
                            <th class="text-xs flex">#</th>
                            <th class="text-xs">Nama Lengkap</th>
                            <th class="text-xs">Tanggal</th>
                            <th class="text-xs">Shift</th>
                            <th class="text-xs">Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalUser as $item)
                           @if ($item->user->kerjasama_id == Auth::user()->kerjasama_id)
                           @php
                               $no = 1;
                           @endphp
                           <tr>
                              <td class="p-1">{{ $no++ }}</td>
                              <td class="p-1">{{ $item->user->nama_lengkap }}</td>
                              <td class="p-1">{{ $item->tanggal }}</td>
                              <td class="p-1">{{ $item->shift->shift_name }}</td>
                              <td class="p-1">{{ $item->area }}</td>
                           </tr>
                           @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-5 mx-10">
                {{ $jadwalUser->links() }}
            </div>
            <div class="flex justify-center my-5">
				<a href="{{ route('dashboard.index') }}" class="btn btn-error">Back</a>
            </div>
        </div>
    </x-main-div>
</x-app-layout>