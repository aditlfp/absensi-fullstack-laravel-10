<x-app-layout>
	<x-main-div>
		<p class="text-center text-2xl uppercase font-bold">Edit Ruangan</p>
		<form method="POST" action="{{ route('ruangan.update', $ruanganId->id) }}" class="mx-[25%] my-10" id="form">
			@csrf
            @method('PATCH')
			<div class="bg-slate-100 px-10 py-5 rounded shadow">
                <div>
                    <x-input-label for="Client" :value="__('Nama Mitra')" />
                    <select name="kerjasama_id" id="" class="select select-bordered w-full mt-1">
                        <option selected disabled>~ Pilih Mitra ~</option>
                        @foreach ($kerjasama as $i)
                            <option name="kerjasama_id" {{ $ruanganId->kerjasama_id == $i->id ? 'selected' : '' }}  value="{{ $i->id }}" class="py-2">{{ $i->client->name }}</option>
                        @endforeach
                    </select>
                </div>

				<!-- name -->
				<div>
					<x-input-label for="nama_ruangan" :value="__('Nama Ruangan')" />
					<x-text-input id="nama_ruangan" class="block mt-1 w-full" type="text" name="nama_ruangan" value="{{ $ruanganId->nama_ruangan}}" required
						autofocus autocomplete="nama_ruangan" />
					<x-input-error :messages="$errors->get('nama_ruangan')" class="mt-2" />
				</div>

				<div class="flex gap-2 my-5 justify-end">
					<button><a href="{{ route('ruangan.index') }}" class="btn btn-error">Back</a></button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</x-main-div>
</x-app-layout>
