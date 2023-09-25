<x-app-layout>
    <x-main-div>
        <div class="py-10">
        <div>
            <p class="text-center text-lg sm:text-2xl font-bold py-10 uppercase">Form Check Point</p>
        </div>
        <form action="{{ route('checkpoint-user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="flex flex-col justify-center">
                @forelse ($cek as $arr)
                    @php
                        $i = 1;
                    @endphp
                    <input type="text" name="check_point_id" id="check_point_id" value="{{ $arr['id'] }}"
                        class="hidden" readonly>
                    <div class="flex flex-col gap-2 p-5 m-5 bg-slate-50 rounded">
                    @if ($arr->name != null)
                        @forelse ($arr->name as $item)
                        <label for="image{{ $i++ }}" class="font-semibold">Image
                                {{ $item}}:</label>
                                <input type="file" name="image[]" id="image{{ $i++ }}" accept="image/*" multiple required
                                    class="file-input file-input-bordered">
                                    
                  <!--                  <div class="preview hidden w-full">-->
            						<!--	<span class="flex justify-center items-center">-->
            						<!--		<label for="img" class="p-1">-->
            						<!--			<img class="img1 ring-2 ring-slate-500/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s"-->
            						<!--				src="" alt="" srcset="" height="120px" width="120px">-->
            									
            						<!--		</label>-->
            						<!--	</span>-->
            						<!--</div>-->
            						<!--<label for="img"-->
            						<!--	class="w-full iImage1 flex flex-col items-center justify-center rounded-md bg-slate-300/70  ring-2 ring-slate-400/70 hover:ring-0 hover:bg-slate-300 transition ease-in-out .2s">-->
            						<!--	<span class="p-3 flex justify-center flex-col items-center">-->
            						<!--		<i class="ri-image-add-line text-xl text-slate-700/90"></i>-->
            						<!--		<span class="text-xs font-semibold text-slate-700/70">+ Gambar</span>-->
            						<!--		<input id="img" class="hidden mt-1 w-full file-input file-input-sm file-input-bordered shadow-none"-->
            						<!--			type="file" name="image[]" :value="old('image[]')" autofocus autocomplete="img" multiple required/>-->
            						<!--	</span>-->
            						<!--</label>-->
                        @empty
                        <label for="image{{ $i++ }}" class="font-semibold">Image
                        :</label>
                            <input type="file" name="image[]" id="image{{ $i++ }}" accept="image/*" multiple required
                                class="file-input file-input-bordered">
                        @endforelse
                    @else
                            @for ($n = 1; $n <= $arr->check_count ; $n++)
                                <label for="image{{ $n }}" class="font-semibold text-white">Image {{ $n}}
                                :</label>
                                <input type="file" name="image[]" id="image{{ $n }}" accept="image/*" multiple required
                                    class="file-input file-input-bordered">
                            @endfor
                        
                    @endif
                    </div>
                    <div class="flex justify-center sm:justify-end gap-x-4 my-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('checkpoint-user.index') }}" class="btn btn-error">Kembali</a>
                    </div>
                    @break
                    @empty
                    <span class="m-5">
                        <p class="bg-slate-300 p-2 rounded-md text-center">Check Point Masih kosong</p>
                    </span>
                    <div class="flex justify-center gap-x-4 my-4">
                        <!--<button type="submit" class="btn btn-primary">Save</button>-->
                        <a href="{{ route('checkpoint-user.index') }}" class="btn btn-error">Kembali</a>
                    </div>
                @endforelse
            </div>
        </form>
        </div>
    </x-main-div>
</x-app-layout>
