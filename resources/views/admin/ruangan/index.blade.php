<x-app-layout>
	<div class="bg-slate-500 mx-10 rounded">
		<div>
			<p class="text-center text-2xl font-bold py-10 uppercase">Index Ruangan</p>
		</div>
		<div class="flex justify-end">
			<div class="input flex w-fit mx-10 items-center justify-end mb-5 input-bordered">
				<i class="ri-search-2-line"></i>
				<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
			</div>
		</div>

		<div class="overflow-x-auto mx-10">
			<table class="table table-zebra w-full" id="searchTable">
				<!-- head -->
				<thead>
					<tr>
						<th>#</th>
						<th>Client</th>
						<th>Nama Ruangan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@forelse ($ruangan as $i)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $i->kerjasama->client->name }}</td>
							<td>{{ $i->nama_ruangan}}</td>
							<td>
								<form action="{{ url('ruangan/' . $i->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<x-btn-edit>{{ url('ruangan/' . $i->id . '/edit') }}</x-btn-edit>
									<x-btn-submit></x-btn-submit>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4" class="text-center">Data Kosong</td>
						</tr>
					@endforelse
				</tbody>
			</table>
            <div class="mt-4">
                {{ $ruangan->links()}}
            </div>
			<div class="flex justify-end my-3 gap-2 mx-10">
				<a href="{{ route('admin.index') }}"
					class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
				<a href="{{ route('ruangan.create') }}"
					class="btn btn-warning hover:bg-yellow-600 border-none transition-all ease-in-out .2s">+ Ruangan</a>

			</div>

		</div>

</x-app-layout>
