<x-app-layout>
    <x-main-div>
        <p class="text-center text-lg sm:text-2xl font-bold uppercase pt-10">Kesimpulan Rating</p>
        <div class="flex justify-center flex-col items-center ">
            <div class=" py-10 font-semibold w-fit bg-slate-100 mx-10 my-10 rounded-md p-3 px-10 shadow-md">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Client</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 1
                            
                        @endphp
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ Auth::user()->nama_lengkap }}</td>
                            <td>{{ Auth::user()->kerjasama->client->name }}</td>
                            @if($absen != null)
                                <td>{{ count($absen) * $absen[0]['point']->sac_point }}</td>
                            
                            @else
                            <td>Poin Kosong</td>
                            
                            @endif
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-center sm:justify-end my-3 gap-2 ">
                    <a href="{{ route('dashboard.index') }}"
                        class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
                </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>