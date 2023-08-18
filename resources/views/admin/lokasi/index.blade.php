<x-app-layout>
    <x-main-div>
        <div class="py-10 px-5">
            <p class="text-center text-2xl font-bold  uppercase">Index Lokasi</p>
			<div class="flex justify-end mx-10">
				<div class="input flex items-center w-fit input-bordered my-10">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>
            <div class="flex justify-center overflow-x-auto mx-10 pb-10">
                <table class="table table-fixed px-5 w-full shadow-md" id="searchTable">
                    <thead>
						<tr>
							<th>#</th>
							<th>Logo</th>
							<th>Client</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Radius</th>
							<th>Action</th>
						</tr>
					</thead>
                    <tbody class="text-sm my-10">
                        @php
                            $n = 1
                        @endphp
                        @forelse ($lokasi as $i)
                        <tr>
                            <td>{{ $n++ }}</td>
                            @if ($i->client->logo == 'no-image.jpg')
									<td>
										<x-no-img />
									</td>
								@elseif($i->client->logo != asset('storage/images/' . $i->client->logo))
									<td ><img src="{{ asset('storage/images/' . $i->client->logo) }}" alt="no image" width="120px"></td>
								@else
									<td>
										<x-no-img />
									</td>
								@endif
                            <td class="break-words whitespace-pre-line">{{ $i->client->name }}</td>
                            <td>{{ $i->latitude }}</td>
                            <td>{{ $i->longtitude }}</td>
                            <td>{{ $i->radius }} Meter</td>
                            <td>
                                <div class="gap-2 flex">
                                <x-btn-edit>{{ route('lokasi.edit', [$i->id]) }}</x-btn-edit>
									<form action="{{ route('lokasi.destroy', [$i->id]) }}" method="POST">
										@csrf
										@method('DELETE')
										<x-btn-submit/>
									</form>
								</div>
                            </td>
                        </tr>
                            
                        @empty
                            <tr>
                                <td colspan="6">~ Kosong ~</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                <div class="mt-5 mx-10">
					{{ $lokasi->links() }}
				</div>
				<div class="flex justify-end my-3 gap-2 mx-10">
				<a href="{{ route('admin.index') }}"
					class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
				<a href="{{ route('lokasi.create') }}"
					class="btn btn-warning hover:bg-yellow-600 border-none transition-all ease-in-out .2s">+ Lokasi</a>

			</div>
        </div>
    </x-main-div>
</x-app-layout>