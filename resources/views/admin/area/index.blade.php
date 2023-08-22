<x-app-layout>
    <x-main-div>
        <div>
			<p class="text-center text-2xl font-bold py-10 uppercase">Index Area</p>
        </div>
        <div>
            <x-search/>
        </div>
        <div class="flex justify-between mx-10 mb-5">
            <a href="{{ route('admin.index') }}"
					class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
            <a href="{{ route('area.create') }}"
					class="btn btn-warning hover:bg-yellow-600 border-none transition-all ease-in-out .2s">+ Area</a>
        </div>
        <div class="overflow-x-auto mx-10 mb-5">
            <table class="table table-zebra w-full" id="searchTable">
                <thead>
                    <tr>
                        <th class="flex">#</th>
                        <th>client</th>
                        <th>nama area</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($area as $i)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $i->kerjasama->client->name }}</td>
                            <td>{{ $i->nama_area }}</td>
                            <td>
                                <form action="{{ url('area/' . $i->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<x-btn-edit>{{ url('area/' . $i->id . '/edit') }}</x-btn-edit>
									<x-btn-submit></x-btn-submit>
								</form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">~ Kosong ~</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-main-div>
</x-app-layout>