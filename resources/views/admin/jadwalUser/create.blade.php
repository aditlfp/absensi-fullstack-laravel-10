<x-app-layout>
    <x-main-div>
        <div class="bg-slate-500 p-4  shadow-md rounded-md">
            <p class="text-center text-2xl uppercase font-bold">Tambah Jadwal</p>
           
                <div class="flex justify-center w-full overflow-x-auto mx-10 pb-10">
                    <table class=" w-full shadow-md" id="searchTable">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Nama Lengkap</th>
                                <th colspan="31">Tanggal</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i < 32; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Budi</td>
                                <td>
                                    <button id="myModalBtn">M</button>
                                    <div id="myModal" class="hidden fixed">
                                        <div class="bg-slate-100 m-52 flex rounded-md">
                                            <div class="bg-slate-400 shadow-inner shadow-slate-500">
                                                <form action="{{ route('leader-jadwal.store') }}" method="POST" class="mx-[25%] my-10 " id="form">
                                                    @csrf
                                                    <div >
                                                        <p>Aku Modal</p>
                                                    </div>
                                                    <div class="flex justify-end mt-5">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                                <div class="flex justify-end ml-[20rem] mt-5">
                                                    <button id="close" class="btn btn-error">&times;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </x-main-div>
</x-app-layout>