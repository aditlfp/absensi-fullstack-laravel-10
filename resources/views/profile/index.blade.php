<x-app-layout>
    <x-main-div>
        <div>
            <p class="text-center text-2xl font-bold pt-5 uppercase">Index Client</p>
            <div class="bg-slate-100 mx-5 my-5 rounded-md shadow">
            <div>
                <div class="flex items-center py-10 justify-center">
                <div class="p-2 mx-2 my-2 flex items-center justify-center bg-slate-200 rounded-full shadow-md  hover:shadow-none transition-all .2s w-24 h-24 ease-in-out">
                    @if (Auth::user()->image == 'no-image.jpg')
					<img class="w-20 rounded-full " src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
						srcset="{{ URL::asset('/logo/person.png') }}">	
				    @else
					    <img class="w-16 rounded-full" src="{{ asset('storage/images/'.  Auth::user()->image) }}" alt="profile-logo2.png" srcset="{{ asset('storage/images/'.  Auth::user()->image) }}">
				    @endif
                </div>
            </div>
            <div class="bg-slate-300 mx-4 my-4 rounded-md p-2 font-semibold text-sm">
                <div class="text-slate-800 space-y-2">
                <p>User Name: {{ Auth::user()->name }}</p>
                <p>Nama Lengkap: {{ Auth::user()->nama_lengkap }}</p>
                <p>Email: {{ Auth::user()->email }}</p>
                @if (Auth::user()->devisi == null)
                <p>Devisi: Kosong</p>
                @else
                <p>Devisi: {{ Auth::user()->devisi->name }}</p>
                @endif
                @if (Auth::user()->kerjasama == null)
                <p>Bermitra: Kosong</p>
                @else
                <p>Bermitra: {{ Auth::user()->kerjasama->client->name }}</p>
                @endif
            </div>
        </div>
        <div class="p-2 flex justify-center">
            <a href="/dashboard" class="btn btn-error">Back</a>
        </div>
            </div>
        </div>
        </div>
    </x-main-div>
</x-app-layout>