<x-app-layout>
    <form action="{{ url('devisi/'. $data->id) }}" method="POST">
    @method('PUT')
    @csrf
    <x-main-div>
    <p class="text-2xl text-center font-bold uppercase my-10">Edit Divisi</p>
    <div class="flex justify-center items-center pb-10">
        <div class="w-[25rem] px-2 py-2 p-2 bg-white max-w-md shadow-md rounded-md">
            <div id="inputContainer" class="pb-10 flex flex-col">
                <label>Nama Divisi</label>
                <input type="text" value="{{ $data->name }}" name="name" class="input input-bordered">
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ url('devisi') }}" class="btn btn-error w-fit">cancel</a>
                <button type="submit" class="btn btn-primary w-fit">Save</button>
            </div>
        </div>
    </div>
</x-main-div>
    </form>
</x-app-layout>