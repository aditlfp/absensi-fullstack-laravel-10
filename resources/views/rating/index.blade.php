<x-app-layout>
	<x-main-div>
		<div class="py-10 px-5">
			<p class="text-center text-lg sm:text-2xl font-bold  uppercase">Index Rating, {{ Auth::user()->kerjasama->client->name }}</p>
			
			<div class="flex justify-center sm:justify-end ">
				<div class="input flex items-center w-fit input-bordered my-10">
					<i class="ri-search-2-line"></i>
					<input type="search" id="searchInput" class="border-none rounded ml-1" placeholder="Search..." required>
				</div>
			</div>
			<div class="flex  overflow-x-scroll md:overflow-hidden sm:mx-10 pb-10">
				<table class="table table-xs sm:table-sm w-full text-xs sm:text-base shadow-md bg-slate-50" id="searchTable">
					<thead>
						<tr>
							<th class="bg-slate-300 rounded-tl-2xl">#</th>
							<th class="bg-slate-300 ">Nama Karyawan</th>
							@if (Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
								<th class="bg-slate-300 ">Rating Mitra</th>
								<th class="bg-slate-300 ">Rating Leader</th>
							@elseif (Auth::user()->divisi->jabatan->code_jabatan != 'MITRA')
								<th class="bg-slate-300 ">Rating Leader</th>
							@endif
							<th class="bg-slate-300 ">Riwayat</th>
							@if (Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
								<th class="bg-slate-300 ">Approved Mitra</th>
							@endif
							<th class="bg-slate-300 rounded-tr-2xl">Approved Leader</th>
						</tr>
					</thead>

					<tbody class="text-sm my-10">
						@php
							$no = 1;
						@endphp
						@forelse ($user as $us)
							@if ($us->divisi->jabatan->code_jabatan != 'MITRA')
								<tr>
									<td>{{ $no++ }}</td>
									<td class="line-clamp-3 sm:line-clamp-none">{{ $us->nama_lengkap }}</td>
									@if (Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
										<td>
											@forelse ($us->rating as $rat)
												@if ($rat->mitra_name != null)
													<span class=" rating rating-sm ">
														@for ($i = 1; $i <= $rat->rate_mitra; $i++)
															<input type="radio" name="rate" value="{{ $i }}" class="mask mask-star-2 bg-orange-400"
																readonly disabled />
														@endfor
													</span>
												@else
													<button id="btnModalU{{ $us->id }}" data-id="{{ $us->id }}"
														class="btn btn-info btn-sm sm:btn-md text-xs sm:text-sm hover:bg-sky-500 hover:border-0 myModalBtnU">
														+ Rate
													</button>
												@endif
											@break

											@empty
												<button id="btnModal{{ $us->id }}" data-id="{{ $us->id }}"
													class="btn btn-info btn-sm sm:btn-md text-xs sm:text-sm hover:bg-sky-500 hover:border-0 myModalBtn">
													+ Rate
												</button>
											@endforelse
										</td>
										<td>
											@forelse ($us->rating as $rat)
												@if ($rat->leader_name != null)
													<span class=" rating rating-sm ">
														@for ($i = 1; $i <= $rat->rate_leader; $i++)
															<input type="radio" name="rate" class="mask mask-star-2 bg-orange-400" readonly disabled />
														@endfor
													</span>
												@else
												@endif
											@empty
												<span class="py-2 px-4 text-red-500  font-bold rounded-md">Kosong</span>
											@endforelse
										</td>
									@elseif(Auth::user()->divisi->jabatan->code_jabatan == 'LEADER')
										<td>
											@forelse ($us->rating as $rat)
												@if ($rat->leader_name != null)
													<span class=" rating rating-sm ">
														@for ($i = 1; $i <= $rat->rate_leader; $i++)
															<input type="radio" name="rate" class="mask mask-star-2 bg-orange-400" readonly disabled />
														@endfor
													</span>
												@else
													<button id="btnModalU{{ $us->id }}" data-id="{{ $us->id }}"
														class="btn btn-info hover:bg-sky-500 hover:border-0 myModalBtnU">
														+ Rate
													</button>
												@endif
											@break

											@empty
												<button id="btnModal{{ $us->id }}" data-id="{{ $us->id }}"
													class="btn btn-info hover:bg-sky-500 hover:border-0 myModalBtn">
													+ Rate
												</button>
											@endforelse
										</td>
									@endif
									<td>
										<span><a href="{{ route('rate.kerja', $us->id) }}"
												class="btn btn-info btn-sm sm:btn-md text-xs sm:text-sm">Riwayat</a></span>
									</td>
									@if (Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
										<td>
											@forelse ($us->rating as $rat)
													@if ($rat->mitra_name != null)
														<span class="font-semibold underline line-clamp-2 sm:line-clamp-none">
																{{ $rat->mitra_name }}
														</span>
													@else
														<span class="text-center">
															~ - ~
														</span>
													@endif
												@break
										@empty
											<span class="text-center">~ - ~</span>
										@endforelse
									</td>
									<td>
										@forelse ($us->rating as $rat)
												@if ($rat->leader_name != null)
													<span class="font-semibold underline line-clamp-2 sm:line-clamp-none">
														{{ $rat->leader_name }}
													</span>
												@else
													<span class="text-center">
														~ - ~
													</span>
												@endif
											@break
									@empty
										<span class="text-center">~ - ~</span>
									@endforelse
								</td>
							@else
								<td>
									@forelse ($us->rating as $rat)
										@if ($rat->leader_name != null)
											<span class="font-semibold underline line-clamp-2 sm:line-clamp-none">
												{{ $rat->leader_name }}
											</span>
										@else
											<span class="text-center">
												~ - ~
											</span>
										@endif
									@break

									@empty
										<span class="text-center">~ - ~</span>
									@endforelse
								</td>
							@endif
						</tr>

						<!-- Modal structure for each user -->
						<div id="myRateModal{{ $us->id }}"
							class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[9999]">
							<div class="modal-content bg-white rounded-md shadow  p-6">
								@if (Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
									<form action="{{ route('mitra-rating.store') }}" method="post">
										@csrf
										<p class="text-center font-semibold text-lg py-5">+ Rating, {{ $us->nama_lengkap }}</p>
										<div>
											<label for="user_id" class="label label-text">Nama Karyawan</label>
											<input type="text" value="{{ $us->nama_lengkap }}" readonly class="input input-bordered w-full " />
											<input type="text" name="user_id" class="hidden" value="{{ $us->id }}" />
										</div>
										<div>
											<label for="rate_mitra" class="label label-text">Rating</label>
											<div class="rating  flex justify-center">
												<div class="bg-gray-200/70 p-2 w-fit rounded-md">
													<input type="radio" name="rate_mitra" value="1" class="mask mask-star-2 bg-orange-400" checked />
													<input type="radio" name="rate_mitra" value="2" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_mitra" value="3" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_mitra" value="4" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_mitra" value="5" class="mask mask-star-2 bg-orange-400" />
												</div>
											</div>
										</div>
										<div class="hidden">
											<input type="text" name="mitra_name" id="mitra_name" value="{{ Auth::user()->nama_lengkap }}">
											<input type="text" name="isMitra" value="1">

										</div>
										<div class="flex gap-2 mt-10 justify-center">
											<button type="submit" class="btn btn-primary">Rating</button>
											<span class="close cursor-pointer btn btn-error top-2 right-2 text-white"
												data-modal-id="{{ $us->id }}">&times;</span>
										</div>
									</form>
								@else
									<form action="{{ route('leader-rating.store') }}" method="post">
										@csrf
										<p class="text-center font-semibold text-lg py-5">+ Rating, {{ $us->nama_lengkap }}</p>
										<div>
											<label for="user_id" class="label label-text">Nama Karyawan</label>
											<input type="text" value="{{ $us->nama_lengkap }}" readonly class="input input-bordered w-full" />
											<input type="text" name="user_id" class="hidden" value="{{ $us->id }}" />
										</div>
										<div>
											<label for="rate_leader" class="label label-text">Rating</label>
											<div class="rating  flex justify-center">
												<div class="bg-gray-200/70 p-2 w-fit rounded-md">
													<input type="radio" name="rate_leader" value="1" class="mask mask-star-2 bg-orange-400"
														checked />
													<input type="radio" name="rate_leader" value="2" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_leader" value="3" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_leader" value="4" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_leader" value="5" class="mask mask-star-2 bg-orange-400" />
												</div>
											</div>
										</div>
										<div class="hidden">

											<input type="text" name="leader_name" id="leader_name" value="{{ Auth::user()->nama_lengkap }}">
											<input type="text" name="isLeader" value="1">
										</div>
										<div class="flex gap-2 mt-10 justify-center">
											<button type="submit" class="btn btn-primary">Rating</button>
											<span class="close cursor-pointer btn btn-error top-2 right-2 text-white"
												data-modal-id="{{ $us->id }}">&times;</span>
										</div>
									</form>
								@endif
							</div>
						</div>
						<!-- Modal structure for each user (Updated) -->
						<div id="myRateModalU{{ $us->id }}"
							class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[9999]">
							<div class="modal-content bg-white rounded-md shadow mx-2 sm:mx-0 p-6">
								@if (Auth::user()->divisi->jabatan->code_jabatan == 'MITRA')
									@foreach ($rating as $item)
										<form action="{{ route('mitra-rating.update', $item->id) }}" method="post">
											@csrf
											@method('PATCH')
											<p class="text-center font-semibold text-lg py-5">+ Rating, {{ $us->nama_lengkap }}</p>
											<div>
												<label for="user_id" class="label label-text">Nama Karyawan</label>
												<input type="text" value="{{ $us->nama_lengkap }}" readonly class="input input-bordered" />
												<input type="text" name="user_id" class="hidden" value="{{ $us->id }}" />
											</div>
											<div>
												<label for="rate_mitra" class="label label-text">Rating</label>
												<div class="rating  flex justify-center">
													<div class="bg-gray-200/70 p-2 w-fit rounded-md">
														<input type="radio" name="rate_mitra" value="1" class="mask mask-star-2 bg-orange-400"
															checked />
														<input type="radio" name="rate_mitra" value="2" class="mask mask-star-2 bg-orange-400" />
														<input type="radio" name="rate_mitra" value="3" class="mask mask-star-2 bg-orange-400" />
														<input type="radio" name="rate_mitra" value="4" class="mask mask-star-2 bg-orange-400" />
														<input type="radio" name="rate_mitra" value="5" class="mask mask-star-2 bg-orange-400" />
													</div>
												</div>
											</div>
											<div class="hidden">
												<input type="text" name="mitra_name" id="mitra_name" value="{{ Auth::user()->nama_lengkap }}">
												<input type="text" name="isMitra" value="1">
												<input type="text" name="leader_name" id="leader_name"
													value="{{ $item->leader_name ? $item->leader_name : '' }}">
												<input type="text" name="isLeader" value="1">
												<input type="text" name="rate_leader"
													value="{{ $item->rate_leader ? $item->rate_leader : null }}" />
											</div>
											<div class="flex gap-2 mt-10 justify-center">
												<button type="submit" class="btn btn-info">Rating</button>
												<span class="close cursor-pointer btn btn-error top-2 right-2 text-white"
													data-modal-id="{{ $us->id }}">&times;</span>
											</div>
										</form>
									@break
								@endforeach
							@else
								@foreach ($rating as $item)
									<form action="{{ route('leader-rating.update', $item->id) }}" method="post">
										@csrf
										@method('PATCH')
										<p class="text-center font-semibold text-lg py-5">+ Rating, {{ $us->nama_lengkap }}</p>
										<div>
											<label for="user_id" class="label label-text">Nama Karyawan</label>
											<input type="text" value="{{ $us->nama_lengkap }}" readonly class="input input-bordered" />
											<input type="text" name="user_id" class="hidden" value="{{ $us->id }}" />
										</div>
										<div>
											<label for="rate_leader" class="label label-text">Rating</label>
											<div class="rating  flex justify-center">
												<div class="bg-gray-200/70 p-2 w-fit rounded-md">
													<input type="radio" name="rate_leader" value="1" class="mask mask-star-2 bg-orange-400"
														checked />
													<input type="radio" name="rate_leader" value="2" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_leader" value="3" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_leader" value="4" class="mask mask-star-2 bg-orange-400" />
													<input type="radio" name="rate_leader" value="5" class="mask mask-star-2 bg-orange-400" />
												</div>
											</div>
										</div>
										<div class="hidden">
											<input type="text" name="mitra_name" id="mitra_name"
												value="{{ $item->mitra_name ? $item->mitra_name : '' }}">
											<input type="text" name="isMitra" value="1">
											<input type="text" name="leader_name" id="leader_name" value="{{ Auth::user()->nama_lengkap }}">
											<input type="text" name="isLeader" value="1">
											<input type="text" name="rate_mitra" value="{{ $item->rate_mitra ? $item->rate_mitra : null }}" />

										</div>
										<div class="flex gap-2 mt-10 justify-center">
											<button type="submit" class="btn btn-info">Rating</button>
											<span class="close cursor-pointer btn btn-error top-2 right-2 text-white"
												data-modal-id="{{ $us->id }}">&times;</span>
										</div>
									</form>
								@break
							@endforeach
						@endif
					</div>
				</div>
			@endif
		@empty
			<tr>
				<td colspan="5">~ Data Kosong ~</td>
			</tr>
		@endforelse
	</tbody>
</table>
</div>
<div class="flex justify-center sm:justify-end ">
	<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Back</a>
</div>
</div>
</div>
</x-main-div>
<script>
	var modalButtons = document.querySelectorAll('.myModalBtn');
	var modalButtonsU = document.querySelectorAll('.myModalBtnU');
	modalButtons.forEach(function(button) {
		button.addEventListener('click', function() {
			var userId = button.getAttribute('data-id');
			var modal = document.getElementById('myRateModal' + userId);
			modal.classList.remove('hidden'); // Show the modal
		});
	});

	var closeButtons = document.querySelectorAll('.close');
	closeButtons.forEach(function(closeButton) {
		closeButton.addEventListener('click', function() {
			var modalId = closeButton.getAttribute('data-modal-id');
			var modal = document.getElementById('myRateModal' + modalId);
			modal.classList.add('hidden'); // Hide the modal
		});
	});

	modalButtonsU.forEach(function(button) {
		button.addEventListener('click', function() {
			var userId = button.getAttribute('data-id');
			var modal = document.getElementById('myRateModalU' + userId);
			modal.classList.remove('hidden'); // Show the modal
		});
	});
	var closeButtons = document.querySelectorAll('.close');
	closeButtons.forEach(function(closeButton) {
		closeButton.addEventListener('click', function() {
			var modalId = closeButton.getAttribute('data-modal-id');
			var modal = document.getElementById('myRateModalU' + modalId);
			modal.classList.add('hidden'); // Hide the modal
		});
	});

	window.addEventListener('keydown', function(event) {
		if (event.key === 'Escape') {
			var openModal = document.querySelector('.bg-opacity-50:not(.hidden)');
			if (openModal) {
				openModal.classList.add('hidden'); // Hide the currently open modal
			}
		}
	});

	window.addEventListener('click', function(event) {
		if (event.target.classList.contains('bg-opacity-50')) {
			event.target.classList.add('hidden'); // Hide the modal when clicking outside
		}
	});
</script>
</x-app-layout>
