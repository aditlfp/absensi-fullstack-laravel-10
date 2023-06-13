<div class="md:w-2/3">
    @if ($client->logo == null)
    <div class="preview">
      <img src="{{ URL::asset('logo/no-image.jpg')}}" alt="Image Profil" srcset="" height="120px" width="120px">
    </div>
    @else
    <div class="preview">
      <img src="{{ asset('storage/images/'.$client->logo)}}" alt="Image Profil" srcset="" height="120px" width="120px">
    </div>
    @endif
    <input type="text" class="hidden" value="{{ $client->logo}}" id="oldimage" name="oldimage">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 shadow-md" id="img" name="img" type="file">
      <x-input-error class="mt-2" :messages="$errors->get('img')" />
  </div>