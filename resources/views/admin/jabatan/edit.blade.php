<x-app-layout>
    <x-main-div>
        <form action="{{ route('jabatan.update', [$jabatan->id]) }}" method="POST">
        @method('put')
        @csrf
        <div>
		<p class="text-center text-2xl font-bold my-10">Edit Jabatan</p>
        <div class="bg-slate-100 mx-10 my-10 px-10 py-5 rounded shadow">
            <!-- divisi -->
				<div class="flex flex-col">
					<label for="divisi_id" class="label">Divisi</label>
                    <select name="divisi_id" id="divisi_id" class="select-bordered select">
                        <option disabled>~ Pilih divisi ~</option>
                        @forelse ($divisi as $div)
                            <option {{ $jabatan->divisi_id == $div->id ? 'selected' : '' }} value="{{ $div->id }}">{{ $div->name }}</option>
                        @empty
                            <option disabled>~ Data Kosong ~</option>
                        @endforelse
                    </select>
				</div>
				
				<!-- jabatan -->
				<div class="flex flex-col">
					<label for="code_jabatan" class="label">Kode Jabatan</label>
                    <input type="text" name="code_jabatan" value="{{ $jabatan->code_jabatan }}" id="code_jabatan" class="input input-bordered" placeholder="masukkan kode jabatan...">
				</div>
				<!-- tipe jab -->
				<div class="flex flex-col">
					<label for="type_jabatan" class="label">Type Jabatan</label>
                    <input type="text" name="type_jabatan" value="{{ $jabatan->type_jabatan }}" id="type_jabatan" class="input input-bordered" placeholder="masukkan tipe jabatan.. (manajemen, dll)">
				</div>
				<!-- nama jab -->
				<div class="flex flex-col">
					<label for="name_jabatan" class="label">Nama Jabatan</label>
                    <input type="text" name="name_jabatan" value="{{ $jabatan->name_jabatan }}" id="name_jabatan" class="input input-bordered" placeholder="masukkan tipe jabatan.. (staff IT, dll)">
				</div>
            <div class="flex gap-2 my-5 justify-end">
                <button><a href="{{ route('jabatan.index') }}" class="btn btn-error">Back</a></button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </div>
        </form>
    </x-main-div>
</x-app-layout>