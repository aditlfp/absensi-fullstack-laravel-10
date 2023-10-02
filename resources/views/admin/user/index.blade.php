<x-app-layout>
	<x-main-div>
		<div>
			<p class="text-center text-2xl font-bold py-10 uppercase">Data All User</p>
		</div>
		{{-- atas --}}
		<div class="flex justify-between items-center overflow-hidden mx-10 my-1">
			<div>
				<form id="filterForm" action="{{ route('users.index') }}" method="GET" class="p-1">
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
			<div class=" flex items-center ">
				<x-search />
			</div>
		</div>

		<div class="overflow-x-auto mx-10 my-10">
			<table class="table table-fixed table-zebra w-full bg-slate-50" id="searchTable">
				<!-- head -->
				<thead>
					<tr>
						<th class="bg-slate-300 rounded-tl-2xl">#</th>
						<th class="bg-slate-300 ">IMAGE</th>
						<th class="bg-slate-300 ">NAMA</th>
						<th class="bg-slate-300 ">NAMA LENGKAP</th>
						<th class="bg-slate-300 ">EMAIL</th>
						<th class="bg-slate-300 ">KERJASAMA</th>
						<th class="bg-slate-300 rounded-tr-2xl">AKSI</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
						@forelse ($user as $i)
							<tr>
								<td>{{ $no++ }}</td>
								@if ($i->image == 'no-image.jpg')
									<td>
										<x-no-img />
									</td>
								@elseif(Storage::disk('public')->exists('images/' . $i->image))
									<td><img class="lazy lazy-image" loading="lazy" src="{{ asset('storage/images/' . $i->image) }}" data-src="{{ asset('storage/images/' . $i->image) }}" alt="" srcset="" width="120px"></td>
								@else
								    <td>
										<x-no-img />
									</td>
								@endif
								<td>{{ $i->name }}</td>
								<td class="break-words whitespace-pre-line">{{ $i->nama_lengkap }}</td>
								<td class="break-words whitespace-pre-line">{{ $i->email }}</td>
								@if ($i->kerjasama == null || $i->kerjasama->client == null)
									<td>kosong</td>
								@else
									<td class="break-words whitespace-pre-line">{{ $i->kerjasama->client->name }}</td>
								@endif
								<td class="space-y-2">
									<x-btn-edit>{{ url('users/' . $i->id . '/edit') }}</x-btn-edit>
									<form action="{{ url('users/' . $i->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<x-btn-submit />
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="7" class="text-center">Data Kosong</td>
							</tr>
						@endforelse
				</tbody>
			</table>
			<div class="mt-5">
				{{ $user->links() }}
			</div>
		</div>
		<div class="flex justify-end gap-2 mx-16 py-3 mb-10">
			<a href="{{ route('admin.index') }}" class="btn btn-error">Back</a>
			<button><a href="{{ route('users.create') }}" class="btn btn-primary">+ User</a></button>
		</div>
	</x-main-div>
		<script>
				$(document).ready(function () {
				// Saat halaman dimuat, ambil semua elemen dengan class "lazy-image"
				var lazyImages = $('.lazy-image');
			
				// Fungsi untuk memuat gambar ketika mendekati jendela pandangan pengguna
				function lazyLoad() {
					lazyImages.each(function () {
						var image = $(this);
						if (image.is(':visible') && !image.attr('src')) {
							image.attr('src', image.attr('data-src'));
						}
					});
				}
			
				// Panggil fungsi lazyLoad saat halaman dimuat dan saat pengguna menggulir
				lazyLoad();
				$(window).on('scroll', lazyLoad);
			});
		</script>
</x-app-layout>
