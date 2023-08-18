<x-app-layout>
    <x-main-div>
        <div class="p-10">
			<p class="text-xl font-bold uppercase text-center mb-10">Tambah Hari Libur</p>
            <form method="POST" action="{{ route('holiday.store') }}" class="bg-slate-100 rounded-md py-10 px-10 my-10 gap-2"
            id="form">
				@csrf
            <div>
				<x-input-label for="name" :value="__('Hari Libur')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus
						autocomplete="name" />
            </div>
            <div>
				<x-input-label for="tanggal_libur" :value="__('Hari Libur')" />
                <x-text-input id="tanggal_libur" class="block mt-1 w-full" type="date" name="tanggal_libur" :value="old('tanggal_libur')" autofocus
						autocomplete="tanggal_libur" />
            </div>
            {{-- button --}}
				<div class="flex justify-end my-10 gap-2">
					
					<a href="{{ route('holiday.index') }}" class="btn btn-error">
						Back
					</a>
					<button type="submit" class="btn btn-primary">+
						Hari Libur</button>
				</div>
        </form>
        </div>
    </x-main-div>
</x-app-layout>