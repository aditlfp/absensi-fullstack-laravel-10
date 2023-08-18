<x-app-layout>
    <x-main-div>
        <div class="p-10">
			<p class="text-center font-bold text-2xl uppercase">Buat Laporan Harian</p>
            <form method="POST" action="{{ route('laporan.store') }}" class=" my-10" id="form" enctype="multipart/form-data">
            @csrf
            <div class="bg-slate-100 px-10 py-5 rounded shadow">
                {{-- client --}}
                <div class="my-5">
                    <x-input-label for="client_id" :value="__('Client')"/>
                    <x-text-input id="client_id" class=" mt-1 w-full hidden" type="text" name="client_id"  value="{{ Auth::user()->kerjasama->client->id }}" />
                    <x-text-input id="user_id" class=" mt-1 w-full hidden" type="text" name="user_id"  value="{{ Auth::user()->id }}" />
                    <x-text-input readonly class="block mt-1 w-full" disabled type="text"  value="{{ Auth::user()->kerjasama->client->name }}" />
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
                <div class="my-5">
                    <x-input-label for="sebelum" :value="__('Sebelum')"/>
                    <div class="preview hidden">
                        <img class="img1" src="" alt="" srcset="" height="120px" width="120px">
                    </div>
                    <input id="img" class="block mt-1 w-full file-input file-input-bordered shadow-none" type="file" name="image1" :value="old('image1')"
							autofocus autocomplete="img" />
					<x-input-error :messages="$errors->get('image1')" class="mt-2" />
                </div>
                {{-- proses --}}
                <div class="my-5">
                    <x-input-label for="proses" :value="__('Proses')"/>
                    <div class="preview2 hidden">
                        <img class="img2" src="" alt="" srcset="" height="120px" width="120px">
                    </div>
                    <input id="img2" class="block mt-1 w-full file-input file-input-bordered shadow-none" type="file" name="image2" :value="old('image2')"
							autofocus autocomplete="img2" />
                </div class="my-5">
                {{-- sudah --}}
                <div>
                    <x-input-label for="sesudah" :value="__('Sesudah')"/>
                    <div class="preview3 hidden">
                        <img class="img3" src="" alt="" srcset="" height="120px" width="120px">
                    </div>
                    <input id="img3" class="block mt-1 w-full file-input file-input-bordered shadow-none" type="file" name="image3" :value="old('image3')"
							autofocus autocomplete="img3" />
					<x-input-error :messages="$errors->get('image3')" class="mt-2" />
                </div>
                  {{-- keterangan --}}
                  <div class="my-5">
                    <x-input-label for="keterangan" :value="__('Keterangan')"/>
                    <input id="keterangan" type="text" name="keterangan" class="input input-bordered mt-1 w-full" />
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