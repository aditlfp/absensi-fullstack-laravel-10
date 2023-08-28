<x-app-layout>
    <x-main-div>
		<div class="py-10 px-5">
			<p class="text-center text-2xl font-bold  uppercase">Index Shift</p>
			<div class="flex justify-end ">
				<div class="input flex items-center w-fit input-bordered my-10">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>
			<div class="flex justify-center overflow-x-auto mx-10 pb-10">
				<table class="table table-fixed w-full shadow-md bg-slate-50" id="searchTable">
					<thead>
						<tr>
							<th class="bg-slate-300 rounded-tl-2xl">#</th>
							<th class="bg-slate-300 ">Jabatan</th>
							<th class="bg-slate-300 ">Name Client</th>
							<th class="bg-slate-300 ">Waktu Shift</th>
							<th class="bg-slate-300 ">Jam Mulai</th>
							<th class="bg-slate-300 ">Jam Selesai</th>
							<th class="bg-slate-300 rounded-tr-2xl">Action</th>
						</tr>
					</thead>
					<tbody class="text-sm my-10">
						@php
							$no = 1;
						@endphp
						@forelse ($shift as $i)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $i->jabatan->name_jabatan }}</td>
								<td class="break-words whitespace-pre-wrap">{{ $i->client->name }}</td>
								<td>{{ $i->shift_name }}</td>
								<td>{{ $i->jam_start }}</td>
								<td>{{ $i->jam_end }}</td>
								<td class="space-y-2">
									<x-btn-edit>{{ route('shift.edit', [$i->id]) }}</x-btn-edit>
									<form action="{{ route('shift.destroy', [$i->id]) }}" method="POST">
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
					{{ $shift->links() }}
				</div>
			<div class="flex justify-end gap-2 mx-16 py-3">
				<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
				<a href="{{ route('shift.create') }}" class="btn btn-primary">+ Shift</a>
			</div>
		</div>

	</x-main-div>
</x-app-layout>