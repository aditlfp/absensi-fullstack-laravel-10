<x-app-layout>
    <form action="{{ url('devisi/'. $data->id) }}" method="POST">
    @method('PUT')
    @csrf
    <p class="text-2xl text-center font-bold uppercase mb-10 text-white">Edit Divisi</p>
    <div class="flex justify-center">
        <div class="w-[25rem] px-2 py-2 p-2 bg-white max-w-md shadow-md rounded-md">
            <div id="inputContainer" class="pb-10 flex flex-col">
                <label>Nama Divisi</label>
                <input type="text" value="{{ $data->name }}" name="name" class="input input-bordered">
            </div>
            <button type="submit" class="btn btn-info w-fit">Save</button>
            <a href="{{ url('devisi') }}" class="btn btn-error w-fit">cancel</a>
        </div>
    </div>
    </form>
</x-app-layout>