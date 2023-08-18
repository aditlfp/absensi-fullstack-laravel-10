<x-app-layout>
    <x-main-div>
        <div class="p-10">
            <p class="text-center font-bold text-2xl uppercase">Buat Laporan Harian</p>
            <form method="POST" action="{{ route('point.store') }}" class=" my-10">
            @csrf
            <div class="bg-slate-100 px-10 py-5 rounded shadow">
                {{-- client --}}
                <div class="my-5">
                    <x-input-label for="client" :value="__('Nama Client')" />
                    <select name="client_id" id="client_id" class="select select-bordered w-full mt-1">
                        <option selected disabled>~ Pilih Client ~</option>
                        @foreach ($client as $i)
                            <option name="client_id" value="{{ $i->id }}" class="py-2">{{ $i->name }}</option>
                        @endforeach
                    </select>
					<x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                </div>
                {{-- sac point --}}
                <div class="my-5">
                    <x-input-label for="sac_point" :value="__('Jumlah Point')" />
                    <input type="text" name="sac_point" id="sac_point" class="input input-bordered w-full" placeholder="masukkan jumlah point...">
					<x-input-error :messages="$errors->get('sac_point')" class="mt-2" />
                </div>
                <div class="my-5 flex justify-end gap-2">
                    <a href="{{ route('point.index') }}" class="btn btn-error hover:bg-red-500 transition-all ease-linear .2s">
                        Back
                    </a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

            </form>
        </div>
    </x-main-div>
</x-app-layout>