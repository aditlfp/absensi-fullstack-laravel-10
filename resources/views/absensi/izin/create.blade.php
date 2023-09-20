<x-app-layout>
    <x-main-div>
        <div class="p-5">
			<p class="text-center text-lg sm:text-2xl uppercase font-bold my-10">Halaman izin</p>
            <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mt-4">
                <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
                <x-text-input id="nama_lengkap" class="block mt-1 w-full"
                                type="text"
                                value="{{ Auth::user()->nama_lengkap }}"
                                readonly
                                required autocomplete="nama_lengkap" />
    
                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="kerjasama_id" :value="__('Bermitra dengan')" />
                <input type="text" name="kerjasama_id" id="kerjasama_id" value="{{ Auth::user()->kerjasama_id }}" hidden>
                <x-text-input id="kerjasama_id" class="block mt-1 w-full"
                                type="text"
                                value="{{ Auth::user()->kerjasama->client->name }}"
                                readonly
                                required autocomplete="kerjasama_id" />
                <x-input-error :messages="$errors->get('kerjasama_id')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="shift_id" :value="__('Pilih shift')" />
                <select name="shift_id" id="shift_id" class="select select-bordered w-full font-thin">
                    <option  disabled selected>-- Pilih Shift --</option>
                    @forelse ($shift as $i)
                    @if(Auth::user()->kerjasama->client_id == $i->client_id )
                    @if(Auth::user()->devisi_id == $i->jabatan->divisi_id)
                        <option value="{{ $i->id }}" > {{$i->jabatan->name_jabatan}} | {{ $i->shift_name }} | {{ $i->jam_start }}</option>
                        @else
                        @endif
                    @else
                    @endif
                    @empty
                        <option>~ Tidak ad Shift ! ~</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('shift_id')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="alasan_izin" :value="__('Alasan izin')" />
                <textarea name="alasan_izin" id="alasan_izin"  rows="3" class="textarea textarea-bordered w-full" placeholder="Masukkan Alasan izin..."></textarea>
                <x-input-error :messages="$errors->get('alasan_izin')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="img" :value="__('Bukti izin')" />
                <div class="preview hidden w-full ">
                    <span class="flex justify-center items-center">
                        <label for="img" class="p-1">
                            <img class="img1 ring-2 ring-slate-500/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s"
                                src="" alt="" srcset="" height="120px" width="120px">
                            <input id="img" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
                                type="file" name="img" :value="old('image1')" autofocus autocomplete="img" />
                        </label>
                    </span>
                </div>
                    <label for="img"
                        class="w-full iImage1 flex flex-col items-center justify-center rounded-md bg-slate-50  ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-200 transition ease-in-out .2s">
                        <span class="p-3 flex justify-center flex-col items-center">
                            <i class="ri-image-add-line text-xl text-slate-700/90"></i>
                            <span class="text-xs font-semibold text-slate-700/70">+ Gambar</span>
                            <input id="img" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"
                                type="file" name="img" :value="old('image1')" autofocus autocomplete="img" />
                        </span>
                    </label>
                <x-input-error :messages="$errors->get('img')" class="mt-2" />
            </div>
            <div class="flex justify-center sm:justify-end gap-2 mt-4">
				<button class="p-2 my-2 px-4 text-white bg-amber-500 hover:bg-amber-600 rounded transition-all ease-linear .2s">Izin</button>
                <a href="{{ route('dashboard.index') }}" class="p-2 my-2 px-4 text-white bg-red-500 hover:bg-red-600 rounded transition-all ease-linear .2s">
                    Kembali
                </a>
            </div>
            </form>
        </div>
    </x-main-div>
</x-app-layout>