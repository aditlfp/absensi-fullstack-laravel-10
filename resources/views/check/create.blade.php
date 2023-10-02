<x-app-layout>
	<x-main-div>
		<div class="px-5 py-10">
			<div>
                <p class="text-center text-lg sm:text-2xl font-bold py-10 uppercase">Check Point</p>
            </div>
			<form method="POST" action="{{ route('checkpoint-user.store') }}" class=" my-10" id="form" enctype="multipart/form-data">
			@csrf
			<div class="bg-slate-100 px-10 py-5 rounded shadow">
				<div class="flex flex-col justify-between">
					<label>Nama: </label>
					<input type="text" id="user_id" name="user_id" value="{{ Auth::user()->id }}" hidden>
					<input type="text" value="{{ Auth::user()->name }}" disabled class="input input-bordered">
				</div>
				<div class="flex flex-col  justify-between">
					<label>Bermitra Dengan: </label>
					<input type="text" name="divisi_id" id="divisi_id" hidden value="{{ Auth::user()->kerjasama_id }}">
					<input type="text" value="{{ Auth::user()->kerjasama->client->name }}" disabled
						class="input input-bordered">
				</div>
				<div>
					<x-input-label for="type_check" :value="__('Check Point')" />
					<select name="type_check" id="type_check" class="select select-bordered w-full mt-1">
						<option selected disabled>~ Pilih Check Point ~</option>
						<option name="type_check" value="harian" class="py-2">Harian</option>
						<option name="type_check" value="mingguan" class="py-2">Mingguan</option>
						<option name="type_check" value="bulanan" class="py-2">Bulanan</option>
						<option name="type_check" value="isidental" class="py-2">Isidental</option>
					</select>
					<x-input-error :messages="$errors->get('type_check')" class="mt-2" />
				</div>
				<div class="my-5">
					<x-input-label for="deskripsi" :value="__('Deskripsi')" />
					<textarea name="deskripsi" id="deskripsi" rows="3" class="textarea textarea-bordered w-full"></textarea>
					<x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
				</div>
				{{-- img --}}
				<div class="my-5 p-1">
					<x-input-label for="img" :value="__('Foto Bukti')" />
					<div class="preview hidden w-full">
						<span class="flex justify-center items-center">
							<label for="img" class="p-1">
								<img class="img1 ring-2 ring-slate-500/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s"
									src="" alt="" srcset="" height="120px" width="120px">
								
							</label>
						</span>
					</div>
					<label for="img"
						class="w-full iImage1 flex flex-col items-center justify-center rounded-md bg-slate-300/70  ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s">
						<span class="p-3 flex justify-center flex-col items-center">
							<i class="ri-image-add-line text-xl text-slate-700/90"></i>
							<span class="text-xs font-semibold text-slate-700/70">+ Bukti</span>
							<input id="img" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
								type="file" name="img" :value="old('img')" autofocus autocomplete="img" />
						</span>
					</label>
					<x-input-error :messages="$errors->get('img')" class="mt-2" />
				</div>
			</div>
			<div class="flex justify-center sm:justify-end gap-2 mt-10">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<a href="{{ route('dashboard.index') }}" class="btn btn-error hover:bg-red-500 transition-all ease-linear .2s">
					Kembali
				</a>
			</div>
			</form>
		</div>
	</x-main-div>
</x-app-layout>