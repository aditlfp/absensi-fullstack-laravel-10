<x-app-layout>
    <p class="text-2xl text-center font-bold uppercase mb-10">Create Perlengkapan</p>

    <div class="flex justify-center ">
        <form action="{{ route('perlengkapan.store') }}" method="POST">
        @csrf
        <div class="w-[25rem] px-2 py-2 p-2 bg-white max-w-md shadow-md rounded-md">
            <div id="inputContainer" class="flex flex-col pb-10">
                <label class="label pl-2">Name</label>
                <input type="text" placeholder="Input Name..." class="input input-bordered my-2" id="input" name="name[]"/>
            </div>
            <div class="flex justify-between gap-2 mx-2">
                <button type="button" id="add" class="btn btn-warning w-fit">Add Input</button>
                <button type="submit" class="btn btn-info w-fit">Save</button>
            </div>
        </div>
        </form>
    </div>
</x-app-layout>