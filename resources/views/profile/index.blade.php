<x-app-layout>
    <x-main-div>
        <div>
            <p class="text-center text-2xl font-bold pt-5 uppercase">Profile</p>
            <div class="bg-slate-100 mx-5 my-5 rounded-md shadow">
            <div>
                <div class="flex items-center py-10 justify-center">
                <div class="p-5 mx-2 my-2 overflow-hidden flex items-center justify-center bg-slate-200 rounded-full shadow-md  hover:shadow-none transition-all .2s w-24 h-24 ease-in-out">
                    @if (Auth::user()->image == 'no-image.jpg')
					<img class="w-20 rounded-full " src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
						srcset="{{ URL::asset('/logo/person.png') }}">	
				    @else
					    <img class="m-2 w-32 rounded-full" src="{{ asset('storage/images/'.  Auth::user()->image) }}" alt="profile-logo2.png" srcset="{{ asset('storage/images/'.  Auth::user()->image) }}">
				    @endif
                </div>
            </div>
            <div class="bg-slate-300 mx-4 my-4 rounded-md p-2 py-5 font-semibold text-sm">
                <div class="text-slate-800 space-y-2">
                <table>
                   <thead class="uppercase" style="font-size: 13px;">
                      <tr>
                        <td>UserName</td> 
                        <td>:{{ Auth::user()->name }}</td>
                      </tr>
                      <tr>
                        <td>
                            Nama Lengkap
                        </td>
                        <td class="break-words whitespace-pre-wrap">:{{ Auth::user()->nama_lengkap }}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td class="break-words whitespace-pre-line">:{{ Auth::user()->email }}</td>
                      </tr>
                      <tr>
                          <td>Divisi</td>
                           @if (Auth::user()->divisi->jabatan == null)
                          <td>:Kosong</td>
                          @else
                          <td>:{{ Auth::user()->divisi->jabatan->name_jabatan }}</td>
                          @endif
                      </tr>
                      <tr>
                        <td>Bermitra</td>
                        @if(Auth::user()->kerjasama == null)
                        <td>:Kosong</td>
                        @else
                        <td>:{{ Auth::user()->kerjasama->client->name }}</td>
                        @endif
                      </tr>
                    </thead> 
                </table>
            </div>
        </div>
            </div>
        </div>
        </div>
    </x-main-div>
</x-app-layout>