<x-app-layout>
    <x-main-div>
        <div class="py-10">
            <p class="text-center text-xl uppercase font-bold ">Riwayat Absensi, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
                <div class=" flex items-center my-5">
                    <x-search />
                </div>
                <div class="overflow-x-scroll w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full ">
                    <table id="searchTable" class="table w-full table-xs table-zebra sm:table-md text-xs bg-slate-50 font-semibold sm:text-md ">
                        <thead>
							<tr >
                                <th class="p-1 py-2 bg-slate-300 rounded-tl-2xl">#</th>
                                <th class="p-1 py-2 bg-slate-300">Image</th>
                                <th class="p-1 py-2 bg-slate-300">Name</th>
								<th class="p-1 py-2 bg-slate-300">Nama Lengkap</th>
								<th class="p-1 py-2 bg-slate-300">Email</th>
								<th class="p-1 py-2 bg-slate-300 rounded-tr-2xl">Kerjasama</th>
							</tr>
						</thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @forelse ($user as $i)
                            <tr>
                                <td class="p-1 ">{{ $n++ }}</td>
                                @if ($i->image == 'no-image.jpg')
									<td>
										<x-no-img />
									</td>
								@else
									<td><img src="{{ asset('storage/images/' . $i->image) }}" alt="" srcset="" width="60px"></td>
								@endif
                                <td class="p-1 ">{{ $i->name }}</td>
                                <td class="p-1  break-words whitespace-pre-wrap">{{ $i->nama_lengkap }}</td>
                                <td class="p-1 break-words whitespace-pre-line">{{ $i->email}}</td>
                                @if ($i->kerjasama == null)
									<td>kosong</td>
								@elseif($i->kerjasama->client == null)
									<td>kosong</td>
								@else
									<td class="break-words whitespace-pre-line p-1">{{ $i->kerjasama->client->name }}</td>
								@endif
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        ~ Data Kosong ~
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    <div id="pag-1" class="mt-5 mb-5 mx-10">
                        {{ $user->links() }}
                    </div>
                    <div class="flex">
		                <a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
                    </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>