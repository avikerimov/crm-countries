<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Country') }}
            </h2>
            <form action="{{ route('countries.destroy', $country->id) }}" method="POST" class="ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2 text-center">Delete</button>
            </form>
        </div>
    </x-slot>
    <form action="{{ route('countries.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="my-6 mx-4">
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="name" name="name" id="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $country->name }}" required>
            </div>
            <div class="mb-6">
                <label for="iso" class="block mb-2 mt-4 text-sm font-medium text-gray-900">ISO</label>
                <input type="text" name="iso" id="iso" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $country->iso }}" required>
            </div>
        </div>
        <div class="flex flex-row-reverse bg-[#F5F5F5] p-4">
            <button type="submit" class="text-white bg-[#202938] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2 text-center">Update</button>
        </div>
    </form>
</x-app-layout>


