<x-app-layout>
<div>
    <div>
      <p class="text-center text-2xl font-bold py-10 uppercase">Index Kerjasama</p>
    </div>
    <x-main-div>
      <div class="flex justify-end mx-10 my-10">
        <div class="input flex items-center input-bordered w-fit">
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
        <th>ID CLIENT</th>
        <th>VALUE</th>
        <th>EXPERIED</th>
        <th>APPROVED 1</th>
      </tr>
    </thead>
    <tbody>
    @php
        $no = 1
    @endphp
      @forelse ($kerjasama as $i)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $i->client_id }}</td>
            <td>{{ $i->value }}</td>
            <td>{{ $i->experied }}</td>
            <td>{{ $i->approve1 }}</td>
          </tr> 
      @empty
          <tr>
            <td colspan="5" class="text-center ">~ Data kosong ~</td>
          </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="flex justify-end mx-16 py-3">
    <x-nav-link class="px-3 py-1" :href="route('kerjasamas.create')" :active="true">
        {{ __('Create') }}
    </x-nav-link>
</div>
</x-main-div>

</x-app-layout>