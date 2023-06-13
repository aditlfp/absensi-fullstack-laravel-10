<x-app-layout>
    <x-main-div>
        <div class="mx-5 my-5">
            <form action="{{ route('absensi.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="sm:flex sm:justify-center sm:gap-3 sm:mb-3">
                    <div id="my_camera" class=" bg-slate-200 rounded"></div>
                    <div id="results" class=" mt-1 sm:mt-0  rounded"></div>
                </div>
                <div class="flex justify-center">
                    <button type=button onclick="take_snapshot()"
                        class="p-2 my-2 px-3 mb-5 text-white bg-blue-400 rounded-full"><i
                            class="ri-camera-fill"></i></button>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col justify-between">
                        <label>Nama: </label>
                        <input type="text" id="user_id" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" value="{{ Auth::user()->name }}" disabled class="input input-bordered">
                    </div>
                    <div class="flex flex-col  justify-between">
                        <label>Bermitra Dengan: </label>
                            <input type="text" name="kerjasama_id" id="kerjasama_id" hidden
                                value="{{ Auth::user()->kerjasama_id }}">
                            <input type="text" value="{{ Auth::user()->kerjasama->client->name }}" disabled
                                class="input input-bordered">
                        
                    </div>
                    <div class="flex flex-col  justify-between">
                        <label>Shift: </label>
                        <select name="shift_id" id="shift_id" class="select select-bordered font-thin">
                            <option>-- Select Shift --</option disabled selected>
                            @forelse ( $shift as $i )
                                <option value="{{ $i->id }}">{{ $i->shift_name }} | {{ $i->jam_start }}</option>
                            @empty
                                <option>~ Tidak ad Shift ! ~</option>
                            @endforelse
                        </select>
                    </div>
                    <div>
                        <div>
                            <label>Perlengkapan: </label>
                        </div>
                        @foreach ($dev as $arr)
                        @if (Auth::user()->devisi_id == $arr->id )
                            @foreach ($arr->perlengkapan as $i)
                                <input type="checkbox" name="perlengkapan[]" id="perlengkapan" value="{{ $i->name }}">
                                <label for="perlengkapan">{{ $i->name }}</label>
                            @endforeach 
                        @else
                            
                        @endif
                        @endforeach
                    </div>
                    <div>
                        <label>Deskripsi: </label>
                        <textarea name="deskripsi" id="deskripsi" value="" class="w-full textarea textarea-bordered"></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <label>Keterangan: </label>
                        <div>
                            <input name="keterangan" type="radio" value="masuk"
                                class="radio cursor-pointer checked:bg-blue-500"><span
                                class="mx-2">Masuk</span>
                            <input name="keterangan" type="radio" value="izin"
                                class="radio cursor-pointer checked:bg-red-500"><span
                                class="mx-2">Izin</span>
                        </div>
                    </div>
                    <div class="items-center justify-between hidden">
                        <label>Absensi: </label>
                        <div>
                            <input name="absensi_type_masuk" type="radio" value="1"
                                class="radio cursor-pointer checked:bg-blue-500" checked><span
                                class="mx-2">Masuk</span>
                        </div>
                    </div>
                    <input type="text" id="image" name="image" class="image-tag" hidden>
                    <h2 class="hidden">{{ $user->ip }} || {{ $user->city }}</h2>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="submit"
                        class="p-2 my-2 px-4 text-white bg-blue-400 hover:bg-blue-500 rounded transition-all ease-linear .2s">Save
                        Data</button>
                    <a href="{{ route('dashboard.index') }}" class="p-2 my-2 px-4 text-white bg-red-400 hover:bg-red-500 rounded transition-all ease-linear .2s">
                        Back
                    </a>
                </div>
                <input class="hidden" id="thisId" value="{{ Auth::user()->id }}">
                @php
                    $mytime = Carbon\Carbon::now()->format('H:m:s');
                    $mytime2 = "10:00:00";
                @endphp
                <input class="hidden" id="thisTime" value="{{ $mytime }}">
                <input class="hidden" id="thisTime2" value="{{ $mytime2 }}">
                <input class="hidden" id="isi" name="absensi_type_pulang" value="okok">
            </form>
        </div>
    </x-main-div>



    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 80
        });
        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML =
                    '<img id="imgprev" src="' + data_uri + '"/>';
            });
            // Webcam.reset();
        }
    </script>
</x-app-layout>
