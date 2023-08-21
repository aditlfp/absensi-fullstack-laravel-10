<x-app-layout>
    <x-main-div>
        <div class="bg-slate-500 p-4  shadow-md rounded-md">
            <p class="text-center text-2xl uppercase font-bold">Tambah Jadwal</p>
           
                <div class="overflow-x-scroll pb-10 text-xs">
                        <table class="text-xs shadow-md table-auto border-collapse rounded-lg overflow-hidden" id="searchTable">
                        <thead>
                            <tr>
                                <th rowspan="2" class="p-2 bg-gray-200">#</th>
                                <th rowspan="2" class="p-2 bg-gray-200">Nama Lengkap</th>
                                <th colspan="31" class="p-2 bg-gray-200">Tanggal</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i < 32; $i++)
                                    <th class="p-2 bg-stone-300 border-r-slate-400 border-r-[1.1px]">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($user as $i)
                                @if ($i->nama_lengkap != 'admin' && $i->nama_lengkap != 'user')
                                    <tr class="even:bg-slate-300 odd:bg-slate-200 border-t border-slate-300/70 text-xs">
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{{ $i->nama_lengkap }}</td>
                                        @for ($j = 1; $j < 32; $j++)
                                            <td>
                                                <button id="myModalBtn{{ $no }}_{{ $j }}" class="btn myModalBtn">M</button>
                                                <div id="myModal{{ $no }}_{{ $j }}" class="hidden fixed modalz">
                                                    <!-- Your modal content here -->
                                                    <div class="flex justify-center bg-slate-500/10 backdrop-blur-sm items-center h-screen rounded-md">
                                                        <div class="bg-slate-200 w-2/3 rounded-md shadow">
                                                            <div class="flex justify-end m-5">
                                                                <button class="btn btn-error close">&times;</button>
                                                            </div>
                                                            <form action="{{ route('leader-jadwal.store') }}" method="POST" class="p-5 w-full" id="form">
                                                                @csrf
                                                                <div class="w-full ">
                                                                    <p>Form Jadwal</p>
                                                                    <div>
                                                                        <div class="mt-4">
                                                                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                                                                            <input type="text" name="user_id" value="{{ $i->id }}" class="input input-bordered hidden">
                                                                            <input type="text" disabled value="{{ $i->nama_lengkap }}" class="input input-bordered">
                                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                                        </div>
                                                                        <div class="mt-4">
                                                                            <x-input-label for="shift_id" :value="__('Nama Lengkap')" />
                                                                            <select name="shift_id" id="shift_id" class="select select-bordered font-thin">
                                                                                <option disabled selected>~ Pilih Shift ~</option>
                                                                                @forelse ($shift as $shi)
                                                                                    @if ($i->kerjasama->client_id == $shi->client_id)
                                                                                        <option value="{{ $shi->id }}">{{ $shi->jam_start }}|{{ $shi->shift_name }}</option>    
                                                                                        @break
                                                                                        @elseif ($i->kerjasama->client_id != $shi->client_id)
                                                                                    @continue
                                                                                    @endif
                                                                                @empty
                                                                                    
                                                                                @endforelse
                                                                            </select>
                                                                            <x-input-error :messages="$errors->get('shift_id')" class="mt-2" />
                                                                        </div>
                                                                        <div class="mt-4">
                                                                            <x-input-label for="tanggal" :value="__('Nama Lengkap')" />
                                                                            <input type="date" name="tanggal" class="input input-bordered">
                                                                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-end mt-5">
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endfor
                                    </tr>
                                @else
                        
                                @endif
                            @empty
                        
                            @endforelse
                        </tbody>
                        
                        </table>
                </div>
        </div>
    </x-main-div>
</x-app-layout>