<x-app-layout>
	<x-main-div>
		<div>
			<div>
				<p class="text-center text-2xl font-bold py-10 uppercase">Index Kerjasama</p>
			</div>
			<div class="flex justify-end mx-10 my-10">
				<div class="input flex items-center input-bordered w-fit">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>

			<div class="overflow-x-auto mx-10">
				<table class="table w-full" id="searchTable">
					<!-- head -->
					<thead>
						<tr>
							<th>#</th>
							<th>ID CLIENT</th>
							<th>VALUE</th>
							<th>EXPERIED</th>
							<th>APPROVED 1</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
						@php
							$no = 1;
						@endphp
						@forelse ($kerjasama as $i)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $i->client_id }}</td>
								<td>{{ toRupiah($i->value) }}</td>
								<td>{{ $i->experied }}</td>
								<td>{{ $i->approve1 }}</td>
								<td>
									<form action="{{ url('kerjasamas/' . $i->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<x-btn-submit />
										<x-btn-edit>{{ url('kerjasamas/' . $i->id . '/edit') }}</x-btn-edit>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="text-center ">~ Data kosong ~</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('kerjasamas.create') }}" class="btn btn-primary">+ Kerjasama</a>
			</div>
	</x-main-div>

</x-app-layout>
