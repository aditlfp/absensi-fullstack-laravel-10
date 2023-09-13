<x-app-layout>
    <x-main-div>
        <form action="{{ route('shift.update', [$shift->id]) }}" method="POST">
        @method('put')
        @csrf
        <div>
		<p class="text-center text-2xl font-bold my-10">Edit Shift</p>
        <div class="bg-slate-100 mx-10 my-10 px-10 py-5 rounded shadow">
            <!-- Jabatan -->
            <div class="flex flex-col">
                <label for="jabatan_id" class="label">Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="select-bordered select">
                    <option disabled>~ Pilih Jabatan ~</option>
                    @forelse ($jabatan as $jab)
                        <option {{ $shift->jabatan_id == $jab->id ? 'selected' : '' }} value="{{ $jab->id }}">{{ $jab->name_jabatan }}</option>
                    @empty
                        <option disabled>~ Data Kosong ~</option>
                    @endforelse
                </select>
            </div>
            <!-- client -->
            <div class="flex flex-col">
                <label for="client_id" class="label">client</label>
                <select name="client_id" id="client_id" class="select-bordered select">
                    <option  disabled>~ Pilih Client ~</option>
                    <option selected value="{{ $shift->client_id }}">{{ $shift->client->name }}</option>
                    @forelse ($client as $cli)
                        <option value="{{ $cli->id }}">{{ $cli->name }}</option>
                    @empty
                        <option disabled>~ Data Kosong ~</option>
                    @endforelse
                </select>
            </div>
            <!-- nama shift -->
            <div class="flex flex-col">
                <label for="shift_name" class="label">Nama Shift</label>
                <input type="text" name="shift_name" value="{{ $shift->shift_name }}" id="shift_name" class="input input-bordered" placeholder="masukkan nama shift...">
            </div>
            <!-- start -->
            <div class="flex flex-col">
                <label for="jam_start" class="label">Jam Mulai</label>
                <input type="time" name="jam_start" value="{{ $shift->jam_start }}" id="jam_start" class="input input-bordered">
            </div>
            <!-- end -->
            <div class="flex flex-col">
                <label for="jam_end" class="label">Jam Selesai</label>
                <input type="time" name="jam_end" value="{{ $shift->jam_end }}" id="jam_end" class="input input-bordered">
            </div>

            <div class="flex gap-2 my-5 justify-end">
                <button><a href="{{ route('shift.index') }}" class="btn btn-error">Back</a></button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </div>
        </form>
    </x-main-div>
</x-app-layout>