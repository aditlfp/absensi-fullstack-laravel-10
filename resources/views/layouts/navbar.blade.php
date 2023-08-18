
    <nav class="mx-5 sm:mx-5 mb-5 sm:mb-5 pt-5">
	<div class="flex pt-1 pl-2 w-full h-auto bg-slate-500 shadow-md rounded-md justify-between">
		   <a href="{{ route('profile.index')}}">
		<div class="flex items-center justify-between gap-2">
			<div
				class="p-2 mx-2 my-2 overflow-hidden flex items-center bg-slate-300 rounded-full shadow-md shadow-slate-600 hover:shadow-none transition-all .2s w-10 h-10 ease-in-out">
				@if (Auth::user()->image == 'no-image.jpg')
					<img class=" rounded-full" src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
						srcset="{{ URL::asset('/logo/person.png') }}">	
				@else
					<img class=" rounded-full" src="{{ asset('storage/images/'.  Auth::user()->image) }}" alt="profile-logo2.png" srcset="{{ asset('storage/images/'.  Auth::user()->image) }}">
				@endif
			</div>

			@if (Route::has('login'))
				@auth
					<div class="flex justify-between flex-col gap-1">
						<p class="font-semibold text-white text-sm line-clamp-1 break-words">{{ Auth::user()->name }}</p>
					</div>
				@else
					<div>
					</div>
				@endauth
			@endif
		</div>
            </a>
		
		@if (Route::has('login'))
			@auth
				<div class="md:flex gap-3 mr-7 hidden overflow-hidden">
					<x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
						{{ __('Dashboard') }}
					</x-nav-link>
					<x-nav-link :href="route('absensi.index')" :active="request()->routeIs('absensi.index')">
						{{ __('Absensi') }}
					</x-nav-link>
					<x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')">
						{{ __('Laporan') }}
					</x-nav-link>

                @if(Auth::user()->divisi->jabatan->code_jabatan == "SPV-A")
					@if (Auth::user()->role_id == 2)
						<x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="hidden">
							{{ __('Admin Tool') }}
						</x-nav-link>
					@else
					@endif
				@else
					@if (Auth::user()->role_id == 2)
						<x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
							{{ __('Admin Tool') }}
						</x-nav-link>
					@else
					@endif
				@endif
					<form action="{{ route('logout') }}" method="post">
						@csrf
						@method('POST')
						<button type="submit"
							class="inline-flex overflow-hidden items-center w-auto mt-4 h-3/6 px-2 font-semibold rounded-md text-slate-700 bg-yellow-300 hover:bg-yellow-400 hover:text-white hover:shadow-none shadow-md transition all ease-in-out .2s" active>Logout</button>
					</form>
				@else
					<x-nav-link class="mr-5 px-5 py-1" :href="route('login')" :active="true">
						{{ __('Login') }}
					</x-nav-link>

				</div>
			@endauth
		@endif
		
	</div>

	</div>

</nav>
