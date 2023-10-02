<x-app-layout>
	<x-main-div>
		<p class="text-center text-2xl uppercase font-bold">Tambah Divisi</p>
		<form method="POST" action="{{ route('devisi.store') }}" class="mx-[25%] my-10" id="form">
			@csrf
			<div class="bg-slate-100 px-10 py-5 rounded shadow">
				<!-- name -->
				<div>
					<x-input-label for="name" :value="__('Name')" />
					<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
						autofocus autocomplete="name" />
					<x-input-error :messages="$errors->get('name')" class="mt-2" />
				</div>
				<div>
				    <x-input-label for="jabatan_id" :value="__('Jabatan')" />
				    <select name="jabatan_id" id="" class="select select-bordered w-full mt-1">
							<option selected disabled>~ Pilih Jabatan ~</option>
							@foreach ($jabatan as $i)
								<option name="jabatan_id" value="{{ $i->id }}" class="py-2">{{ $i->name_jabatan }}</option>
							@endforeach
						</select>
				</div>

				<div class="flex gap-2 my-5 justify-end">
					<button><a href="{{ route('devisi.index') }}" class="btn btn-error">Back</a></button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</x-main-div>
</x-app-layout>
