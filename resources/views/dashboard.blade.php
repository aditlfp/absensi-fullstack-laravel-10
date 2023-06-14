<x-app-layout>
    <div class="justify-start flex items-center">
        @forelse ($absen as $arr)
            @if (Auth::user()->id == $arr->user_id)
                @if ($arr->absensi_type_pulang == null)
                    <div
                        class="text-center mb-5 w-fit text-md sm:text-xl font-semibold text-slate-300 bg-red-500 py-2 px-4 shadow-md ml-10 inset-0">
                        <p>Kamu Belum Absen Pulang !!</p>
                    </div>
                @endif
            @break

        @else
        @endif

    @empty

    @endforelse

</div>
<x-main-div>
    <div class="flex justify-center pt-2 px-2 iAbsensi">
        <button class="btn btn-warning w-full" id="btnShow">Lihat History Absensi</button>
    </div>
    <div class="flex justify-center pb-2 px-2 iPulang">
        <button class="btn btn-warning w-full mt-5" id="btnShow2">Absensi Pulang</button>
    </div>
    <div class="flex flex-col items-center mx-2 my-2 justify-center ">
        <div class="overflow-x-scroll md:overflow-hidden w-full">
        <table class="table w-full text-sm sm:text-md hidden scale-100 md:scale-90" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Shift</th>
                    <th>Absen Masuk</th>
                    <th>Absen Keluar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($absen as $arr)
                    @if (Auth::user()->id != $arr->user_id)
                        @continue
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="my-10 mx-3">
                                    <h2>Tidak Ada History Absen</h2>
                                </div>
                            </td>
                        </tr>
                    @break

                @else
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $arr->shift->shift_name }}</td>
                        <td>{{ $arr->absensi_type_masuk }}</td>
                        @if ($arr->keterangan == 'izin')
                            <td>
                                <div class="badge badge-warning overflow-hidden">
                                    Izin
                                </div>
                            </td>
                        @elseif($arr->absensi_type_pulang == null)
                            <td class="text-red-500 font-bold underline">Belum Absen Pulang</td>
                        @else
                            <td>{{ $arr->absensi_type_pulang }}</td>
                        @endif
                        @if ($arr->shift_id == 1)
                            @if ($arr->keterangan == 'izin')
                                <td>
                                    <div class="badge badge-warning overflow-hidden">
                                        Izin
                                    </div>
                                </td>
                            @elseif ($arr->absensi_type_masuk <= '08:00:00')
                                <td>
                                    <div class="badge badge-success overflow-hidden">
                                        Masuk
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="badge badge-error gap-2 overflow-hidden">
                                        Telat
                                    </div>
                                </td>
                            @endif
                        @elseif($arr->shift_id == 2)
                            @if ($arr->keterangan == 'izin')
                                <td>
                                    <div class="badge badge-warning overflow-hidden">
                                        Izin
                                    </div>
                                </td>
                            @elseif ($arr->absensi_type_masuk <= '14:00:00')
                                <td>
                                    <div class="badge badge-success overflow-hidden">
                                        Masuk
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="badge badge-error gap-2 overflow-hidden">
                                        Telat
                                    </div>
                                </td>
                            @endif
                        @else
                            <td>
                                <div class="badge badge-error gap-2 overflow-hidden">
                                    Telat
                                </div>
                            </td>
                        @endif

                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>


    <table class="table w-full text-sm sm:text-md hidden overflow-scroll scale-100 md:scale-90" id="table2">
        <thead>
            <tr>
                <th>#</th>
                <th>Absen Masuk</th>
                <th>Pulang</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($absen as $arr)
                @if ($arr->absensi_type_pulang != null)
                    @continue
                @break

            @else
                @if (Auth::user()->id != $arr->user_id)
                    @continue
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="my-10 mx-3">
                                <h2>Tidak Ada Absensi</h2>
                            </div>
                        </td>
                    </tr>
                @break

            @else
                @if ($arr->keterangan == 'izin')
                    @continue
                @break

            @else
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $arr->absensi_type_masuk }}</td>
                    <td>
                        <div>
                            @if ($arr->absensi_type_pulang == null)
                                <form action="{{ route('data.update', $arr->id) }}" method="POST"
                                    class="tooltip">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-orange-600 flex justify-center shadow-md hover:bg-orange-700 text-white hover:shadow-sm px-2 py-1 text-xl rounded-full  transition all ease-out duration-100"><i
                                            class="ri-run-line"></i>
                                    </button>
                                </form>
                            @else
                            @endif

                        </div>
                    </td>
                </tr>
            @endif
        @endif
    @endif
@endforeach
</tbody>
</table>
</div>
<div id="pag-1" class="hidden mb-5 mx-5">
{{ $absen->links() }}
</div>

</x-main-div>



</x-app-layout>
