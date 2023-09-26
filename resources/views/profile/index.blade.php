<x-app-layout>
	<x-main-div>
		<div>
			<p class="text-center text-2xl font-bold pt-5 uppercase grid justify-center items-center">Profile</p>
			<div class="bg-slate-100 mx-5 my-5 rounded-md shadow">
				<div>
					<span class="flex justify-end mt-5 mx-5">
						<a href="{{ route('profile.edit', Auth::user()->id) }}" class="bg-amber-400 py-1.5 px-2 text-xs rounded-full">
							<span class="flex">
								<p class="font-semibold">Edit</p>
								<i class="ri-edit-2-line"></i>
							</span>
						</a>
					</span>
					<div class="flex items-center py-10 justify-center">
						<div
							class="p-5 mx-2 my-2 overflow-hidden flex items-center justify-center bg-slate-200 rounded-full shadow-md  hover:shadow-none transition-all .2s w-24 h-24 ease-in-out">
								@if (Auth::user()->image == 'no-image.jpg')
									<img class="w-20 rounded-full " src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
										srcset="{{ URL::asset('/logo/person.png') }}">
								@elseif(Storage::disk('public')->exists('images/' . Auth::user()->image))
									<img class=" rounded-full" src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="profile-logo.png"
										srcset="{{ asset('storage/images/' . Auth::user()->image) }}">
								@else
									<img class="w-20 rounded-full " src="{{ URL::asset('/logo/person.png') }}" alt="profile-logo.png"
										srcset="{{ URL::asset('/logo/person.png') }}">
								@endif
						</div>
					</div>
					
					<div class="bg-slate-300 mx-4 my-4 rounded-md p-2 py-5 font-semibold text-sm">
						<div class="text-slate-800 space-y-2">
							<table>
								<thead class="uppercase" style="font-size: 13px;">
									<tr>
										<td>UserName</td>
										<td>:{{ Auth::user()->name }}</td>
									</tr>
									<tr>
										<td>
											Nama Lengkap
										</td>
										<td class="break-words whitespace-pre-wrap">:{{ Auth::user()->nama_lengkap }}</td>
									</tr>
									<tr>
										<td>Email</td>
										<td class="break-words whitespace-pre-line">:{{ Auth::user()->email }}</td>
									</tr>
									<tr>
										<td>Jabatan</td>
										@if (Auth::user()->divisi->jabatan == null)
											<td>:Kosong</td>
										@else
											<td>:{{ Auth::user()->divisi->jabatan->name_jabatan }}</td>
										@endif
									</tr>
									<tr>
										<td>Bermitra</td>
										@if (Auth::user()->kerjasama == null)
											<td>:Kosong</td>
										@else
											<td>:{{ Auth::user()->kerjasama->client->name }}</td>
										@endif
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="flex justify-center sm:justify-end mt-2 mb-5">
				<a href="{{ route('dashboard.index') }}" class="btn btn-error mx-2 sm:mx-10">Kembali</a>
			</div>
		</div>
	</x-main-div>
</x-app-layout>
