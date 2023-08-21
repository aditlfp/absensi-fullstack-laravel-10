<x-app-layout>
    <x-main-div>
        <div class="bg-slate-500 p-4  shadow-md rounded-md">
            <p class="text-center text-2xl uppercase font-bold">Tambah Jadwal</p>
           
                <div class="flex justify-center overflow-x-auto mx-10 pb-10">
                    <table class="w-full shadow-md table-auto border-collapse rounded-lg overflow-hidden" id="searchTable">
                        <thead>
                            <tr>
                                <th rowspan="2" class="p-2 bg-gray-200">#</th>
                                <th rowspan="2" class="p-2 bg-gray-200">Nama Lengkap</th>
                                <th colspan="31" class="p-2 bg-gray-200">Tanggal</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i < 32; $i++)
                                    <th class="p-2 bg-stone-300">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="even:bg-slate-300 odd:bg-slate-200 border-t border-slate-300/70">
                                <td>1</td>
                                <td>Budi</td>
                                <td>
                                    <button id="myModalBtn">M</button>
                                    <div id="myModal" class="hidden fixed">
                                        <div class=" flex justify-center bg-slate-500/10 backdrop-blur-sm items-center h-screen rounded-md">
                                            <div class="bg-slate-200 w-2/3 rounded-md shadow">
                                                <div class="flex justify-end ml-[20rem] m-5">
                                                    <button id="close" class="btn btn-error">&times;</button>
                                                </div>
                                                <form action="{{ route('leader-jadwal.store') }}" method="POST" class="m-10" id="form">
                                                    @csrf
                                                    <div >
                                                        <p>Form Jadwal</p>
                                                    </div>
                                                    <div class="flex justify-end mt-5">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
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