<x-app-layout>
    <div class="bg-slate-500 mx-10 rounded">
        <div>
            <p class="text-center text-2xl font-bold py-10 uppercase">Index Devisi</p>
        </div>
        <div class="flex justify-end">
            <div class="input flex w-fit mx-10 items-center justify-end mb-5 input-bordered">
                <i class="ri-search-2-line"></i>
                <input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
            </div>
        </div>
        
        <div class="overflow-x-auto mx-10">
        <table class="table w-full" id="searchTable">
            <!-- head -->
            <thead>
            <tr>
                <th>#</th>
                <th>Nama Devisi</th>
                <th>Perlengkapan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1
            @endphp
            @forelse ($data as $i)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $i->name }}</td>
                    <td>
                        @forelse ($i->perlengkapan as $value )
                            <span class="capitalize">{{ $value->name }},</span>
                        @empty
                            <a href="{{ url('/divisi/'. $i->id .'/add-equipment') }}" class="text-2xl text-yellow-500 hover:text-yellow-600 transition-all ease-in-out .2s"><i class="ri-add-circle-fill"></i></a>
                        @endforelse
                    </td>
                    <td>
                        <form action="{{ url('devisi/'.$i->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <x-btn-submit></x-btn-submit>
                            <x-btn-edit>{{ url('devisi/'. $i->id.'/edit') }}</x-btn-edit>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data Kosong</td>
                </tr>
            @endforelse
            </tbody>
        </table>
       
        <div class="flex justify-end my-3 gap-2">
            <a href="{{ route('devisi.create') }}" class="btn btn-warning hover:bg-yellow-600 border-none transition-all ease-in-out .2s">Create</a>
            <a href="{{ route('admin.index') }}" class="btn btn-error border-none hover:bg-red-500 transition-all ease-in-out .2s">Back</a>
        </div>

    </div>

</x-app-layout>