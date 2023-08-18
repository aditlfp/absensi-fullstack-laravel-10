<x-app-layout>
    <x-main-div>
        <div class="py-10">
            <p class="text-center text-xl uppercase font-bold ">Riwayat Absensi, {{ Auth::user()->kerjasama->client->name }}</p>
            <div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
                <div class="input flex items-center input-bordered my-5">
                    <x-search />
                </div>
                <div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full ">
                    <table id="searchTable" class="table w-full table-xs table-zebra sm:table-md text-xs font-semibold sm:text-md ">
                        <thead>
							<tr >
								<th class="p-1 py-2">#</th>
                                <th class="p-1 py-2">Name</th>
								<th class="p-1 py-2">Tanggal</th>
								<th class="p-1 py-2">Lama Lembur</th>
							</tr>
						</thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @forelse ($lembur as $i)
                            <tr>
                                <td class="p-1 ">{{ $n++ }}</td>
                                <td class="p-1  break-words whitespace-pre-wrap">{{ $i->user->nama_lengkap }}</td>
                                <td class="p-1 ">{{ $i }}</td>
                                
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        ~ Data Kosong ~
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    <div id="pag-1" class="mt-5 mb-5 mx-10">
                        {{ $lembur->links() }}
                    </div>
                    <div class="flex">
		                <a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
                    </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>