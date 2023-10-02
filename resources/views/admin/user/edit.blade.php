<x-app-layout>
	<x-main-div>
	<form action="{{ url('users/'.$dataUser->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div>
			<p class="text-center text-2xl font-bold my-10">Edit User</p>
			<div class="mx-10 my-10 bg-slate-100 px-10 py-5 rounded shadow">

				<!-- Name -->
				<div>
					<x-input-label for="name" :value="__('Nama')" />
					<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required
						autofocus autocomplete="name" />
					<x-input-error :messages="$errors->get('name')" class="mt-2" />
				</div>
				<!-- Nama lengkap -->
				<div>
					<x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
					<x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required
						autofocus autocomplete="nama_lengkap" />
					<x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
				</div>

				<!-- Email Address -->
				<div class="mt-4">
					<x-input-label for="email" :value="__('Email')" />
					<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required
						autocomplete="username" />
					<x-input-error :messages="$errors->get('email')" class="mt-2" />
				</div>
				<!-- client -->
				<div class="mt-4">
					<x-input-label for="client" :value="__('Client')" />
					<select name="kerjasama_id" id="kerjasama_id" class="select select-bordered w-full mt-1">
						<option disabled>~ Pilih Client ~</option>
						@foreach ($client as $i)
							<option name="kerjasama_id" {{ $dataUser->kerjasama_id == $i->id ? 'selected' : '' }}  value="{{ $i->id }}" class="py-2">{{ $i->name }}</option>
						@endforeach
					</select>
				</div>
				<!-- client -->
				<div class="mt-4">
					<x-input-label for="divisi" :value="__('Divisi')" />
					<select name="devisi_id" id="devisi_id" class="select select-bordered w-full mt-1">
						<option selected disabled>~ Pilih Devisi ~</option>
						@foreach ($dev as $i)
							<option name="devisi_id" {{ $dataUser->devisi_id == $i->id ? 'selected' : '' }} value="{{ $i->id }}" class="py-2">{{ $i->name }}</option>
						@endforeach
					</select>
				</div>
				{{-- foto Profile --}}
				<div class="md:mt-4">
					<div class="preview hidden">
						<img class="img1" src="" alt="" srcset="" height="120px" width="120px">
					</div>
					<x-input-label>Foto Profil</x-input-label>
					<input type="text" name="oldimage" value="{{ $user->image }}" class="hidden"/>
					<input type="file" class="file-input file-input-bordered w-full flex flex-row" id="img" name="image"/>
					<x-input-error class="mt-2" :messages="$errors->get('img')" />
				</div>
				<div class="flex justify-end mt-10 gap-2">
					<button type="submit" class="btn btn-primary">Save</button>
					<a href="{{ route('users.index')}}" class="btn btn-error transition-all ease-linear .2s">
						Back
					</a>
				</div>
			</div>
		</div>
	</form>
</x-main-div>
</x-app-layout>