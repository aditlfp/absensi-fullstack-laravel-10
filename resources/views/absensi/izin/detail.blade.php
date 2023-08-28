<x-app-layout>
    <x-main-div>
        <div>
            <p class="text-center text-2xl font-bold pt-5 uppercase">Detail Izin</p>
            <div class="bg-slate-100 mx-5 my-5 rounded-md shadow">
                <div>
                    <div class="flex items-center pt-10 justify-center">
                        <div class=" mx-2 my-2 overflow-hidden flex items-center sm:w-[40%] justify-center bg-slate-200  shadow-md  hover:shadow-none transition-all .2s  ease-in-out">
                            @if ($izinId->img == 'no-image.jpg')
                                <img class="w-20 rounded-full " src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
                                srcset="{{ URL::asset('/logo/person.png') }}">
                            @else
                                <img class="m-2 " src="{{ asset('storage/images/'.  $izinId->img) }}" alt="profile-logo2.png" srcset="{{ asset('storage/images/'.  $izinId->img) }}">
                            @endif
                        </div>
                    </div>
                    <div class="flex pb-5 justify-center">
                        @if ($izinId->approve_status == 'process')
                            <div class="px-4 py-2 shadow-md w-full mx-10 text-center rounded-tr-md rounded-bl-md capitalize bg-amber-500  text-xs sm:text-base overflow-hidden font-semibold">
                                <span >{{ $izinId->approve_status }}</span>    
                            </div>
                        @elseif($izinId->approve_status == 'accept')
                            <div class="px-4 py-2 shadow-md w-full mx-10 text-center rounded-tr-md rounded-bl-md capitalize bg-emerald-700  text-xs sm:text-base text-white overflow-hidden">
                                <span >{{ $izinId->approve_status }}</span>    
                            </div>
                        @else
                            <div class="px-4 py-2 shadow-md w-full mx-10 text-center rounded-tr-md rounded-bl-md capitalize bg-red-500  text-xs sm:text-base overflow-hidden font-semibold text-white">
                                <span >{{ $izinId->approve_status }}</span>    
                            </div>
                        @endif
                    </div>
                    <div class="bg-slate-300 mx-4 my-4 rounded-md p-2 py-5 font-semibold text-sm">
                        <div class="text-slate-800 space-y-2 text-xs sm:text-sm">
                            <div class="flex flex-col sm:flex-row w-full ">
                                <span>Nama Lengkap: </span>
                                <span class="indent-2">{{ $izinId->user->nama_lengkap }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row w-full ">
                                <span>Bermitra Dengan: </span>
                                <span class="indent-2">{{ $izinId->kerjasama->client->name }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row w-full ">
                                <span>Shift :</span>
                                <span class="indent-2">{{ $izinId->shift->shift_name }} | {{ $izinId->shift->jam_start }} - {{ $izinId->shift->jam_end }}</span>
                            </div>
                            <div class="flex flex-col  w-full whitespace-normal break-words">
                                <span>Alasan izin: </span>
                                <span class="textarea textarea-bordered">{{ $izinId->alasan_izin }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center mb-4 sm:justify-end">
            <a href="{{ route('lead_izin') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
        </div>
    </x-main-div>
</x-app-layout>