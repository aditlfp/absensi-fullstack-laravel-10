<x-app-layout>
	<x-main-div>
		<div class="py-10 px-10">
			<p class="text-xl font-bold uppercase text-center mb-10">Tambah Kerjasama</p>
			<form action="{{ route('kerjasamas.store') }}" method="post">
				<div class="px-10 py-10 rounded-md mx-5 bg-slate-100">
					@method('POST')
					@csrf
					<div class="flex items-center mb-5 mt-5">
						<label for="client_id" class="mr-[3.61rem]">Client</label>
						<select
							class="text-md block px-3 py-2 rounded-lg w-3/6 bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
							name="client_id">
							<option selected disabled class="disabled:bg-slate-700 disabled:text-slate-100">--Select Client--</option>
							@foreach ($client as $i)
								<option value="{{ $i->id }}">{{ $i->name }}</option>
							@endforeach
							<x-input-error class="mt-2" :messages="$errors->get('client_id')" />
						</select>
					</div>
					<div class="flex items-center mb-5">
						<label for="value" class="mr-5">Input Value</label>
						<input type="text" name="value" id="value"
							class="text-md block px-3 py-2 rounded-lg w-3/6 bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
						<x-input-error class="mt-2" :messages="$errors->get('value')" />
					</div>
					<div class="flex items-center mb-5">
						<label for="value" class="mr-[4.1rem]">Date</label>
						<input type="date" name="experied" id="experied"
							class="text-md block px-3 py-2 rounded-lg w-3/6 bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
						<x-input-error class="mt-2" :messages="$errors->get('experied')" />
					</div>
					<div class="flex w-fit gap-5 items-center mb-5">
						<label for="approve[1,2,3]" class="mr-4">Approve By</label>
						<input type="text" name="approve1" id="approve1"
							class="text-md block px-3 py-2 rounded-lg w-2/6 bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
						<input type="text" name="approve2" id="approve2"
							class="text-md block px-3 py-2 rounded-lg w-2/6 bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
						<input type="text" name="approve3" id="approve3"
							class="text-md block px-3 py-2 rounded-lg w-2/6 bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
					</div>
					<div class="flex gap-3 justify-end mb-5">
						<button type="submit" class="btn btn-primary">Save</button>
						<a href="{{ route('kerjasamas.index') }}" class="btn btn-error">Back</a>
					</div>
				</div>
			</form>
		</div>
	</x-main-div>
</x-app-layout>
