<x-app-layout>
    <x-main-div>
    <div class="bg-slate-500 p-4 mx-36 shadow-md rounded-md">
		<p class="text-center text-2xl uppercase font-bold">Tambah Shift</p>
		<form method="POST" action="{{ route('shift.store') }}" class="mx-[25%] my-10" id="form">
			@csrf
			<div class="bg-slate-100 px-10 py-5 rounded shadow">
				<!-- Jabatan -->
				<div class="flex flex-col">
					<label for="jabatan_id" class="label">Jabatan</label>
                    <select name="jabatan_id" id="jabatan_id" class="select-bordered select">
                        <option selected disabled>~ Pilih Jabatan ~</option>
                        @forelse ($jabatan as $jab)
                            <option value="{{ $jab->id }}">{{ $jab->name_jabatan }}</option>
                        @empty
                            <option disabled>~ Data Kosong ~</option>
                        @endforelse
                    </select>
				</div>
				<!-- client -->
				<div class="flex flex-col">
					<label for="client_id" class="label">client</label>
                    <select name="client_id" id="client_id" class="select-bordered select">
                        <option selected disabled>~ Pilih Client ~</option>
                        @forelse ($client as $cli)
                            <option value="{{ $cli->id }}">{{ $cli->name }}</option>
                        @empty
                            <option disabled>~ Data Kosong ~</option>
                        @endforelse
                    </select>
				</div>
				<!-- client -->
				<div class="flex flex-col">
					<label for="shift_name" class="label">Nama Shift</label>
                    <input type="text" name="shift_name" id="shift_name" class="input input-bordered" placeholder="masukkan nama shift...">
				</div>
				<!-- start -->
				<div class="flex flex-col">
					<label for="jam_start" class="label">Jam Mulai</label>
                    <input type="time" name="jam_start" id="jam_start" class="input input-bordered">
				</div>
				<!-- end -->
				<div class="flex flex-col">
					<label for="jam_end" class="label">Jam Selesai</label>
                    <input type="time" name="jam_end" id="jam_end" class="input input-bordered">
				</div>

				<div class="flex gap-2 my-5 justify-end">
					<button><a href="{{ route('shift.index') }}" class="btn btn-error">Back</a></button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</x-main-div>
</x-app-layout>