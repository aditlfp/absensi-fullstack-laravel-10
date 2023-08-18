<x-app-layout>
   <x-main-div>
       <p class="text-center text-lg sm:text-2xl font-bold uppercase pt-10">Rating Saya</p>
       <div class="flex justify-center flex-col items-center ">
           <div class=" py-10 font-semibold w-fit bg-slate-100 mx-10 my-10 rounded-md p-3 px-10 shadow-md">
               <h2 class="underline text-red-600 text-xs text-center sm:text-xl mb-8">Kamu Belum Mempunyai Rating !</h2>
               <div class="pt-2 flex justify-center">
                   <a href="{{ url('dashboard') }}" class="px-10 btn btn-error">Back</a>
               </div>
           </div>
       </div>
   </x-main-div>
</x-app-layout>