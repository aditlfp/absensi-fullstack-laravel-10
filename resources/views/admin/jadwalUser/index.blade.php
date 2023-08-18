<x-app-layout>
    <x-main-div>
        <div class="py-10 px-5">
            <p class="text-center text-2xl font-bold  uppercase">Index Jadwal User</p>
            <x-search/>
            <div class="flex justify-between gap-2 mx-16 py-3">
				<a href="{{ route('dashboard.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('leader-jadwal.create') }}" class="btn btn-primary">+ Jadwal</a>
			</div>
            <div class="flex justify-center overflow-x-auto mx-10 pb-10">
                <table class="table table-fixed w-full shadow-md" id="searchTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalUser as $item)
                           @if ($item->kerjasama_id == Auth::user()->kerjasama_id)
                           @php
                               $no = 1;
                           @endphp
                           <tr>
                              <td class="p-1">{{ $no++ }}</td>
                              <td class="p-1">{{ $item->user->nama_lengkap }}</td>
                              <td class="p-1">{{ $item->tanggal }}</td>
                              <td class="p-1">{{ $item->shift->shift_name }}</td>
                              <td class="p-1">{{ $item->area }}</td>
                           </tr>
                           @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-5 mx-10">
                {{ $jadwalUser->links() }}
            </div>
        </div>
    </x-main-div>
</x-app-layout>