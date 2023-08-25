<x-app-layout>
    <div class="bg-slate-500 mx-10 rounded">
        <div>
            <p class="text-center text-2xl font-bold py-10 uppercase">Index Point</p>
        </div>
        <div class="flex justify-end">
            <div class="input flex w-fit mx-10 items-center justify-end mb-5 input-bordered">
                <i class="ri-search-2-line"></i>
                <input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
            </div>
        </div>
        <div class="overflow-x-auto mx-10">
            <table class="table table-zebra w-full bg-slate-50" id="searchTable">
                <thead>
                    <tr>
                        <th class="bg-slate-300 rounded-tl-2xl">#</th>
                        <th class="bg-slate-300">Client</th>
                        <th class="bg-slate-300">Point</th>
                        <th class="bg-slate-300 rounded-tr-2xl">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1
                    @endphp
                    @forelse ($point as $i)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $i->client->name }}</td>
                            <td>{{ $i->sac_point }}</td>
                            <td>
                                <div class="gap-2 flex">
                                <x-btn-edit>{{ route('point.edit', [$i->id]) }}</x-btn-edit>
									<form action="{{ route('point.destroy', [$i->id]) }}" method="POST">
										@csrf
										@method('DELETE')
										<x-btn-submit/>
									</form>
								</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">~ Kosong ~</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            <div class="flex justify-center sm:justify-end my-3 gap-2 mr-0 sm:mr-9">
                <a href="{{ route('admin.index') }}"
                    class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
                <a href="{{ route('point.create') }}"
                    class="btn btn-warning hover:bg-yellow-600 border-none transition-all ease-in-out .2s">+ Point</a>

            </div>
        </div>
    </div>
</x-app-layout>