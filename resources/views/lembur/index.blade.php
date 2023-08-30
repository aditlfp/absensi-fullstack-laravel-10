<x-app-layout>
	<div class="bg-slate-500  sm:mx-10 mx-5 rounded-md shadow-md mb-[12.5rem]">
		<div class="mx-5 my-5">
			<form action="{{ route('lembur.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="sm:flex sm:justify-center sm:gap-3 sm:mb-3">
					<div id="my_camera" class="bg-slate-200 px-10 rounded"></div>
					<div id="results" name="image" class="mt-1 sm:mt-0 rounded"></div>
				</div>
				<div class="flex justify-center">
					<button type=button onclick="take_snapshot()" class="p-2 my-2 px-3 mb-5 text-white bg-blue-400 rounded-full"><i
							class="ri-camera-fill"></i></button>
				</div>
				<input type="text" id="image" name="image" class="image-tag" hidden>
				<div class="flex flex-col gap-2">
				<div class="flex flex-col justify-between">
					<label>Nama: </label>
					<input type="text" id="user_id" name="user_id" value="{{ Auth::user()->id }}" hidden>
					<input type="text" value="{{ Auth::user()->name }}" disabled class="input input-bordered">
				</div>
				<div class="flex flex-col justify-between">
					<label>Bermitra Dengan: </label>
					<input type="text" name="kerjasama_id" id="kerjasama_id" hidden value="{{ Auth::user()->kerjasama_id }}">
					<input type="text" value="{{ Auth::user()->kerjasama->client->name }}" disabled class="input input-bordered">

				</div>
				<div>
						<div>
							<label>Perlengkapan: </label>
						</div>
						<div class="p-2 bg-white rounded-lg ">
							<div class="grid grid-cols-1">
								@forelse ($dev as $arr)
									@if (Auth::user()->devisi_id == $arr->id)
										@foreach ($arr->perlengkapan as $i)
										<div>
											<input type="checkbox" name="perlengkapan[]" id="perlengkapan" value="{{ $i->name }}"
												class="checkbox checkbox-sm m-2" >
											<label for="perlengkapan">{{ $i->name }}</label>
										</div>
										@endforeach
									@else
							
									@endif
								@empty
									<p>~ Kosong ~</p>
								@endforelse
							</div>
						</div>
					</div>
				<div>
					<label>Deskripsi: </label>
					<textarea name="deskripsi" id="deskripsi" value="" placeholder="deskripsi..."
					 class="w-full textarea textarea-bordered"></textarea>
				</div>
				<div class="flex-col hidden">
					<label>Keterangan: </label>
					<div class="flex justify-end mt-1">
						<input name="keterangan" type="radio" value="lembur" checked class="radio cursor-pointer checked:bg-blue-500"><span
							class="mx-2">Lembur</span>
					</div>
				</div>
				<div class="flex flex-col">
					<label for="jam_mulai">Jam Mulai</label>
					<input type="time" name="jam_mulai" id="jam_mulai" class="input input-bordered w-full">
				</div>
				</div>
				@forelse ($lembur as $i)
					@if (Auth::user()->id == $i->user_id)
						@forelse ($absensi as $arr)
							@if (Auth::user()->id == $arr->user_id && $arr->absensi_type_pulang != null)
							<div class="flex justify-center sm:justify-end gap-2 mt-3">
								<button type="submit" class="p-2 my-2 px-4 text-white bg-blue-500 hover:bg-blue-600 rounded transition-all ease-linear .2s">Mulai Lembur</button>
								<a href="{{ route('dashboard.index') }}" class="p-2 my-2 px-4 text-white bg-red-500 hover:bg-red-600 rounded transition-all ease-linear .2s">
										Back
									</a>
							</div>
							@else
							<div class="flex justify-center sm:justify-end gap-2 mt-3">
								<button type="submit" class="p-2 my-2 px-4 text-slate-200 bg-blue-300 rounded transition-all ease-linear .2s disabled" disabled>Belum Absen</button>
								<a href="{{ route('dashboard.index') }}" class="p-2 my-2 px-4 text-white bg-red-500 hover:bg-red-600 rounded transition-all ease-linear .2s">
										Back
									</a>
							</div>
							@endif
						@empty
							<div class="flex justify-center sm:justify-end gap-2 mt-3">
								<button type="submit" class="p-2 my-2 px-4 text-slate-200 bg-blue-300 rounded transition-all ease-linear .2s disabled" disabled>Belum Absen</button>
								<a href="{{ route('dashboard.index') }}" class="p-2 my-2 px-4 text-white bg-red-500 hover:bg-red-600 rounded transition-all ease-linear .2s">
										Back
									</a>
							</div>
						@endforelse
					@else
						
					@endif
				@empty
				<div class="flex justify-center sm:justify-end gap-2 mt-3">
					<button type="submit" class="p-2 my-2 px-4 text-white bg-blue-500 hover:bg-blue-600 rounded transition-all ease-linear .2s">Mulai Lembur</button>
					<a href="{{ route('dashboard.index') }}" class="p-2 my-2 px-4 text-white bg-red-500 hover:bg-red-600 rounded transition-all ease-linear .2s">
							Back
						</a>
				</div>
				@endforelse
			</form>
		</div>
	</div>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 80
		});
		Webcam.attach('#my_camera');

		function take_snapshot() {
			Webcam.snap(function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('results').innerHTML =
					'<img id="imgprev" src="' + data_uri + '"/>';
			});
			// Webcam.reset();
		}
	</script>
</x-app-layout>
