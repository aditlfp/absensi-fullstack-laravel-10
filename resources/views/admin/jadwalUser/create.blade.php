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
                                    <td class="text-center">{{ $i->nama_lengkap}}</td>
                                @for ($i = 1; $i < 32; $i++)
                                <td>
                                    <button id="myModalBtn{{ $i}}" class="btn">M</button>
                                    <div id="myModal{{ $i}}" class="hidden fixed">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".myModalBtn").click(function () {
                var buttonId = $(this).attr("id");
                var modalId = buttonId.replace("myModalBtn", "myModal");
                $("#" + modalId).removeClass("hidden fixed");
                $("#" + modalId).addClass('absolute inset-0');
            });
    
            $(".myModal").find("#close").click(function () {
                $(this).closest(".myModal").addClass("hidden");
            });
        });
    </script>
    
</x-app-layout>