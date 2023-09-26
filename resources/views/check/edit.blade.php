<x-app-layout>
    <x-main-div>
        <form action="{{ route("checkpoint-user.update", $user)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
            @foreach ($foto as $i)
                @php
                    $existingImages = $i->image;
                    $checkCount = $i->CheckPoint->check_count; // check_count = 3
                @endphp
    
                @foreach ($existingImages as $item => $index)
                    <label for="image{{ $item }}">
                        <img src="{{ asset('storage/images/' . $index) }}" width="20%" alt="" srcset="">
                    </label>
                    <input type="file" name="image[]" id="image{{ $item }}" data-textval="{{ $index }}" class="hidden" accept="image/*" multiple>
                    <span hidden id="dataOld" data-abc="#image{{ $item}}" data-def="#oldImage{{ $item}}"></span>
                    <input hidden type="text" id="oldImage{{ $item}}" name="oldImage[]" value="" class="old-image" accept="image/*" multiple data-index="{{ $item }}">
                @endforeach
                
                @for ($j = count($existingImages); $j < $checkCount; $j++)
                    <label for="image{{ $j }}">
                        <!-- Tampilkan input file kosong -->
                        <input type="file" name="image[]" id="image{{ $j }}" class="file-input file-input-bordered" accept="image/*" multiple>
                    </label>
                @endfor
            @endforeach
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
</x-main-div>
<script>
    $(document).ready(function() {
        var data = $('#dataOld').attr('data-abc'); // image
        var datas = $('#dataOld').attr('data-def'); //oldImage
        // Memantau perubahan pada input gambar
        $(data).change(function() {
            if (this.files.length > 0) {
                // Jika ada gambar yang dipilih, isi nilai oldImage dengan gambar yang ada
                //  datas.val('data')
                var oled = $(data).attr('data-textval');
                $(datas).val(oled)
            } else {
                // Jika tidak ada gambar yang dipilih, kosongkan nilai oldImage
                this.val('');
            }
        });
    });
</script>
</x-app-layout>
