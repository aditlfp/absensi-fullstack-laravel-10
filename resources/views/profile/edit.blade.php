<x-app-layout>
	<x-main-div>
		<div class="py-10">
			<div>
				<p class="text-center text-2xl font-bold py-10 uppercase">Edit Profil Saya</p>
			</div>
			<form action="{{ route('profile.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
				@method('PUT')
				@csrf
				<div class="bg-slate-500 mx-5 rounded">
					<div class=" bg-slate-100 px-5 py-5 rounded shadow">
						<!-- Nama lengkap -->
						<div>
							<x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
							<x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap"
								value="{{ $dataUser->nama_lengkap }}" required autofocus autocomplete="nama_lengkap" />
							<x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
						</div>
						<!-- Email Address -->
						<div class="mt-4">
							<x-input-label for="email" :value="__('Email')" />
							<x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
								value="{{ $dataUser->email }}" required autocomplete="username" />
							<x-input-error :messages="$errors->get('email')" class="mt-2" />
						</div>
						{{-- foto Profile --}}
						<div class="md:mt-4 p-1">
                                <x-input-label for="foto Profil" :value="__('foto Profil')" />
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
                                        <span class="text-xs font-semibold text-slate-700/70">+ Gambar</span>
                                        <input id="img" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
                                            type="file" name="image" :value="old('image')" autofocus autocomplete="img" />
                                    </span>
                                </label>
                                <x-input-error :messages="$errors->get('image1')" class="mt-2" />
						</div>
						<input type="text" name="oldimage" value="{{ $dataUser->image }}" class="hidden" />
					</div>
					<div class="flex justify-center mt-10 gap-2">
						<button type="submit" class="btn btn-primary">Save</button>
						<a href="{{ route('profile.index') }}" class="btn btn-error transition-all ease-linear .2s">
							Kembali
						</a>
					</div>
				</div>
			</form>
		</div>
	</x-main-div>
</x-app-layout>
