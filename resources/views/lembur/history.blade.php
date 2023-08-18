<x-app-layout>
	<x-main-div>
		<p class="text-center text-2xl font-bold py-10 uppercase">List Lembur</p>
		<div class="">
		<div class="overflow-x-auto  mx-2">
			<table class="table  table-zebra w-full mb-5">
				<thead>
					<tr>
						<th class="hidden sm:block">#</th>
						<th >Name</th>
						<th>Lama Lembur</th>
						<th>Tanggal Lembur</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@forelse ($lembur as $i)
                    @if (Auth::user()->id == $i->user_id)
                        <tr>
                            <td class="py-1 hidden sm:block">{{ $no++ }}</td>
                            <td class="py-1">{{ $i->user->name }}</td>
                            @if ($i->jam_selesai == null)
                                <td class="py-1">Belum Selesai Lembur</td>
                            @else
                            @php
                                $jam_masuk = $i->jam_mulai;
                                $jam_keluar = $i->jam_selesai;
                                $masuk = strtotime($jam_masuk);
                                $keluar = strtotime($jam_keluar);

                                $msk = date('H.i', $masuk);
                                $klr = date('H.i', $keluar);
                                
                                $tot = (int) $klr - (int)$msk;

                            @endphp
                                <td class="py-1">{{ $tot . ' Jam'  }}</td>
                            @endif
							@php
							$tanggal = $i->created_at;
							// $tgl = date_format($tanggal,'D-m-Y');
							$tgl = Carbon\Carbon::createFromDate($tanggal)->isoFormat('dddd, D-MMMM-YYYY');
							
							@endphp
							<td>{{ $tgl }}</td>
                        </tr>
                    @else
                    @endif
					@empty
						<tr>
							<td colspan="4" class="text-center py-1">Kosong</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
			<div id="pag-1" class=" mb-5 mx-10">
				{{ $lembur->links() }}
			</div>
	</div>
		<div class="flex justify-end py-5 mx-5 sm:pb-10">
			<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
		</div>
	</x-main-div>
</x-app-layout>
