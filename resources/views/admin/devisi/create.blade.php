<x-app-layout>
	<div class="bg-white p-4 mx-36 shadow-md rounded-md">
		<p class="text-center text-2xl font-bold">Tambah Divisi</p>
		<form method="POST" action="{{ route('devisi.store') }}" class="mx-[25%] my-10" id="form">
			@csrf
			<!-- name -->
			<div>
				<x-input-label for="name" :value="__('Name')" />
				<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
					autofocus autocomplete="name" />
				<x-input-error :messages="$errors->get('name')" class="mt-2" />
			</div>

            <div class="flex justify-end">
                <x-btn-input type="submit">save</x-btn-input>
            </div>
		</form>
	</div>
</x-app-layout>