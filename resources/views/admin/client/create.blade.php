<x-app-layout>
<div class="bg-white p-4 mx-36 shadow-md rounded-md">

    <form method="POST" action="{{ route('data-client.store') }}" class="mx-[25%] my-10 gap-2" id="form" enctype="multipart/form-data">
        @csrf
        <p class="text-xl font-bold uppercase text-center mb-10">Tambah Client</p>
        {{-- client name --}}
        <div class="mt-2">
            <x-input-label for="name" :value="__('Nama Client')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                autofocus autocomplete="name" />
        </div>
        <div class="flex w-full gap-2">
            {{-- alamat --}}
            <div class="mt-2 w-full">
                <x-input-label for="address" :value="__('Alamat')"/>
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    autofocus autocomplete="address" />
            </div>
            {{-- zipcode --}}
            <div class="mt-2 w-full">
                <x-input-label for="zipcode" :value="__('Kode pos')"/>
                <x-text-input id="zipcode" class="block mt-1 w-full" type="text" name="zipcode" :value="old('zipcode')"
                    autofocus autocomplete="zipcode" />
            </div>
        </div>
        <div class="flex w-full  gap-2">
            {{-- provinsi --}}
            <div class="mt-2 w-full">
                <x-input-label for="province" :value="__('Provinsi')"/>
                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')"
                    autofocus autocomplete="province" />
            </div>
            {{-- kabupaten --}}
            <div class="mt-2 w-full">
                <x-input-label for="kabupaten" :value="__('Kabupaten')"/>
                <x-text-input id="kabupaten" class="block mt-1 w-full" type="text" name="kabupaten" :value="old('kabupaten')"
                    autofocus autocomplete="kabupaten" />
            </div>
        </div>


        {{-- email --}}
        <div class="mt-2">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"
                autofocus autocomplete="email" />
        </div>
        {{-- phone --}}
        <div class="mt-2">
            <x-input-label for="phone" :value="__('No. Telepon')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                autofocus autocomplete="phone" />
        </div>
        {{-- fax --}}
        <div class="mt-2">
            <x-input-label for="fax" :value="__('No. Fax')"/>
            <x-text-input id="fax" class="block mt-1 w-full" type="text" name="fax" :value="old('fax')"
                autofocus autocomplete="fax" />
        </div>
        {{-- logo --}}
        <div class="md:mt-4 mt-2">
            <div class="preview hidden">
                <img src="" alt="" srcset="" height="120px" width="120px">
            </div>
            <x-input-label>Logo Client</x-input-label>
            <input type="file" class="file-input file-input-bordered w-full mt-2 flex flex-row" id="img" name="logo"/>
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
        </div>
        {{-- button --}}
        <div class="flex justify-end gap-2">
            <button type="submit" class="p-2 my-2 px-4 text-white bg-blue-400 hover:bg-blue-500 rounded transition-all ease-linear .2s">Save Data</button>
            <a href="{{ route('admin.index')}}" class="p-2 my-2 px-4 text-white bg-red-400 hover:bg-red-500 rounded transition-all ease-linear .2s">
                Back
            </a>
        </div>
    </form>
</div>
</x-app-layout>
