<x-app-layout>
	<div class="bg-slate-500 mx-10 mb-10 shadow-md p-2 rounded-md">
		<div>
			<p class="text-center text-2xl font-bold py-10 uppercase">Data All User</p>
		</div>
		{{-- atas --}}
		<div class="flex justify-between items-center overflow-hidden mx-10 my-1">
			<div>
				<form id="filterForm" action="{{ route('users.index') }}" method="GET" class="p-1">
					@csrf
					<select name="filterKerjasama" id="filterKerjasama" class="select select-bordered active:border-none border-none">
						<option selected disabled>~ Kerja Sama ~</option>
						@foreach ($kerjasama as $i)
							<option value="{{ $i->id }}">{{ $i->client->name }}</option>
						@endforeach
					</select>
					<button type="submit"
						class="bg-blue-500 px-5 py-2 rounded-md hover:bg-blue-600 transition-colors ease-in .2s font-bold uppercase ml-3">Filter</button>
				</form>
			</div>
			<div class="input flex items-center input-bordered">
				<x-search/>
			</div>
		</div>

		<div class="overflow-x-auto mx-10 my-10">
			<table class="table w-full" id="searchTable">
				<!-- head -->
				<thead>
					<tr>
						<th>#</th>
						<th>IMAGE</th>
						<th>NAMA</th>
						<th>EMAIL</th>
						<th>KERJASAMA</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@if ($user == null)
						<tr>
							<td class="text-center" colspan="5">Data Kosong</td>
						</tr>
					@elseif($client == null)
						@foreach ($user as $i)
							<tr>
								<td>{{ $no++ }}</td>
								@if ($i->image == 'no-image.jpg')
									<td><x-no-img /></td>
								@else
									<td><img src="{{ asset('storage/images/' . $i->image) }}" alt="" srcset="" width="120px"></td>
								@endif
								<td>{{ $i->name }}</td>
								<td>{{ $i->email }}</td>
								<td>Client Saat Ini Kosong</td>
								<td>
								<form action="{{ url('users/'. $i->id) }}" method="DELETE">
								@csrf
								@method('DESTROY')
									<x-btn-submit />
									<x-btn-edit>{{ url('users/'. $i->id.'/edit') }}</x-btn-edit>
								</form></td>
							</tr>
						@endforeach
					@else
						@forelse ($user as $i)
							<tr>
								<td>{{ $no++ }}</td>
								@if ($i->image == 'no-image.jpg')
									<td><x-no-img /></td>
								@else
									<td><img src="{{ asset('storage/images/' . $i->image) }}" alt="" srcset="" width="120px"></td>
								@endif
								<td>{{ $i->name }}</td>
								<td>{{ $i->email }}</td>
								<td>{{ $i->kerjasama->client->name}}</td>
								<td>
								<form action="{{ url('users/'. $i->id) }}" method="DELETE">
								@csrf
								@method('DESTROY')
									<x-btn-submit />
									<x-btn-edit>{{ url('users/'. $i->id.'/edit') }}</x-btn-edit>
								</form></td>
							</tr>
						@empty
							<tr>
								<td colspan="5">Data Kosong</td>
							</tr>
						@endforelse
				</tbody>
			</table>
			<div class="mt-5">
				{{ $user->links() }}
			</div>
			@endif
		</div>
		<div class="flex justify-end mx-16 py-3">
			<x-nav-link class="px-3 py-1" :href="route('users.create')" :active="true">
				{{ __('Create') }}
			</x-nav-link>
		</div>

</x-app-layout>
