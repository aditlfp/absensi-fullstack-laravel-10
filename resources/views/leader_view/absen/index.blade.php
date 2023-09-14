<x-app-layout>
    <x-main-div>
        <div class="py-10 sm:mx-10">
            <p class="text-center text-lg sm:text-2xl uppercase font-bold ">Riwayat Absensi, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
                <div class="flex justify-center sm:justify-between  items-center my-5">
                        <div class="flex flex-col sm:flex-row w-full gap-2 sm:gap-5 items-center justify-center sm:justify-between">
                              <form action="{{ url("LEADER/leader-absensi")}}" method="GET" class="sm:flex sm:justify-start">
                			    <div class="join sm:ml-10">
                			        <input type="month" placeholder="pilih bulan..." class="join-item input input-bordered" name="search" id="search" />
                			        <button type="submit" class="btn btn-info join-item">FILTER</button>
                			    </div>
        		              </form>
        		              <div class="flex items-center mt-5">
        		                <x-search />
        		              </div>
                        </div>
                </div>
                <div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-10">
                    <table id="searchTable" class="table table-xs table-zebra sm:table-md text-xs bg-slate-50 font-semibold sm:text-md ">
                        <thead>
							<tr >
								<th class="p-1 py-2 bg-slate-300 rounded-tl-2xl">#</th>
                                <th class="p-1 py-2 bg-slate-300">Name</th>
								<th class="p-1 py-2 bg-slate-300">Shift</th>
								<th class="p-1 py-2 px-4 bg-slate-300">Tanggal</th>
								<th class="p-1 py-2 bg-slate-300">Masuk - pulang</th>
								<th class="p-1 py-2 bg-slate-300 rounded-tr-2xl">Keterangan</th>
							</tr>
						</thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @forelse ($absen as $i)
                            <tr>
                                <td class="p-1 ">{{ $n++ }}</td>
                                <td class="p-1  break-words whitespace-pre-wrap">{{ $i->user->nama_lengkap }}</td>
                                <td class="p-1 ">{{ $i->shift->shift_name }}</td>
                                <td class="p-1 ">{{ $i->tanggal_absen }}</td>
                                <td class="p-1 ">
                                {{ $i->absensi_type_masuk }} - 
                                @if($i->absensi_type_pulang == null)
                                    <span class="text-red-500 font-semibold capitalize">kosong</span>
                                @elseif($i->absensi_type_pulang == 'Tidak Absen Pulang')
                                    <span class="text-yellow-500 font-semibold capitalize">{{ $i->absensi_type_pulang }}</span>
                                @else
                                    {{ $i->absensi_type_pulang }}
                                @endif
                                </td>
                                <td>
                                    @if ($i->keterangan == 'masuk')
                                    <span class=" badge badge-success gap-2 overflow-hidden">{{ $i->keterangan }}</span> 
                                    @elseif($i->keterangan == 'telat')
                                    <span class="badge badge-error gap-2 overflow-hidden">{{ $i->keterangan }}</span>
                                    @else
                                    <span class="badge badge-warning gap-2 overflow-hidden">{{ $i->keterangan }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">
                                        ~ Data Kosong ~
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    <div id="pag-1" class="mt-5 mb-5 mx-10">
                        {{ $absen->links() }}
                    </div>
                    <div class="flex">
		                <a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
                    </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>