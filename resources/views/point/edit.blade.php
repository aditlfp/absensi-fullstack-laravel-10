<x-app-layout>
    <x-main-div>
        <form action="{{ route('point.update', [$point->id]) }}" method="POST">
        @method('put')
        @csrf
        <div>
            <p class="text-center text-2xl font-bold my-10">Edit Point, {{$point->client->name}}</p>
            <div class="bg-slate-100 mx-10 my-10 px-10 py-5 rounded shadow">
                <!--Client-->
                <div class="flex flex-col">
                    <x-input-label for="client_id" :value="__('Client')" />
                    <select name="client_id" id="" class="select select-bordered w-full mt-1">
    					<option disabled>~ Pilih Client ~</option>
    					@foreach ($client as $i)
    						<option name="client_id" {{ $point->client_id == $i->id ? 'selected' : '' }}  value="{{ $i->id }}" class="py-2">{{ $i->name }}</option>
    					@endforeach
    				</select>
    				<x-input-error :messages="$errors->get('client_id')" class="mt-2" />
				</div>
				{{-- sac point --}}
                <div class="my-5">
                    <x-input-label for="sac_point" :value="__('Jumlah Point')" />
                    <input type="text" name="sac_point" value="{{$point->sac_point}}" id="sac_point" class="input input-bordered w-full" placeholder="masukkan jumlah point...">
					<x-input-error :messages="$errors->get('sac_point')" class="mt-2" />
                </div>
                <div class="flex gap-2 my-5 justify-end">
                    <button><a href="{{ route('point.index') }}" class="btn btn-error">Back</a></button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
        </form>
    </x-main-div>
</x-app-layout>