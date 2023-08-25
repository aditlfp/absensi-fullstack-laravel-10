<x-app-layout>
    <x-main-div>
        <div class="py-10 px-5">
			<p class="text-center text-2xl font-bold  uppercase">Index Hari Libur</p>
            <div class="flex justify-end ">
				<div class="input flex items-center w-fit input-bordered my-10">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>
            <div class="flex justify-center overflow-x-auto mx-10 pb-10">
                <table class="table table-sm  table-zebra w-full shadow-md bg-slate-50" id="searchTable">
                    <thead>
                        <tr>
                            <th class="bg-slate-300 rounded-tl-2xl">#</th>
                            <th class="bg-slate-300 ">Hari libur</th>
                            <th class="bg-slate-300 rounded-tr-2xl">Tanggal Libur</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm my-10">
                        @php
                            $n = 1
                        @endphp
                        @forelse ($holiday as $i)
                        <tr>
                            <td class="py-1">{{ $n++ }}</td>
                            <td class="py-1">{{ $i->name }}</td>
                            <td class="py-1">{{ $i->tanggal_libur }}</td>
                        </tr>
                            
                        @empty
                            
                        <tr>
                            <td colspan="3" class="text-center">~ Data Kosong ~</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-5 mx-10">
                {{ $holiday->links() }}
            </div>
            <div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('holiday.create') }}" class="btn btn-primary">+ Hari Libur</a>
			</div>
        </div>
    </x-main-div>
</x-app-layout>