<x-app-layout>
    <x-main-div>
    <p class="text-2xl text-center font-bold uppercase my-10">Perlengkapan</p>

    <div class="flex justify-center mb-10 ">
        <form action="{{ url('divisi/'.$data->id.'/add-equipment')}}" method="POST">
        @csrf
		{{-- @method("PATCH") --}}
        <div class="w-[25rem] px-2 py-2 p-2 bg-white max-w-md shadow-md rounded-md">
            <div  id="inputContainer" class="flex flex-col pb-10">
                <label class="label pl-2">Perlengkapan</label>
				<div class="p-1 mt-4 grid gap-2">
				@foreach ($alat as $i)
				<div class="bg-orange-200 py-1 rounded">
					<input type="checkbox" name="perlengkapan_id[]" value="{{ $i->id }}" class="checkbox"/>
					<label>{{ $i->name }}</label>
				</div>
				@endforeach
				</div>
            </div>
            <div class="flex justify-between gap-2 mx-2">
                <button type="button" id="btnAdd" class="btn btn-warning w-fit">Add Input</button>
                <div>
                    <button type="submit" class="btn btn-info w-fit">Save</button>
                    <a class="btn btn-error overflow-hidden" href="{{ route('devisi.index') }}">Back</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-main-div>
</x-app-layout>