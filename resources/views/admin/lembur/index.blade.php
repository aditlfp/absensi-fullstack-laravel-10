<x-app-layout>
	<x-main-div>
		<p class="text-center text-2xl font-bold py-10 uppercase">List Lembur</p>
		<div class="overflow-x-auto mx-10 flex justify-center">
			<table class="table table-zebra w-full mb-10">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Lama Lembur</th>
					</tr>

				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@forelse ($lembur as $i)
						<tr>
							<td class="py-1">{{ $no++ }}</td>
							<td class="py-1">{{ $lembur->user->name }}</td>
							@if ($lembur->jam_selesai == null)
								<td class="py-1">Belum Selesai Lembur</td>
							@else
								<td class="py-1">{{ $lembur->jam_mulai + $lembur->jam_selesai }}</td>
							@endif
						</tr>
					@empty
						<tr>
							<td colspan="3" class="text-center py-1">Kosong</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</x-main-div>
</x-app-layout>
