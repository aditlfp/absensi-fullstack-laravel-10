@if (Auth::user()->role_id == 2)
<div class="sm:mr-10 mx-7 bg-[#0EF6CC]/70 rounded-md shadow-md mb-[12.5rem]">
	{{ $slot }}
</div>
@else
	
<div class="sm:mx-10 mx-7 bg-[#0EF6CC]/70 rounded-md shadow-md mb-[12.5rem]">
	{{ $slot }}
</div>
@endif
