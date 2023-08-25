<x-app-layout>
    <x-main-div>
        <p class="text-center text-2xl font-bold py-5 uppercase">absensi izin</p>
        <div class="flex justify-end mx-10 mb-2 "><a href="{{ route('admin.export-izin') }}" class="bg-yellow-400 px-4 py-2 shadow rounded-md text-2xl"><i class="ri-file-download-line"></i></a></div>
        <div class="flex justify-between my-5 mx-10">
            <a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
        <div class="">
            <x-search/>
        </div>
        </div>
        <div class="flex items-center justify-center flex-col mx-10 pb-10">
            <table class="table w-full bg-slate-50" id="searchTable">
            <thead>
                <tr>
                    <th class="bg-slate-300 rounded-tl-2xl">#</th>
                    <th class="bg-slate-300 ">Nama User</th>
                    <th class="bg-slate-300 ">Shift</th>
                    <th class="bg-slate-300 ">Client</th>
                    <th class="bg-slate-300 ">Jam Masuk</th>
                    <th class="bg-slate-300 rounded-tr-2xl">Keterangan</th>
                </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
                @forelse ($izin as $i)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $i->user->name }}</td>
                        <td>{{ $i->shift->shift_name }}</td>
                        <td>{{ $i->kerjasama->client->name }}</td>
                        <td>{{ $i->absensi_type_masuk }}</td>
                        <td>{{ $i->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">~ Kosong ~</td>
                    </tr>
                @endforelse
            </tbody>
            </table>
            <div class="mt-5">
                {{ $izin->links()}}
            </div>
        </div>
    </x-main-div>
</x-app-layout>
