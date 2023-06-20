<nav class="m-5 sm:m-10">
	<div class="flex py-1 px-2 w-full h-auto bg-slate-500 shadow-md rounded-md justify-between">
		<div class="flex items-center justify-between gap-2">
			<div
				class="p-2 mx-2 my-2 bg-slate-300 rounded-full shadow-md shadow-slate-600 hover:shadow-none transition-all .2s ease-in-out">
				@if (Route::has('login'))
					@auth
						<img class="w-9 rounded-full" src="{{ URL::asset('/logo/log.jpg') }}" alt="profile-logo.png"
							srcset="{{ URL::asset('/logo/log.jpg') }}">
					@else
						<img class="w-7 rounded-full" src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
							srcset="{{ URL::asset('/logo/person.png') }}">
					@endauth
				@endif
			</div>

			@if (Route::has('login'))
				@auth
					<div>
						<p class="font-semibold text-white text-sm line-clamp-1 break-words">{{ Auth::user()->name }}</p>
					</div>
					<div>
						<span
							class="text-[10px] font-bold text-slate-700 absolute sm:hidden bg-green-500 px-4 rounded-tl-md right-5 top-[81px]">{{ Carbon\Carbon::now()->isoFormat('dddd, D/MMMM/Y, hh:mm') }}</span>
					</div>
				@else
					<div>

					</div>
				@endauth
			@endif
		</div>
		@if (Route::has('login'))
			@auth
				<div class="md:flex gap-3 mr-7 hidden overflow-hidden">
					<x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">
						{{ __('Dashboard') }}
					</x-nav-link>
					<x-nav-link :href="route('absensi.index')" :active="request()->routeIs('absensi.index')">
						{{ __('Absensi') }}
					</x-nav-link>

					@if (Auth::user()->role_id == 2)
						<x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
							{{ __('Admin Tool') }}
						</x-nav-link>
					@else
					@endif
					<form action="{{ route('logout') }}" method="post">
						@csrf
						@method('POST')
						<button type="submit"
							class="inline-flex overflow-hidden items-center w-auto mt-4 h-3/6 px-2 font-semibold rounded-md text-slate-700 bg-yellow-300 hover:bg-yellow-400 hover:text-white hover:shadow-none shadow-md transition all ease-in-out .2s">Logout</button>
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
