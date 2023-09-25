<x-app-layout>
    <x-main-div>
        <div class="py-10">
            <div>
                <p class="text-center text-lg sm:text-2xl font-bold py-10 uppercase">Index Check Point</p>
            </div>
            <div class="flex justify-end">
                <div class="input flex w-fit mx-10 items-center justify-end mb-5 input-bordered">
                    <i class="ri-search-2-line"></i>
                    <input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
                </div>
            </div>
            <div class="flex flex-col items-center mx-2 my-2 sm:justify-center justify-start">
                <div class="overflow-x-auto w-full md:overflow-hidden mx-2 sm:mx-0 sm:w-full">
                    <table class="table w-full table-xs bg-slate-50 table-zebra sm:table-md text-sm sm:text-md scale-90 md:scale-90">
                        <thead>
							<tr>
								<th class="bg-slate-300 rounded-tl-2xl">#</th>
								<th class="bg-slate-300 px-10">Nama Lengkap</th>
								<th class="bg-slate-300 px-10">Foto</th>
								<th class="bg-slate-300">Jumlah CP</th>
								<th class="bg-slate-300 px-10">Mitra</th>
								<th class="bg-slate-300 rounded-tr-2xl">Action</th>
							</tr>
						</thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($cek as $c)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $c->user->nama_lengkap }} {{ $c->id}}</td>
                                        @forelse($c->image as $img)
                                    <td>
                                        @foreach($img->image as $i)
                                                <img src="{{ asset('storage/images/' . $i)}}" alt="" srcset="" width="120px" class="rounded">
                                            @endforeach
                                        @forelse ($image as $i)
                                            @php
                                                $arrayImage = $i->image;
                                                $jumlahImage = count($arrayImage);
                                                // cek count & image
                                            @endphp
                                            @if ($c->id == $i->check_point_id && $jumlahImage != $c->check_count)
                                            <form action="{{ route('editByAuth') }}" method="get">
                                                <input name="id" type="text" value="{{ $c->id }}" class="hidden"/>
                                                <button type="submit" class="btn btn-sm btn-info sm:mx-2 ">+ CP</button>
                                                </form>
                                            @endif
                                        @empty
                                            
                                        @endforelse
                                    </td>
                                        @empty
                                    <td class="flex justify-center">
                                        <form action="{{ route('checkpoint-user.create') }}" method="get">
                                        <input name="id" type="text" value="{{ $c->id }}" class="hidden"/>
                                        <button type="submit" class="btn btn-sm btn-info sm:mx-2 ">+ CP</button>
                                        </form>
                                    </td>
                                        @endforelse
                                    
                                    <td class="text-center">{{ $c->check_count }}</td>
                                    <td>{{ $c->client->name }}</td>
                                    <td></td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">~ Kosong ~</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center sm:justify-end">
                <a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Kembali</a>
            </div>
            
        </div>
    </x-main-div>
</x-app-layout>