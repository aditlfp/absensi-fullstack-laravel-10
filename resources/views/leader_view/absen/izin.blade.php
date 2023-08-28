<x-app-layout>
    <x-main-div>
        <div class="py-10">
			<p class="text-center text-2xl uppercase font-bold">Riwayat izin, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex flex-col items-center m-2 sm:mx-10 sm:justify-center justify-start">
                <div class="overflow-x-scroll w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
                    <table class="table table-xs text-center table-zebra w-full bg-slate-50 rounded-xl">
                        <thead>
                            <tr>
                                <th class="bg-slate-300 rounded-tl-xl">#</th>
                                <th class="bg-slate-300">Nama lengkap</th>
                                <th class="bg-slate-300">Shift</th>
                                <th class="bg-slate-300">alasan izin</th>
                                <th class="bg-slate-300">status</th>
                                <th class="bg-slate-300 rounded-tr-xl">action</th>
                            </tr>
                        </thead>
                        <tbody class="rounded-b-xl">
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($izin as $i)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $i->user->nama_lengkap }}</td>
                                    <td>{{ $i->shift->shift_name }}</td>
                                    <td class="text-start break-words whitespace-pre-wrap">{{ $i->alasan_izin }}</td>
                                    <td>
                                        @if ($i->approve_status == 'process')
                                            <span class="badge bg-amber-500 px-2 text-xs overflow-hidden font-semibold">{{ $i->approve_status }}</span>    
                                        @elseif($i->approve_status == 'accept')
                                            <span class="badge bg-emerald-700 px-2 text-xs text-white overflow-hidden">{{ $i->approve_status }}</span>    
                                        @else
                                            <span class="badge bg-red-500 px-2 text-xs overflow-hidden font-semibold text-white">{{ $i->approve_status }}</span>    
                                        @endif
                                    </td>
                                    <td class="flex justify-between">
                                    @if ($i->approve_status == 'process')
                                            <span>
                                                <form action="{{ route('lead_acc', $i->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-xs rounded-btn"><i class="ri-check-double-line"></i></button>
                                                </form>
                                            </span>
                                            <span>
                                                <form action="{{ route('lead_denied', $i->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-error btn-xs rounded-btn"><i class="ri-close-line"></i></button>
                                                </form>
                                            </span>
                                            <span class="overflow-hidden  w-full">
                                                <a href="#" class="text-sky-400 hover:text-sky-500 btn-lg transition-all ease-linear .2s"><i class="ri-eye-fill"></i></a>
                                            </span>
                                        @else
                                            <span class="overflow-hidden  w-full">
                                                <a href="#" class="text-sky-400 hover:text-sky-500 btn-lg transition-all ease-linear .2s"><i class="ri-eye-fill"></i></a>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">~ Kosong ~</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4 sm:justify-end">
		            <a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
                </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>