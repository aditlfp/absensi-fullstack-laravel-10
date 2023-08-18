<x-app-layout>
	<div>
		<x-main-div>
			<div>
				<p class="text-center text-2xl font-bold py-10 uppercase">Index Perlengkapan</p>
			</div>
			<div class="flex justify-end">
				<div class="input flex w-fit mx-10 items-center justify-end my-10 input-bordered">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>

			<div class="overflow-x-auto mx-10 flex justify-center">
				<table class="table w-full" id="searchTable">
					<!-- head -->
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Perlengkapan</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
						@php
							$no = 1;
						@endphp
						@forelse ($data as $i)
							<tr>
								<td class="py-1">{{ $no++ }}</td>
								<td class="py-1">{{ $i->name }}</td>
								<td class="py-1">
									<form action="{{ url('perlengkapan/' . $i->id) }}" method="post">
										@csrf
										@method('DELETE')
										<x-btn-submit />
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="3" class="text-center">Data Kosong</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="mt-5 mx-10">
				{{ $data->links()}}
			</div>
			<div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('perlengkapan.create') }}" class="btn btn-primary">+ Perlengkapan</a>
			</div>
		</x-main-div>
	</div>
</x-app-layout>
