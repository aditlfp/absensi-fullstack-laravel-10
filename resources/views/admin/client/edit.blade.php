

  <x-app-layout>
    <x-main-div>
      <p class="text-center text-2xl font-bold mt-10 uppercase"> Edit Client</p>
      <div class="bg-slate-100 mx-10 my-10 px-10 py-5 rounded shadow">
        <form action="{{ route('data-client.update', [$client->id]) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          {{-- client name --}}
				<div class="mt-2">
					<x-input-label for="name" :value="__('Nama Client')" />
					<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $client->name }}" autofocus
						autocomplete="name" />
				</div>
				<div class="flex w-full gap-2">
					{{-- alamat --}}
					<div class="mt-2 w-full">
						<x-input-label for="address" :value="__('Alamat')" />
						<x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $client->address }}" autofocus
							autocomplete="address" />
					</div>
					{{-- zipcode --}}
					<div class="mt-2 w-full">
						<x-input-label for="zipcode" :value="__('Kode pos')" />
						<x-text-input id="zipcode" class="block mt-1 w-full" type="text" name="zipcode" value="{{ $client->zipcode }}" autofocus
							autocomplete="zipcode" />
					</div>
				</div>
				<div class="flex w-full  gap-2">
					{{-- provinsi --}}
					<div class="mt-2 w-full">
						<x-input-label for="province" :value="__('Provinsi')" />
						<x-text-input id="province" class="block mt-1 w-full" type="text" name="province" value="{{ $client->province }}" autofocus
							autocomplete="province" />
					</div>
					{{-- kabupaten --}}
					<div class="mt-2 w-full">
						<x-input-label for="kabupaten" :value="__('Kabupaten')" />
						<x-text-input id="kabupaten" class="block mt-1 w-full" type="text" name="kabupaten" value="{{ $client->kabupaten }}" autofocus
							autocomplete="kabupaten" />
					</div>
				</div>

				{{-- email --}}
				<div class="mt-2">
					<x-input-label for="email" :value="__('Email')" />
					<x-text-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{ $client->email }}" autofocus
						autocomplete="email" />
				</div>
				{{-- phone --}}
				<div class="mt-2">
					<x-input-label for="phone" :value="__('No. Telepon')" />
					<x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $client->phone }}" autofocus
						autocomplete="phone" />
				</div>
				{{-- fax --}}
				<div class="mt-2">
					<x-input-label for="fax" :value="__('No. Fax')" />
					<x-text-input id="fax" class="block mt-1 w-full" type="text" name="fax" value="{{ $client->fax }}" autofocus
						autocomplete="fax" />
				</div>
        <div class=" my-10">
					<x-input-label for="Logo" :value="__('Logo')" />
          @if ($client->logo == null)
          <div class="preview">
            <img class="img1" src="{{ URL::asset('logo/no-image.jpg')}}" alt="Image Profil" srcset="" height="240px" width="240px">
          </div>
          @else
          <div class="preview">
            <img class="img2" src="{{ asset('storage/images/'.$client->logo)}}" alt="Image Profil" srcset="" height="240px" width="240px">
          </div>
          @endif
          <input type="text" class="hidden" value="{{ $client->logo}}" id="oldimage" name="oldimage">
            <input class="bg-gray-200 input input-bordered appearance-none border-2 border-gray-200 rounded mt-5 w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 shadow-md" id="img" name="logo" type="file" >
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
        </div>
        <div class="flex gap-2 my-5 justify-end">
          <button><a href="{{ route('data-client.index') }}" class="btn btn-error">Back</a></button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </x-main-div>
  </x-app-layout>