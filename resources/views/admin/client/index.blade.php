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
				<table class="table w-full shadow-md" id="searchTable">
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
						</tr>
					</thead>
					<tbody class="text-sm my-10">
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
									<td><img src="{{ asset('storage/images/' . $i->logo) }}" alt="no image" class="w-[100px]"></td>
								@else
									<td>
										<x-no-img />
									</td>
								@endif
								<td>{{ $i->name }}</td>
								<td>{{ $i->address }}</td>
								<td>{{ $i->province }}</td>
								<td>{{ $i->kabupaten }}</td>
								<td>{{ $i->zipcode }}</td>
								<td>{{ $i->email }}</td>
								<td>{{ $i->phone }}</td>
								<td>{{ $i->fax }}</td>
							</tr>
						@empty
							<tr>
								<td colspan="10" class="text-center">~ Data Kosong ~</td>
							</tr>
						@endforelse
					</tbody>
				</table>
				<div class="mt-5">
					{{ $client->links() }}
				</div>
			</div>
			<div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('data-client.create') }}" class="btn btn-primary">+ Client</a>
			</div>
		</div>

	</x-main-div>
</x-app-layout>
