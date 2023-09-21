<x-app-layout>
    <x-main-div>
        <p class="text-center text-lg sm:text-2xl font-bold uppercase pt-10">Kesimpulan Rating</p>
        <div class="flex justify-center flex-col items-center ">
            <div class=" py-10 font-semibold w-fit bg-slate-100 mx-10 my-10 rounded-md p-3 px-10 shadow-md">
                <p class="pb-5">Rating User,  {{ $rating->user->name }}</p>
                <p>Nama Lengkap: {{ $rating->user->nama_lengkap }}</p>
                <p>Rating User: {{ $rating->rate }}</p>
                <div class="pt-5 flex justify-end">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-error">Kembali</a>
                </div>
            </div>
        </div>
    </x-main-div>
</x-app-layout>