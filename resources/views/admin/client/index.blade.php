<x-app-layout>
	<x-main-div>
		<div class="py-10 px-5">
			<p class="text-center text-2xl font-bold  uppercase">Index Client</p>
			<div class="flex justify-end ">
				<div class="input flex items-center w-fit input-bordered my-10">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>
			<div class="flex justify-center overflow-x-auto mx-10 pb-10">
				<table class="table table-fixed table-zebra w-full shadow-md" id="searchTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Logo</th>
							<th>Name Client</th>
							<th>Alamat</th>
							<th>Provinsi</th>
							<th>Kabupaten</th>
							<th>Kode Pos</th>
							<th>Email</th>
							<th>No. Telepon</th>
							<th>No. Fax</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class=" text-sm my-10">
						@php
							$no = 1;
						@endphp
						@forelse ($client as $i)
							<tr>
								<td>{{ $no++ }}</td>
								@if ($i->logo == 'no-image.jpg')
									<td>
										<x-no-img />
									</td>
								@elseif($i->logo != asset('storage/images/' . $i->logo))
									<td><img src="{{ asset('storage/images/' . $i->logo) }}" alt="no image" width="120px"></td>
								@else
									<td>
										<x-no-img />
									</td>
								@endif
								<td class="hyphens-auto whitespace-pre-wrap ">{{ $i->name }}</td>
								<td class="hyphens-auto whitespace-pre-wrap">{{ $i->address }}</td>
								<td>{{ $i->province }}</td>
								<td>{{ $i->kabupaten }}</td>
								<td>{{ $i->zipcode }}</td>
								<td class="break-words whitespace-pre-line">{{ $i->email }}</td>
								<td class="break-words whitespace-pre-line">{{ $i->phone }}</td>
								<td>{{ $i->fax }}</td>
									<td class="space-y-2">
										<x-btn-edit>{{ url('client/data-client/' . $i->id . '/edit') }}</x-btn-edit>
										<form action="{{ url('client/data-client/' . $i->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<x-btn-submit />
										</form>
									</td>
							</tr>
						@empty
							<tr>
								<td colspan="10" class="text-center">~ Data Kosong ~</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
				<div class="mt-5 mx-10">
					{{ $client->links() }}
				</div>
			<div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('data-client.create') }}" class="btn btn-primary">+ Client</a>
			</div>
		</div>

	</x-main-div>
</x-app-layout>
