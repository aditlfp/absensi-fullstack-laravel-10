<x-app-layout>
	<div class="bg-zinc-500  sm:mx-10 mx-5 rounded-md shadow-md mb-[12.5rem]">
		<div class="mx-5 my-5">
			<form action="{{ route('lembur.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('POST')
				<div class="sm:flex sm:justify-center sm:gap-3 sm:mb-3">
					<div id="my_camera" class="bg-slate-200 rounded"></div>
					<div id="results" class=" mt-1 sm:mt-0 rounded"></div>
				</div>
				<div class="flex justify-center">
					<button type=button onclick="take_snapshot()" class="p-2 my-2 px-3 mb-5 text-white bg-blue-400 rounded-full"><i
							class="ri-camera-fill"></i></button>
				</div>
				<input type="text" id="image" name="image" class="image-tag" hidden>
				<div>
					<label for="name">Name</label>
					<input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
				</div>
				<div>
					<label for="kerjasama_id">Bermitra</label>
					<input type="text" name="kerjasama_id" id="kerjasama_id" value="{{ Auth::user()->kerjasama_id }}">
				</div>
				<div>
					@foreach ($dev as $arr)
						@if (Auth::user()->devisi_id == $arr->id)
							@foreach ($arr->perlengkapan as $i)
								<input type="checkbox" name="perlengkapan[]" id="perlengkapan" value="{{ $i->name }}"
									class="checkbox checkbox-sm m-2">
								<label for="perlengkapan">{{ $i->name }}</label>
							@endforeach
						@else
						@endif
					@endforeach
				</div>
				<div>
					<label for="keterangan"></label>
					<input type="text" name="keterangan" id="keterangan">
				</div>
				<div>
					<label for="deskripsi"></label>
					<input type="text" name="deskripsi" id="deskripsi">
				</div>
				<div>
					<label for="jam_mulai"></label>
					<input type="time" name="jam_mulai" id="jam_mulai">
				</div>
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
