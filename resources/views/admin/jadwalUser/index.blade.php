<x-app-layout>
    <x-main-div>
        <div class="py-10">
            <p class="text-center text-2xl font-bold mb-10 uppercase">Index Jadwal User</p>
            <div class="flex justify-end">
                <x-search/>
            </div>
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
                    <button><a class="btn btn-primary btn-xs sm:btn-md">+ Jadwal</a></button>
                </form>
			</div>
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
                                <td class="p-1 badge bg-sky-500/70 px-2 font-semibold text-slate-700 overflow-hidden">{{ $item->area }}</td>
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