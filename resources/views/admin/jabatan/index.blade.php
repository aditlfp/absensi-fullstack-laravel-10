<x-app-layout>
    <x-main-div>
		<div class="py-10 px-5">
			<p class="text-center text-2xl font-bold  uppercase">Index Jabatan</p>
			<div class="flex justify-end ">
				<div class="input flex items-center w-fit input-bordered my-10">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>
			<div class="flex justify-center overflow-x-auto mx-10 pb-10">
				<table class="table w-full shadow-md bg-slate-50" id="searchTable">
					<thead>
						<tr>
							<th class="bg-slate-300 rounded-tl-2xl">#</th>
							<th class="bg-slate-300 ">Kode Jabatan</th>
							<th class="bg-slate-300 ">Divisi</th>
							<th class="bg-slate-300 ">Tipe Jabatan</th>
							<th class="bg-slate-300 ">Nama Jabatan</th>
							<th class="bg-slate-300 rounded-tr-2xl">Action</th>
						</tr>
					</thead>
					<tbody class="text-sm my-10">
						@php
							$no = 1;
						@endphp
						@forelse ($jabatan as $i)
							<tr>
								@if ($i->divisi_id == null)
									<td class="required">{{ $no++ }}</td>
								@else
									<td>{{ $no++ }}</td>
								@endif
									<td>{{ $i->code_jabatan }}</td>
								@if ($i->divisi_id == null)
									<td class="text-white"><span class="bg-red-500 rounded-full px-2">Belum Di Isi</span></td>
								@else
									<td>{{ $i->divisi->name }}</td>
								@endif
								<td>{{ $i->type_jabatan }}</td>
								<td>{{ $i->name_jabatan }}</td>
								<td class="flex gap-2">
									<x-btn-edit>{{ route('jabatan.edit', [$i->id]) }}</x-btn-edit>
									<form action="{{ route('jabatan.destroy', [$i->id]) }}" method="POST">
										@csrf
										@method('DELETE')
										<x-btn-submit/>
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
					{{ $jabatan->links() }}
				</div>
			<div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('jabatan.create') }}" class="btn btn-primary">+ Jabatan</a>
			</div>
		</div>

	</x-main-div>
</x-app-layout>