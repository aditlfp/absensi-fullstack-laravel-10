<x-app-layout>
    <x-main-div>
        <form action="{{ route('checkpoint-user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="flex flex-col justify-center">
                @foreach ($cek as $arr)
                    @php
                        $dataCount = $arr['check_count'];
                    @endphp
                    <input type="text" name="check_point_id" id="check_point_id" value="{{ $arr['id'] }}"
                        class="hidden" readonly>
                    <div class="flex flex-col w-2/6">
                        @for ($i = 1; $i <= $dataCount; $i++)
                            <label for="image{{ $i }}" class="font-semibold text-white">Image
                                {{ $i }}:</label>
                            <input type="file" name="image[]" id="image{{ $i }}" accept="image/*" multiple required
                                class="file-input file-input-bordered">
                        @endfor
                    </div>
                @endforeach

                <div class="flex justify-end gap-x-4 mr-20">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-error">BACK</a>
                </div>
            </div>
        </form>
    </x-main-div>
</x-app-layout>
