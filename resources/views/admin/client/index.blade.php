<x-app-layout>
    <p class="text-center text-2xl font-bold py-10 uppercase text-white">Index Client</p>
    <x-main-div>
        <div class="flex justify-end mx-20">
            <div class="input flex items-center w-fit input-bordered my-10">
                <i class="ri-search-2-line"></i>
                <input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
            </div>
        </div>
        <div class="flex justify-center overflow-x-auto pb-10">
            <table class="table w-fit shadow-md rounded-md" id="searchTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Name Client</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kode Pos</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>No. Fax</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                @php
                    $no = 1
                @endphp
                @forelse ($client as $i)
                    <tr>
                        <td>{{ $no++ }}</td>
                        @if ($i->logo == 'no-image.jpg')
                            <td><img src="{{ URL::asset('logo/no-image.jpg')}}" alt="no-image" srcset="{{ URL::asset('logo/no-image.jpg')}}" width="120px"></td>
                        @else
                            <td><img src="{{ asset('storage/images/'.$i->logo) }}" alt="..." class="w-10"></td>
                        @endif
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->address }}</td>
                        <td>{{ $i->province }}</td>
                        <td>{{ $i->kabupaten }}</td>
                        <td>{{ $i->zipcode }}</td>
                        <td>{{ $i->email }}</td>
                        <td>{{ $i->phone }}</td>
                        <td>{{ $i->fax }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">~ Data Kosong ~</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $client->links()}}
            </div>
        </div>
        <div class="flex justify-end mx-16 py-3">
            <x-nav-link class="px-3 py-1" :href="route('data-client.create')" :active="true">
                {{ __('Create') }}
            </x-nav-link>
        </div>
    </x-main-div>
</x-app-layout>
