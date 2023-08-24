<x-app-layout>
    <x-main-div class="ydis">
        <div class="bg-slate-500 p-4  shadow-md rounded-md">
            <p class="text-center text-2xl uppercase font-bold my-10">Tambah Jadwal</p>
                <div class="overflow-x-scroll sm:overflow-x-auto  pb-10 text-xs">
                        <table class="text-xs shadow-md table-auto border-collapse rounded-lg overflow-hidden" id="searchTable">
                        <thead>
                            <tr>
                                <th rowspan="2" class="p-2 pl-4 bg-gray-200">#</th>
                                <th rowspan="2" class="p-2 bg-gray-200">Nama Lengkap</th>
                                <th colspan="31" class="p-2 bg-gray-200">Tanggal</th>
                            </tr>
                            @php
                                $starte = \Carbon\Carbon::createFromFormat('Y-m-d', $str1);
                                $ende = \Carbon\Carbon::createFromFormat('Y-m-d', $end1);
                            @endphp
                            <tr>
                                @for ($date = $starte->copy(); $date->lte($ende); $date->addDay())
                                    <th class="p-2 bg-stone-300 border-r-slate-400 border-r-[1.1px]">{{ $date->format('d') }}</th>
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
                                        <td class="text-center border-r border-slate-400">{{ $i->nama_lengkap }}</td>
                                        @for ($date = $starte->copy(); $date->lte($ende); $date->addDay())
                                        <td>
                                            @php
                                                $buttonId = "myModalBtn".$no.'_'.$date->format('d');
                                                $modalId = "myModal".$no.'_'.$date->format('d');
                                                $dataFound = false;
                                            @endphp
                                            @forelse ($jadwal as $item)
                                                @php
                                                    $dateT = strtotime($item->tanggal);
                                                    $data = date('d', $dateT);
                                                @endphp
                                                    @if ($item->user_id == $i->id && $date->format('d') == $data && $item->status == 'M')
                                                    <div class="flex justify-center">
                                                        <span class="btn btn-info w-full">{{ $item->status }}</span>
                                                    </div>
                                                            @php
                                                                $dataFound = true;
                                                                break;
                                                            @endphp
                                                        @endif

                                                        @empty
                                                        @endforelse
                                                        @if (!$dataFound)
                                                            
                                                        <button id="{{ $buttonId }}" class="btn bg-amber-400 text-slate-800 border-slate-200 hover:border-slate-400/70 hover:bg-amber-500/70 myModalBtn">OFF</button>
                                                        <div id="{{ $modalId }}" class="hidden fixed modalz">
                                                            <!-- Your modal content here -->
                                                            <div class="flex justify-center bg-slate-500/10 backdrop-blur-sm items-center min-h-screen rounded-md">
                                                                <div class="bg-slate-200 w-2/3 mb-20 mt-10 rounded-md shadow">
                                                                    <div class="flex justify-end m-5">
                                                                        <button class="btn btn-error close">&times;</button>
                                                                    </div>
                                                                    <form action="{{ route('leader-jadwal.store') }}" method="POST" class="p-5 w-full" id="form">
                                                                        @csrf
                                                                        <div class="w-full ">
                                                                            <p class="text-center text-xl font-semibold mb-3">Form Jadwal</p>
                                                                            <div class="w-full">
                                                                                <div class="mt-4">
                                                                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                                                                    <input type="text" name="user_id" value="{{ $i->id }}" class="input input-bordered hidden">
                                                                                    <input type="text" disabled value="{{ $i->nama_lengkap }}" class="input input-bordered w-full">
                                                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                                                </div>
                                                                                <div class="mt-4">
                                                                                    <x-input-label for="shift_id" :value="__('Nama Lengkap')" />
                                                                                    <select name="shift_id" id="shift_id" class="select select-bordered font-thin w-full">
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
                                                                                    <x-input-label for="tanggal" :value="__('Tanggal')" />
                                                                                    <input type="date" name="tanggal" value="{{ $date->format('Y-m-d') }}" class="input input-bordered w-full">
                                                                                    <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                                                                                </div>
                                                                                <div class="mt-4">
                                                                                    <x-input-label for="area" :value="__('Nama Area')" />
                                                                                    <select name="area" id="area" class="select select-bordered font-thin w-full">
                                                                                        <option disabled selected>~ Pilih Area ~</option>
                                                                                        @forelse ($area as $are)
                                                                                                <option value="{{ $are->nama_area }}">{{ $are->nama_area }}</option>    
                                                                                                @break
                                                                                                @continue
                                                                                        @empty
                                                                                            <option disabled>Area masih kosong, tolong isi terlebih dahulu</option>
                                                                                        @endforelse
                                                                                    </select>
                                                                                    <x-input-error :messages="$errors->get('area')" class="mt-2" />
                                                                                </div>
                                                                                <div class="mt-4">
                                                                                    <x-input-label for="status" :value="__('Status')" />
                                                                                    <select name="status" id="status" class="select select-bordered font-thin w-full">
                                                                                        <option disabled selected>~ Pilih Status ~</option>
                                                                                        <option value="M">M</option>
                                                                                    </select>
                                                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                                                        @endif
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
                <div class="flex justify-center my-5">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-error">Back</a>
                </div>
        </div>
    </x-main-div>
</x-app-layout>