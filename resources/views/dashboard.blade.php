<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b-2">
                    {{ __("You're logged in!") }}
                </div>
                <div class="flex mx-4 my-6">
                    <div class="h-full w-1/3 mr-8 border rounded-md border-[#F7F7F7]">
                        <div class="bg-[#F5F5F5] py-2 px-4">
                            <h3>Add New Country</h3>
                        </div>

                        <form action="{{ route('countries.store') }}" method="POST" id="add-country-form">
                            @csrf
                            <div class="my-6 mx-4">
                                <div class="mb-6">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                    <input type="name" name="name" id="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                                <div class="mb-6">
                                    <label for="iso" class="block mb-2 mt-4 text-sm font-medium text-gray-900">ISO</label>
                                    <input type="text" name="iso" id="iso" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                            </div>
                            <div class="flex flex-row-reverse bg-[#F5F5F5] p-4">
                                <button type="submit" class="text-white bg-[#202938] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2 text-center">SAVE</button>
                            </div>
                        </form>

                    </div>
                    <div class="flex-auto border rounded-md border-[#F7F7F7]">
                        <div class="bg-[#F5F5F5] py-2 px-4">
                            <h3>List of countries</h3>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr class="border-t-2 border-b-4">
                                    <th scope="col" class="px-6 py-3">
                                        Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ISO
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="countries-table">
                                @foreach ($countries as $index => $country)
                                    <tr class="bg-white border-t">
                                        <td scope="col" class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td scope="col" class="px-6 py-4">{{ $country->name }}</td>
                                        <td scope="col" class="px-6 py-4">{{ $country->iso }}</td>
                                        <td scope="col" class="px-6 py-4"><a href="{{ route('countries.edit', $country->id) }}">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('add-country-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                const formData = new FormData(form); // Collect form data

                /* Send form data asynchronously */
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error: ' + response.status);
                    }
                })
                .then(data => {
                    if (data.success) {
                        form.reset(); // Clear the form

                        /* Update the table with the new row */
                        const tableBody = document.getElementById('countries-table');
                        const newRow = document.createElement('tr');
                        newRow.classList.add('border-t');
                        newRow.innerHTML = `
                            <td class="px-6 py-4">${data.country.id}</td>
                            <td class="px-6 py-4">${data.country.name}</td>
                            <td class="px-6 py-4">${data.country.iso}</td>
                            <td class="px-6 py-4">
                                <a href="/countries/${data.country.id}/edit">Edit</a>
                            </td>
                        `;
                        tableBody.appendChild(newRow);
                    } else {
                        throw new Error('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            });
        });
    </script>
</x-app-layout>
