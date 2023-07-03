<x-app-layout>
    <div class="justify-start flex items-center">
        @forelse ($absen as $arr)
            @if (Auth::user()->id == $arr->user_id)
                @if ($arr->absensi_type_pulang == null)
                    <div
                        class="text-center rounded-tr-lg rounded-bl-lg mb-5 w-fit text-md sm:text-xl font-semibold text-slate-300 bg-red-500 py-2 px-4 shadow-md ml-10 inset-0">
                        <p>Kamu Belum Absen Pulang !!</p>
                    </div>
                @endif
            @break

        @else
        @endif

    @empty

    @endforelse

    @forelse ($lembur as $i)
        @if (Auth::user()->id == $i->user_id)
            @if ($i->jam_selesai == null)
                <div
                    class="text-center rounded-tr-lg rounded-bl-lg mb-5 sm:w-fit text-md sm:text-xl font-semibold text-slate-300 bg-red-500 py-2 px-4 shadow-md ml-5 sm:ml-10 inset-0">
                    <p>Kamu Belum Mengakhiri Lembur !!</p>
                </div>
            @endif
    @else
    @endif
@empty
@endforelse
<div class="flex justify-end w-full mx-10">

    <div
        class="text-center md:flex hidden justify-end items-end rounded-tr-lg rounded-bl-lg mb-5 w-fit text-md sm:text-xl font-semibold text-slate-100 bg-red-500 py-2 px-4 shadow-md ml-10 ">
        <span class="text-white">{{ Carbon\Carbon::now()->format('d-m-Y') }}</span>
    </div>
</div>
</div>
<x-main-div>
<div class="py-5">
    <div class="flex flex-col items-center gap-2 justify-center pt-2 px-2 overflow-hidden">
        {{-- absensi --}}
        <div id="btnAbsensi" class=" w-full flex justify-center items-center gap-2 bg-amber-400 rounded-md h-11">
            <i class="ri-todo-line text-xl"></i>
            <button class="uppercase font-bold text-sm">
                 Absensi 
            </button>
        </div>
        {{-- menu menu dashboard absensi --}}
        <div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="ngabsen">
            <a href="{{ route('absensi.index') }}" class="btn btn-info w-full">Absensi</a>
        </div>
        <div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="ngeLembur">
            <a href="{{ route('lembur.index') }}" class="btn btn-info w-full">Lembur</a>
        </div>
        <div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="isiAbsen">
            <a href="historyAbsensi" class="btn btn-info w-full">History Absensi</a>
        </div>
        <div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="isiLembur">
            <a href="{{ route('lemburIndexUser') }}" class="btn btn-info w-full">History Lembur</a>
        </div>
    </div>
    <div class="flex flex-col items-center gap-2 justify-center pt-2 px-2 overflow-hidden">
        <div id="btnRating" class=" w-full flex justify-center items-center gap-2 bg-amber-400 rounded-md h-11">
            <i class="ri-user-star-line text-xl"></i>
            <button class="uppercase font-bold text-sm">Rating</button>
        </div>
        <div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="cekMe">
            <a href="{{ url('rate/'. Auth::user()->id) }}" class="btn btn-info w-full">Check Rating Saya</a>
        </div>
        @if (Auth::user()->role_id == 2)
            <div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="cekRate">
                <a href="{{ route('rating.index')}}" class="btn btn-info w-full">Rating</a>
            </div>
        @else
            
        @endif
    </div>

    {{-- handle Pulang --}}
    <div class="flex justify-center sm:justify-end">
    @foreach ($absen as $arr)
            @if (Auth::user()->id == $arr->user_id && $arr->absensi_type_pulang == null)
                <form action="{{ route('data.update', $arr->id) }}" method="POST" class="tooltip">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="bg-yellow-600 flex justify-center shadow-md hover:bg-yellow-700 text-white hover:shadow-none px-3 py-1 text-xl rounded-md transition all ease-out duration-100 mt-5 mr-0 sm:mr-2 uppercase items-center"><i
                            class="ri-run-line font-sans text-3xl"></i><span class="font-bold">Pulang</span>
                    </button>
                </form>
            @else
        @endif
    @endforeach
    </div>
    {{-- handle akhiri lembur --}}
    <div class="flex justify-center sm:justify-end">
    @foreach ($lembur as $i)
        @if (Auth::user()->id == $i->user_id && $i->jam_selesai == null)
            <form action="{{ url('lembur/' . $i->id) }}" method="POST" class="tooltip">
                @csrf
                @method('PUT')
                <button type="submit"
                    class="bg-yellow-600 flex justify-center shadow-md hover:bg-yellow-700 text-white hover:shadow-none px-3 py-1 text-xl rounded-md transition all ease-out duration-100 mt-5 mr-0 sm:mr-2 uppercase items-center"><i
                        class="ri-run-line font-sans text-3xl"></i><span class="font-bold">Selasaikan Lembur</span>
                </button>
            </form>
        @else
        @endif
    @endforeach
    </div>

</div>

</x-main-div>

</x-app-layout>
