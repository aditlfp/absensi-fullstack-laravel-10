<div class="block md:hidden">
    <ul class="menu menu-horizontal px-5 flex flex-col items-center bg-slate-200 mb-1 rounded-box">
      <div class="flex text-[10px]">
        <li>  
          <a href="{{ route('profile.index') }}">
            <i class="ri-account-circle-line text-xl text-blue-500"></i>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.index')}}">
            <i class="ri-home-2-line  text-xl"></i>

          </a>
        </li>
        <form action="{{ route('logout')}}" method="post">
        <li>
            @csrf
            @method('POST')
            <button type="submit">
              <i class="ri-shut-down-line text-xl text-red-500"></i>
              
            </button>
        </li>
        </form>
        <li>
          <a href="{{ route('absensi.index')}}" class="flex items-center justify-center flex-col">
            <i class="ri-file-edit-fill text-xl text-green-500"></i>

          </a>
        </li>
      </div>
      
      </ul>
</div>