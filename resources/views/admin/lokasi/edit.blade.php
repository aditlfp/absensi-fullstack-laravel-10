<x-app-layout>
    <x-main-div>
        <form action="{{ route('lokasi.update', [$lokasiId->id]) }}" method="POST">
        @method('put')
        @csrf
        <div>
            <p class="text-center text-2xl font-bold my-10">Edit Lokasi, {{$lokasiId->client->name}}</p>
            <div class="bg-slate-100 mx-10 my-10 px-10 py-5 rounded shadow">
                <!--Client-->
                <div class="flex flex-col">
                    <x-input-label for="client_id" :value="__('Client')" />
                    <select name="client_id" id="" class="select select-bordered w-full mt-1">
    					<option disabled>~ Pilih Client ~</option>
    					@foreach ($client as $i)
    						<option name="client_id" {{ $lokasiId->client_id == $i->id ? 'selected' : '' }}  value="{{ $i->id }}" class="py-2">{{ $i->name }}</option>
    					@endforeach
    				</select>
    				<x-input-error :messages="$errors->get('client_id')" class="mt-2" />
				</div>
				<!--lat-->
				<div class="flex flex-col">
                    <x-input-label for="latitude" :value="__('Latitude')" />
                    <input name="latitude" class="block mt-1 w-full input" id="latitude" value="{{$lokasiId->latitude}}" placeholder="Input Latitude..."/>
                </div>
                <!--long-->
                <div class="flex flex-col">
                    <x-input-label for="longitude" :value="__('Longitude')" />
                    <input name="longtitude" class="block mt-1 w-full input" id="longtitude" value="{{$lokasiId->longtitude}}" placeholder="Input Longitude..."/>
                </div>
                {{-- rad --}}
                <div class="flex flex-col">
                    <x-input-label for="radius" :value="__('Radius (meter)')" />
                    <input  class="disabled block mt-1 w-full input input-bordered" value="{{$lokasiId->radius}}" placeholder="input radius satuan 'M', min 50..." id="radius" name="radius" type="number"/>
                </div>
                <div class="flex gap-2 my-5 justify-end">
                    <button><a href="{{ route('lokasi.index') }}" class="btn btn-error">Back</a></button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
        </form>
    </x-main-div>
</x-app-layout>