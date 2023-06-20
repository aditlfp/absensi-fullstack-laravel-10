<x-app-layout>
	<div class="bg-slate-500 p-4 mx-36 shadow-md rounded-md">
		<p class="text-center text-2xl font-bold">Tambah Divisi</p>
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

				<div class="flex gap-2 my-5 justify-end">
					<button><a href="{{ route('devisi.index') }}" class="btn btn-error">Back</a></button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</x-app-layout>
