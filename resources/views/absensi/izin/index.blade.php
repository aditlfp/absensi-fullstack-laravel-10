<x-app-layout>
    <x-main-div>
        <div class="py-10">
			<p class="text-center text-2xl uppercase font-bold pb-10">Riwayat izin Saya</p>
            
            <div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
                <div class="overflow-x-scroll w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
                    <table class="table table-xs table-zebra w-full bg-slate-50 rounded-xl" id="searchTable">
                        <thead>
                            <tr>
                                <th class="bg-slate-300 rounded-tl-xl">#</th>
                                <th class="bg-slate-300">Nama lengkap</th>
                                <th class="bg-slate-300">Mitra</th>
                                <th class="bg-slate-300">Shift</th>
                                <th class="bg-slate-300 px-10">alasan izin</th>
                                <th class="bg-slate-300 rounded-tr-xl">status</th>
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
                                    <td>{{ $i->kerjasama->client->name }}</td>
                                    <td>{{ $i->shift->shift_name }}</td>
                                    <td>{{ $i->alasan_izin }}</td>
                                    <td>
                                        @if ($i->approve_status == 'process')
                                            <span class="badge badge-warning overflow-hidden">{{ $i->approve_status }}</span>    
                                        @elseif($i->approve_status == 'accept')
                                            <span class="badge badge-success overflow-hidden">{{ $i->approve_status }}</span>    
                                        @else
                                            <span class="badge badge-error overflow-hidden">{{ $i->approve_status }}</span>    
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
                <div id="pag-1" class="mt-5 mb-5 mx-10">
                    {{ $izin->links() }}
                </div>
                <div class="flex justify-center mt-4 sm:justify-end">
		            <a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
                </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>