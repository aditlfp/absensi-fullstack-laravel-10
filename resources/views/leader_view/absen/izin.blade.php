<x-app-layout>
    <x-main-div>
        <div class="py-10 sm:mx-10">
			<p class="text-center text-lg sm:text-2xl uppercase font-bold">Riwayat izin, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex items-center w-full justify-center sm:justify-end my-5">
                <x-search/>
            </div>
            <div class="flex flex-col items-center m-2 sm:mx-10 sm:justify-center justify-start">
                @if (session('message'))
                <div class="alert alert-success text-sm flex h-10 overflow-hidden rounded-md my-5 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('message') }}</span>
                </div>
                @elseif(session('msgError'))
                <div class="alert alert-warning text-sm flex h-10 overflow-hidden rounded-md my-5 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Warning: {{ session('msgError') }}</span>
                </div>
                @endif
                <div class="overflow-x-scroll w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
                    <table id="searchTable" class="table w-full table-xs table-zebra sm:table-md text-xs bg-slate-50 font-semibold sm:text-md ">
                        <thead>
                            <tr>
                                <th class="bg-slate-300 rounded-tl-xl">#</th>
                                <th class="bg-slate-300">Nama lengkap</th>
                                <th class="bg-slate-300">Shift</th>
                                <th class="bg-slate-300 ">alasan izin</th>
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
                                    <td class="text-start line-clamp-2">{{ $i->alasan_izin }}</td>
                                    <td>
                                        @if ($i->approve_status == 'process')
                                            <span class="badge bg-amber-500 px-2 text-xs overflow-hidden font-semibold">{{ $i->approve_status }}</span>    
                                        @elseif($i->approve_status == 'accept')
                                            <span class="badge bg-emerald-700 px-2 text-xs text-white overflow-hidden">{{ $i->approve_status }}</span>    
                                        @else
                                            <span class="badge bg-red-500 px-2 text-xs overflow-hidden font-semibold text-white">{{ $i->approve_status }}</span>    
                                        @endif
                                    </td>
                                    <td class="flex justify-center gap-1 items-center">
                                    @if ($i->approve_status == 'process')
                                            <div>
                                                <form action="{{ route('lead_acc', $i->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-xs rounded-btn"><i class="ri-check-double-line"></i></button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{ route('lead_denied', $i->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-error btn-xs rounded-btn"><i class="ri-close-line"></i></button>
                                                </form>
                                            </div>
                                            <div class="overflow-hidden ">
                                                <a href="{{ route('izin.show', $i->id) }}" class="text-sky-400 hover:text-sky-500 text-xl transition-all ease-linear .2s"><i class="ri-eye-fill"></i></a>
                                            </div>
                                        @else
                                            <div class="overflow-hidden ">
                                                <a href="{{ route('izin.show', $i->id) }}" class="text-sky-400 hover:text-sky-500 text-xl transition-all ease-linear .2s"><i class="ri-eye-fill"></i></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">~ Kosong ~</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="pag-1" class="mt-5 mb-5 mx-10">
                    {{ $izin->links() }}
                </div>
                <div class="flex justify-center mt-4 sm:justify-end w-full">
		            <a href="{{ route('dashboard.index') }}" class="btn btn-error">Back</a>
                </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>