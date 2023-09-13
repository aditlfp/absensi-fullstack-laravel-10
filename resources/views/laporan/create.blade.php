<x-app-layout>
	<x-main-div>
		<div class="p-5 py-10">
			<p class="text-center font-bold text-xl sm:text-2xl uppercase">Buat Laporan Harian</p>
			<form method="POST" action="{{ route('laporan.store') }}" class=" my-10" id="form" enctype="multipart/form-data">
				@csrf
				<div class="bg-slate-100 px-10 py-5 rounded shadow">
					{{-- client --}}
					<div class="my-5">
						<x-input-label for="client_id" :value="__('Client')" />
						<x-text-input id="client_id" class=" mt-1 w-full hidden" type="text" name="client_id"
							value="{{ Auth::user()->kerjasama->client->id }}" />
						<x-text-input id="user_id" class=" mt-1 w-full hidden" type="text" name="user_id"
							value="{{ Auth::user()->id }}" />
						<x-text-input readonly class="block mt-1 w-full text-sm sm:text-base" disabled type="text"
							value="{{ Auth::user()->kerjasama->client->name }}" />
					</div>
					{{-- ruangan --}}

					<div class="mt-4">
						<x-input-label for="ruangan" :value="__('Ruangan')" />
						<select name="ruangan_id" id="ruangan_id" class="select select-bordered w-full mt-1">
							<option selected disabled>~ Pilih Ruangan ~</option>
							@foreach ($ruangan as $i)
								<option name="ruangan_id" value="{{ $i->id }}" class="py-2">{{ $i->nama_ruangan }}</option>
							@endforeach
						</select>
						<x-input-error :messages="$errors->get('ruangan_id')" class="mt-2" />
					</div>

					{{-- belum --}}
					<div class="my-5 p-1">
						<x-input-label for="sebelum" :value="__('Sebelum')" />
						<div class="preview hidden w-full">
							<span class="flex justify-center items-center">
								<label for="img1" class="p-1">
									<img class="img1 ring-2 ring-slate-500/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s"
										src="" alt="" srcset="" height="120px" width="120px">
									
								</label>
							</span>
						</div>
						<label for="img"
							class="w-full iImage1 flex flex-col items-center justify-center rounded-md bg-slate-300/70  ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s">
							<span class="p-3 flex justify-center flex-col items-center">
								<i class="ri-image-add-line text-xl text-slate-700/90"></i>
								<span class="text-xs font-semibold text-slate-700/70">+ Gambar</span>
								<input id="img" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
									type="file" name="image1"/>
							</span>
						</label>
						<x-input-error :messages="$errors->get('image1')" class="mt-2" />
					</div>

					{{-- proses --}}
					<div class="my-5 p-1">
						<x-input-label for="proses" :value="__('Proses')" />
						<div class="preview2 hidden w-full">
							<span class="flex justify-center items-center">
								<label for="img2" class="p-1">
									<img class="img2 ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s"
										src="" alt="" srcset="" height="120px" width="120px">
									
								</label>
							</span>
						</div>
						<label for="img2"
							class="w-full iImage2 flex flex-col items-center justify-center rounded-md bg-slate-300/70 ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s">
							<span class="p-3 flex justify-center flex-col items-center">
								<i class="ri-image-add-line text-xl text-slate-700/90"></i>
								<span class="text-xs font-semibold text-slate-700/70">+ Gambar</span>
								<input id="img2" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
									type="file" name="image2"/>
							</span>
						</label>
					</div class="my-5">

					{{-- sudah --}}
					<div class="p-1">
						<x-input-label for="sesudah" :value="__('Sesudah')" />
						<div class="preview3 hidden w-full">
							<span class="flex justify-center items-center">
								<label for="img3" class="p-1">
									<img class="img3 ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s"
										src="" alt="" srcset="" height="120px" width="120px">
									
								</label>
							</span>
						</div>
						<label for="img3"
							class="w-full iImage3 flex flex-col items-center justify-center rounded-md bg-slate-300/70 ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s">
							<span class="p-3 flex justify-center flex-col items-center">
								<i class="ri-image-add-line text-xl text-slate-700/90"></i>
								<span class="text-xs font-semibold text-slate-700/70">+ Gambar</span>
								<input id="img3" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
									type="file" name="image3"/>
							</span>
						</label>
						<x-input-error :messages="$errors->get('image3')" class="mt-2" />
					</div>
					{{-- keterangan --}}
					<div class="my-5">
						<x-input-label for="keterangan" :value="__('Keterangan')" />
						<textarea name="keterangan" id="keterangan" rows="3" class="textarea textarea-bordered w-full"></textarea>
						<x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
					</div>
					<div class="flex justify-center sm:justify-end gap-2">
						<a href="{{ route('laporan.index') }}" class="btn btn-error hover:bg-red-500 transition-all ease-linear .2s">
							Back
						</a>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</x-main-div>
</x-app-layout>
