<x-app-layout>
    <div>
        <div>
            <p class="text-center text-2xl font-bold py-10 uppercase">Index Perlengkapan</p>
        </div>
        <x-main-div>
        <div class="flex justify-end">
            <div class="input flex w-fit mx-10 items-center justify-end my-10 input-bordered">
                <i class="ri-search-2-line"></i>
                <input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
            </div>
        </div>
        
        <div class="overflow-x-auto mx-10 flex justify-center">
        <table class="table w-full max-w-lg" id="searchTable">
            <!-- head -->
            <thead>
            <tr>
                <th>#</th>
                <th>Nama Perlengkapan</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1
            @endphp
            @forelse ($data as $i)
                <tr>
                    <td class="py-1">{{ $no++ }}</td>
                    <td class="py-1">{{ $i->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Data Kosong</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        </div>
        <div class="flex justify-end mx-16 py-3">
            <x-nav-link class="px-3 py-1" :href="route('perlengkapan.create')" :active="true">
                {{ __('Create') }}
            </x-nav-link>
        </div>
    </x-main-div>
    </div>
</x-app-layout>