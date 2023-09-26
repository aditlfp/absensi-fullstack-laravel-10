<x-app-layout>
    <x-main-div>
        <div class="py-10 sm:mx-10">
            <p class="text-center text-lg sm:text-2xl uppercase font-bold ">Riwayat Laporan, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
                <div class="flex items-center w-full justify-center sm:justify-end my-5">
                    <x-search />
                </div>
                <div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full ">
                    <table id="searchTable" class="table w-full table-xs table-zebra sm:table-md bg-slate-50 text-xs font-semibold sm:text-md ">
                        <thead>
							<tr >
								<th class="p-1 py-2 bg-slate-300 rounded-tl-2xl">#</th>
                                <th class="p-1 py-2 bg-slate-300 text-center" colspan="3">Foto Progres</th>
								<th class="p-1 py-2 bg-slate-300 rounded-tr-2xl">Keterangan</th>
							</tr>
						</thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @forelse ($laporan as $i)
                            <tr>
                                <td class="p-1">{{ $n++ }}</td>
                                @if ($i->image1 == 'no-image.jpg')
                                <td>
                                    <x-no-img />
                                </td>
                                @elseif (Storage::disk('public')->exists('images/' . $i->image1))
                                    <td><img src="{{ asset('storage/images/' . $i->image1) }}" alt="{{ asset('storage/images/' . $i->image1) }}" srcset="{{ asset('storage/images/' . $i->image1) }}" width="90px" class="rounded"></td>
                                @else
                                 <td>
                                    <x-no-img />
                                 </td>
                                @endif
                                
                                
                                @if ($i->image2 == 'no-image.jpg')
                                <td>
                                    <x-no-img />
                                </td>
                                @elseif (Storage::disk('public')->exists('images/' . $i->image2))
                                    <td><img src="{{ asset('storage/images/' . $i->image2) }}" alt="{{ asset('storage/images/' . $i->image2) }}" srcset="{{ asset('storage/images/' . $i->image2) }}" width="90px" class="rounded"></td>
                                @else
                                    <td>
                                        <x-no-img />
                                    </td>
                                @endif
                                
                                
                                @if ($i->image3 == 'no-image.jpg')
                                <td>
                                    <x-no-img />
                                </td>
                                @elseif (Storage::disk('public')->exists('images/' . $i->image3))
                                    <td><img src="{{ asset('storage/images/' . $i->image3) }}" alt="{{ asset('storage/images/' . $i->image3) }}" srcset="{{ asset('storage/images/' . $i->image3) }}" width="90px" class="rounded"></td>
                                @else
                                    <td>
                                        <x-no-img />
                                    </td>
                                @endif
                                
                                <td>{{ $i->keterangan }} <br>~{{ $i->user->nama_lengkap }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        ~ Data Kosong ~
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    <div id="pag-1" class="mt-5 mb-5 mx-10">
                        {{ $laporan->links() }}
                    </div>
                    <div class="flex justify-center sm:justify-end w-full">
		                <a href="{{ route('dashboard.index') }}" class="btn btn-error ">Kembali</a>
                    </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>