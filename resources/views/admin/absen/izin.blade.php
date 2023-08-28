<x-app-layout>
    <x-main-div>
        <p class="text-center text-2xl font-bold py-5 uppercase">absensi izin</p>
        <div class="flex justify-end mx-10 mb-2 "><a href="{{ route('admin.export-izin') }}" class="bg-yellow-400 px-4 py-2 shadow rounded-md text-2xl"><i class="ri-file-download-line"></i></a></div>
        <div class="flex justify-between my-5 mx-10">
            <a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
        <div class="">
            <x-search/>
        </div>
        </div>
        <div class="flex items-center justify-center flex-col mx-10 pb-10">
            <table class="table w-full bg-slate-50" id="searchTable">
            <thead>
                <tr>
                    <th class="bg-slate-300 rounded-tl-xl">#</th>
                    <th class="bg-slate-300">Nama lengkap</th>
                    <th class="bg-slate-300">Shift</th>
                    <th class="bg-slate-300">Mitra</th>
                    <th class="bg-slate-300 ">alasan izin</th>
                    <th class="bg-slate-300">status</th>
                    <th class="bg-slate-300 rounded-tr-xl">action</th>
                </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
                @php
                $no = 1;
            @endphp
            @forelse ($izin as $i)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $i->user->nama_lengkap }}</td>
                    <td>{{ $i->shift->shift_name }}</td>
                    <td>{{ $i->kerjasama->client->name }}</td>
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
                                <form action="{{ route('admin_acc', $i->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-xs rounded-btn"><i class="ri-check-double-line"></i></button>
                                </form>
                            </div>
                            <div>
                                <form action="{{ route('admin_denied', $i->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-error btn-xs rounded-btn"><i class="ri-close-line"></i></button>
                                </form>
                            </div>
                            <div class="overflow-hidden ">
                                <a href="{{ route('izin.show', $i->id) }}" class="text-sky-400 hover:text-sky-500 text-xl transition-all ease-linear .2s"><i class="ri-eye-fill"></i></a>
                            </div>
                            <form action="{{ route('admin.deletedIzin', $i->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="overflow-hidden ">
                                <button  class="text-red-400 hover:text-red-500 text-xl transition-all ease-linear .2s"><i class="ri-delete-bin-5-line"></i></button>
                            </div>
                        </form>
                        @else
                            <div class="overflow-hidden ">
                                <a href="{{ route('izin.show', $i->id) }}" class="text-sky-400 hover:text-sky-500 text-xl transition-all ease-linear .2s"><i class="ri-eye-fill"></i></a>
                            </div>
                            <form action="{{ route('admin.deletedIzin', $i->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="overflow-hidden ">
                                <button  class="text-red-400 hover:text-red-500 text-xl transition-all ease-linear .2s"><i class="ri-delete-bin-5-line"></i></button>
                            </div>
                        </form>
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
            <div class="mt-5">
                {{ $izin->links()}}
            </div>
        </div>
    </x-main-div>
</x-app-layout>
