<x-app-layout>
    <x-main-div>
        <span>
            @foreach ($cek as $arr)
                @foreach ($arr->image as $item)
                    @foreach ($item->image as $i)
                        <img src="{{ asset('storage/images/' . $i)}}" alt="" srcset="">
                    @endforeach
                @endforeach
            @endforeach
        </span>
    </x-main-div>
</x-app-layout>