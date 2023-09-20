<div class="block md:hidden">
	<ul class="menu menu-horizontal px-3 flex flex-col items-center bg-slate-200 mb-1 rounded-box">
		<div class="flex text-[10px]">
			<li class="overflow-hidden">
				<a href="{{ route('profile.index') }}" class="flex flex-col gap-0 -my-2 " style="margin-top: -0.5rem; margin-bottom: -0.5rem">
					<i class="ri-account-circle-line text-xl text-blue-500 ">
					</i>
					<span class="font-semibold text-slate-700 ">Profile</span>

				</a>
			</li>
			<li class="overflow-hidden">
				<a href="{{ route('dashboard.index') }}" class="flex flex-col gap-0" style="margin-top: -0.5rem; margin-bottom: -0.5rem">
					<i class="ri-home-2-line  text-xl"></i>
					<span class="font-semibold text-slate-700">Home</span>
				</a>
			</li>
			<form action="{{ route('logout') }}" method="post">
				<li class="overflow-hidden">
					@csrf
					@method('POST')
					<button type="submit" class="flex flex-col gap-0" style="margin-top: -0.5rem; margin-bottom: -0.5rem">
						<i class="ri-shut-down-line text-xl text-red-500"></i>
						<span class="font-semibold text-slate-700">Log out</span>
					</button>
				</li>
			</form>
			@if(Route::has('login'))
			@auth
    			@if (Auth::user()->divisi->jabatan->code_jabatan != 'MITRA' && Auth::user()->divisi->jabatan->code_jabatan != 'LEADER')
    				<li class="overflow-hidden">
    					<a id="aAbsen2" href="{{ route('absensi.index') }}" class="flex flex-col gap-0" style="margin-top: -0.5rem; margin-bottom: -0.5rem">
    						<i class="ri-file-edit-fill text-xl text-green-500"></i>
    						<span class="font-semibold text-slate-700">Kehadiran</span>
    					</a>
    				</li>
    			@endif
    		@endauth
    		@endif
		</div>
	</ul>
</div>
