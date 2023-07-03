<x-app-layout>
    <div class="flex justify-center bg-slate-500 p-3 rounded mx-10">
    <div class="flex flex-col gap gap-4 w-3/6 justify-center">
        @foreach ($user as $s)
            <button onclick="openModal({{ $s->id }})" data-id="{{ $s->id }}" class="btt btn btn-info hover:bg-sky-500 hover:border-0">{{ $s->nama_lengkap}}</button>
            <div class="hidden justify-center  transform transition-all ease-in-out duration-300 h-auto" id="modal-{{  $s->id }}">
            <div class="flex items-center justify-center mx-2 sm:mx-0 w-full h-full min-h-full">
                <div class="bg-white rounded shadow-lg p-3 transform transition-all ease-in-out duration-300 ">
                    <div class=" rounded-tr-md rounded-tl-md broder-b-slate-700">
                        <h2 class="text-xl text-center font-bold mb-4 ">Hasil Absensi {{ $s->name }}</h2>
                    </div>
                   <table class="table table-zebra">
                    <thead>
                      <tr>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Tanggal Absen</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($absen as $arr)
                      @if ($arr->user_id == $s->id)
                        <tr>
                          <td>{{ $arr->absensi_type_masuk}}</td>
                          <td>{{ $arr->absensi_type_pulang}}</td>
                          <td>{{ $arr->tanggal_absen }}</td>
                          <td>{{ $arr->keterangan }}</td>
                        </tr>
                      @else
                         
                      @endif
                      @empty
                        <tr>
                          <td colspan="4">Kosong</td>
                        </tr>
                      @endforelse
                    </tbody>
                   </table>
                   <div class="mt-5">
                    {{ $absen->links() }}
                  </div>
                   <form action="{{ route('rating.store') }}" method="POST">
                    @csrf
                    <div class="rating flex justify-center bg-slate-100 p-2 rounded">
                      <input type="text" name="user_id" class="hidden" value="{{ $s->id }}">
                      <input type="radio" name="rate" value="1" class="mask mask-star-2 bg-orange-400 text-orange-400" checked/>
                      <input type="radio" name="rate" value="2" class="mask mask-star-2 bg-orange-400 text-orange-400" />
                      <input type="radio" name="rate" value="3" class="mask mask-star-2 bg-orange-400 text-orange-400" />
                      <input type="radio" name="rate" value="4" class="mask mask-star-2 bg-orange-400 text-orange-400" />
                      <input type="radio" name="rate" value="5" class="mask mask-star-2 bg-orange-400 text-orange-400" />
                    </div>
                    <x-btn-input type="submit">Rate</x-btn-input>
                  </form>
                    <div class="flex justify-end">
                      <button id="closeBtn-{{ $s->id }}" onclick="closeModal({{ $s->id }})" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Tutup</button>
                    </div>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
    <script>

      
        function openModal(id) {
        const modal = document.getElementById('modal-'+id);
        const closeBtn = document.getElementById('closeBtn-' + id);

          modal.classList.add('absolute', 'bg-slate-900/10', 'inset-0');
          modal.classList.remove('hidden');
        }
      
        function closeModal(id) {
        const modal = document.getElementById('modal-'+id);
        const closeBtn = document.getElementById('closeBtn-' + id);

        
          modal.classList.add('hidden');
          modal.classList.remove('fixed');
        }

        
      </script>
</x-app-layout>