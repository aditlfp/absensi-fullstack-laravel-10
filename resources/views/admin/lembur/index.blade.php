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
						$prevUser = null;
					@endphp
					@forelse ($lembur as $i)
					@if ($prevUser != $i->user->name)
						<tr>
							<td class="py-1">{{ $no++ }}</td>
							
							<td class="py-1">{{ $i->user->name }}</td>
							@if ($i->jam_selesai == null)
								<td class="py-1">Belum Selesai Lembur</td>
							@else
							@php
								$masuk = strtotime($i->jam_mulai);
								$keluar = strtotime($i->jam_selesai);

								$msk = date('H', $masuk);
								$klr = date('H' ,$keluar);
								
								
								
								$tot =  $klr - $msk;

							@endphp

								<td class="py-1">{{ $tot . ' Jam'  }}</td>
							@endif
						</tr>
					@endif

					@empty
						<tr>
							<td colspan="3" class="text-center py-1">Kosong</td>
						</tr>
					@endforelse
				</tbody>
			</table>
			<div id="pag-1" class=" mb-5 mx-5">
				{{ $lembur->links() }}
			</div>
		</div>
		<div class="flex justify-end py-5 mx-5 sm:pb-10">
			<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
		</div>
	</x-main-div>
</x-app-layout>
