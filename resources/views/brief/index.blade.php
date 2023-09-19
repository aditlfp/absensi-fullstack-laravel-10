<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ env('APP_NAME', 'Kinerja SAC-PONOROGO') }}</title>
	<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	{{-- <script src="{{ URL::asset('src/js/jquery-min.js') }}"></script> --}}
	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <link  href="{{ URL::asset('css/datatable.css')}}" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

	{{-- Leaflet --}}
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/datatable.css')}}">
    <script src="{{ URL::asset('js/datatable.js')}}"></script> --}}
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="font-sans antialiased  bg-slate-400">
	<div class="min-h-screen pb-[12.5rem]">
		@include('../layouts/navbar')
		<div class="justify-start flex items-center p-10 sm:mx-10 mx-5 bg-slate-500 rounded-md shadow-md mb-[12.5rem]">
            <div class="w-full flex flex-col">
                <div class="mb-2">
                    <button id="modalPulangBtn"
                        class="bg-green-600 flex justify-center shadow-md hover:bg-green-700 text-white hover:shadow-none px-3 py-1 text-xl rounded-md transition all ease-out duration-100 mt-5 mr-0 sm:mr-2 uppercase items-center"><span class="font-bold" onClick="openModal()">Create New</span>
                    </button>
                </div>
                <table class="table table-bordered" id="ajax-crud-datatable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>off</th>
                            <th>Materi Breafing</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div
                class="fixed inset-0 modalp hidden bg-slate-500/10 backdrop-blur-sm transition-all duration-300 ease-in-out">
                <div class="bg-slate-200 w-3/6 m-10 h-3/6 rounded-md shadow">
                    <div class="flex justify-end mb-3">
                        <button class="btn btn-error scale-90 close">&times;</button>
                    </div>
                    <form action="javascript:void(0)" id="EmployeeForm" name="EmployeeForm" method="POST">
                        @csrf
                        <div class="flex justify-center flex-col text-xs ml-4 mr-5">
                            <h2 id="head-modal" class="bg-yellow-400 p-2 rounded-md"></h2>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <input id="id" class="hidden">
                                    <label for="client_id" class="mr-2">Mitra/Area : </label>
                                    <input type="text" id="client_id" name="client_id" class="input input-bordered input-xs" value="{{ Auth::user()->kerjasama->client->id}}" readonly hidden>
                                    <input type="text" class="input input-bordered input-xs" value="{{ Auth::user()->kerjasama->client->name}}" readonly>
                                    <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <label for="tanggal" class="mr-2">Tanggal : </label>
                                    <input type="date" id="tanggal" name="tanggal" class="input input-bordered input-xs">
                                    <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                @php
                                   $pagi = Carbon\Carbon::now()->format('H:i:s') >= '05:00:00';
                                   $siang = Carbon\Carbon::now()->format('H:i:s') >= '13:00:00';
                                   $malam = Carbon\Carbon::now()->format('H:i:s') >= '21:00:00';
                                @endphp
                                <div>
                                    <label for="shift" class="mr-2">Shift : </label>
                                    @if ($pagi)
                                        <input type="text" id="shift" name="shift" class="input input-bordered input-xs" value="Shift Pagi" readonly>
                                    @elseif($siang)
                                        <input type="text" id="shift" name="shift" class="input input-bordered input-xs" value="Shift Siang" readonly>
                                    @else
                                        <input type="text" id="shift" name="shift" class="input input-bordered input-xs" value="Shift Malam" readonly>
                                    @endif
                                    <x-input-error :messages="$errors->get('shift_id')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <label for="hadir" class="mr-2">Hadir</label>
                                    <input type="text" id="hadir" name="hadir" class="input input-bordered input-xs w-5/6">
                                    <x-input-error :messages="$errors->get('hadir')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="spv" class="mr-2">Spv</label>
                                    <input type="text" id="spv" name="spv" class="input input-bordered input-xs w-5/6">
                                    <x-input-error :messages="$errors->get('spv')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="tl" class="mr-5">TL</label>
                                    <input type="text" id="tl" name="tl" class="input input-bordered input-xs w-[90%]">
                                    <x-input-error :messages="$errors->get('tl')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="ocs" class="mr-2">OCS</label>
                                    <input type="text" id="ocs" name="ocs" class="input input-bordered input-xs w-5/6">
                                    <x-input-error :messages="$errors->get('ocs')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <label for="tanpa_keterangan" class="mr-2">Tanpa Keterangan : </label>
                                    <input type="text" id="tanpa_keterangan" name="tanpa_keterangan" class="input input-bordered input-xs">
                                    <x-input-error :messages="$errors->get('tanpa_keterangan')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <label for="izin_atau_cuti" class="mr-2">Izin/Cuti : </label>
                                    <input type="text" id="izin_atau_cuti" name="izin_atau_cuti" class="input input-bordered input-xs">
                                    <x-input-error :messages="$errors->get('izin_atau_cuti')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2 gap-x-3">
                                <div>
                                    <label for="sakit" class="mr-2">Sakit : </label>
                                    <input type="text" id="sakit" name="sakit" class="input input-bordered input-xs w-[95%]">
                                    <x-input-error :messages="$errors->get('sakit')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="off" class="mr-2">Off : </label>
                                    <input type="text" id="off" name="off" class="input input-bordered input-xs w-[95%]">
                                    <x-input-error :messages="$errors->get('off')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <label for="total_mp" class="mr-2">Total MP : </label>
                                    <input type="text" id="total_mp" name="total_mp" class="input input-bordered input-xs">
                                    <x-input-error :messages="$errors->get('total_mp')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex w-3/6 mb-2">
                                <div>
                                    <label for="materi_breafing" class="mr-2">Materi Breafing : </label>
                                    <input type="text" id="materi_breafing" name="materi_breafing" class="input input-bordered input-xs">
                                    <x-input-error :messages="$errors->get('materi_breafing')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-success btn-xs sm:btn-sm" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
    <script type="text/javascript">
    // Handle BTN Modal
    	$(document).ready(function() {
			$(document).on('click', '#modalPulangBtn', function() {
				$('.modalp')
					.removeClass('hidden')
					.addClass('flex opacity-100'); // Add opacity class
			});

			$(document).on('click', '.close', function() {
				$('.modalp')
					.removeClass('flex justify-center items-center opacity-100') // Remove opacity class
					.addClass('opacity-0') // Add opacity class for fade-out
					.addClass('hidden')
			});
		});

        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('brief') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'off', name: 'off' },
                    { data: 'materi_breafing', name: 'materi_breafing'},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']]
            });
            
        });

        function add()
        {
            $('#EmployeeForm').trigger("reset");
        }

        // Function to open the modal for editing or creating a record
        function openModal(id) {
            $('#head-modal').html(id ? 'Edit Briefing' : 'Create Briefing');
            $('.modalp').removeClass('hidden').addClass('flex opacity-100');

            if (id) {
                // Edit mode, fetch data for the given ID
                $.ajax({
                    type: 'GET',
                    url: "{{ url('brief') }}" + "/" + id + "/edit",
                    dataType: 'json',
                    success: function (res) {
                        $('#id').val(res.id);
                        $('#off').val(res.off);
                        $('#tanggal').val(res.tanggal)
                        $('#hadir').val(res.hadir);
                        $('#spv').val(res.spv);
                        $('#tl').val(res.tl);
                        $('#ocs').val(res.ocs);
                        $('#tanpa_keterangan').val(res.tanpa_keterangan);
                        $('#izin_atau_cuti').val(res.izin_atau_cuti);
                        $('#sakit').val(res.sakit);
                        $('#total_mp').val(res.total_mp);
                        $('#materi_breafing').val(res.materi_breafing);
                    }
                });
            } else {
                $('#EmployeeForm').trigger("reset");
            }
        }

        // Function to handle form submission (both create and update)
        $('#EmployeeForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id = $('#id').val(); // Get the ID from the form

            $.ajax({
                type: id ? 'PUT' : 'POST', // Use PUT for updates and POST for creates
                url: id ? "{{ url('brief') }}" + "/" + id : "{{ route('brief.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#btn-save").prop("disabled", true).html('Processing....');
                },
                complete: function () {
                    $("#btn-save").prop("disabled", false).html('Save Change');
                },
                success: function (data) {
                    $(".modalp").addClass('hidden opacity-0');
                    $(".modalp").removeClass('flex justify-center items-center opacity-100');
                    $('#EmployeeForm').trigger("reset");
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        // Function to delete a record
        function deleteFunc(id) {
            // ajax
            $.ajax({
                type: "DELETE",
                url: "{{ url('brief') }}" + '/' + id,
                data: { id: id },
                dataType: 'json',
                success: function (res) {
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }

        // Call openModal() with null to open the modal for creating a new record
        // Call openModal(id) with an ID to open the modal for editing a record

	</script>
</body>

</html>
