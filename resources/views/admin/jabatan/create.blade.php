<x-app-layout>
    <x-main-div>
    <div class="bg-slate-500 p-4 mx-36 shadow-md rounded-md">
		<p class="text-center text-2xl uppercase font-bold">Tambah Jabatan</p>
		<form method="POST" action="{{ route('jabatan.store') }}" class="mx-[25%] my-10" id="form">
			@csrf
			<div class="bg-slate-100 px-10 py-5 rounded shadow">
				<!-- divisi -->
				<div class="flex flex-col">
					<label for="divisi_id" class="label">Divisi</label>
                    <select name="divisi_id" id="divisi_id" class="select-bordered select">
                        <option selected disabled>~ Pilih divisi / Kosongkan Jika Belum Ada ~</option>
                        @forelse ($divisi as $div)
                            <option value="{{ $div->id }}">{{ $div->name }}</option>
                        @empty
                            <option disabled>~ Data Kosong ~</option>
                        @endforelse
                    </select>
				</div>
				
				<!-- jabatan -->
				<div class="flex flex-col">
					<label for="code_jabatan" class="label">Kode Jabatan</label>
                    <input type="text" name="code_jabatan" id="code_jabatan" class="input input-bordered" placeholder="masukkan kode jabatan...">
				</div>
				<!-- tipe jab -->
				<div class="flex flex-col">
					<label for="type_jabatan" class="label">Type Jabatan</label>
                    <input type="text" name="type_jabatan" id="type_jabatan" class="input input-bordered" placeholder="masukkan tipe jabatan.. (manajemen, dll)">
				</div>
				<!-- nama jab -->
				<div class="flex flex-col">
					<label for="name_jabatan" class="label">Nama Jabatan</label>
                    <input type="text" name="name_jabatan" id="name_jabatan" class="input input-bordered" placeholder="masukkan tipe jabatan.. (staff IT, dll)">
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