<x-app-layout>
    <x-main-div>
    <div class="m-10 p-10">
        <div class="flex flex-col justify-center w-full">
            <p class="text-center text-lg sm:text-2xl font-bold uppercase">Tambah Check Point</p>
            @if(session('msg'))
                <div class="mx-auto bg-green-500 w-3/6 p-2 text-center rounded-md shadow-md text-white font-semibold mt-5">
                        {{ session('msg') . '!!!' }}
                    </div>
            @endif
        </div>
            <form action="{{ route('admin.cp.store')}}" method="post" class=" my-10 flex items-center justify-center">
                <div class="bg-slate-100 px-10 py-5 rounded shadow items-center justify-center">
                    @csrf
                    <div class="flex flex-col w-full mb-3">
                        <label for="user_id" class="font-semibold text-white">Pilih User/Karyawan</label>
                        <select name="user_id" id="user_id" class="select select-bordered">
                            <option readonly disabled>~ Pilih User ~</option>
                            @forelse ($user as $arr)
                                <option value="{{ $arr->id}}" data-client_id="{{ $arr->kerjasama->client_id}}">{{ $arr->nama_lengkap}}</option>
                            @empty
                                <option disabled>~ User Kosong ~</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>
    
                    <div class="flex flex-col  w-full mb-3">
                        <label for="client_id" class="font-semibold text-white">Pilih Client</label>
                            <select  id="client_id" class="select select-bordered cursor-not-allowed" disabled>
                                <option readonly disabled>~ Pilih Client ~</option>
                                @forelse ($client as $arr)
                                    <option value="{{ $arr->id}}" readonly>{{ $arr->name}}</option>
                                @empty
                                    <option disabled>~ User Kosong ~</option>
                                @endforelse
                            </select>
                        <div class="hidden">
                            <select name="client_id" id="client_id" class="select select-bordered cursor-not-allowed">
                                <option readonly disabled>~ Pilih Client ~</option>
                                @forelse ($client as $arr)
                                    <option value="{{ $arr->id}}" readonly>{{ $arr->name}}</option>
                                @empty
                                    <option disabled>~ User Kosong ~</option>
                                @endforelse
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>
    
                    <div class="flex flex-col  w-full mb-3">
                        <label for="check_count" class="font-semibold text-white">Masukkan Jumlah CheckPoint</label>
                        <input type="text" name="check_count" id="check_count" placeholder="10" class="input input-bordered">
                        <x-input-error :messages="$errors->get('check-count')" class="mt-2" />
                    </div>
                    <div class="flex flex-col  w-full mb-3">
                       <div id="nameInputs" class="flex flex-col  w-full mb-3"></div>
                    </div>
                    <div class="flex gap-2 justify-center sm:justify-end">
                        <a href="{{ route('admin.cp.index') }}" class="btn btn-error">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
    </div>
    </x-main-div>

    <script>
        $(document).ready(function () {
            $("#user_id").change(function () {
                var selectedOption = $(this).find(":selected"); 
                var selectedClientId = selectedOption.data("client_id"); 
                $("#client_id").val(selectedClientId);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var checkCountInput = $("#check_count");
    
            var nameInputsDiv = $("#nameInputs");
    
            checkCountInput.on("input", function () {
                var checkCount = parseInt(checkCountInput.val());
    
                nameInputsDiv.empty();
    
                for (var i = 1; i <= checkCount; i++) {
                    var nameLabel = $("<label>")
                        .attr("for", "name[]")
                        .text("Name " + i + " ( Opsional ):");
                    
                    var nameInput = $("<input>")
                        .attr("type", "text")
                        .attr("name", "name[]")
                        .attr("id", "name" + i)
                        .addClass("input input-bordered")
                        .attr("placeholder", "Name....");
    
                    nameInputsDiv.append(nameLabel);
                    nameInputsDiv.append(nameInput);
                }
            });
        });
    </script>
    
</x-app-layout>