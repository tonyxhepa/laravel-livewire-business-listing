<div>
    <x-jet-banner />
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="w-full flex justify-between sm:px-6 lg:px-8 py-2">
                <div>
                    <input wire:model="search" type="search" class="p-2 m-2 rounded" placeholder="Search">
                </div>
                <div class="m-2 p-2">
                    <x-jet-button wire:click="showCreateModal" class="bg-green-500">Create</x-jet-button>
                </div>
            </div>
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Address
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Website
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" wire:loading.class="opacity-50">

                            @forelse ($listings as $listing)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $listing->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $listing->address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $listing->website }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $listing->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <x-jet-button wire:click="showEditModal({{ $listing->id }})"
                                            class="bg-green-500">Edit</x-jet-button>
                                        <x-jet-button wire:click="deleteListing({{ $listing->id }})"
                                            class="bg-red-500">Delete</x-jet-button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        No Results
                                    </td>
                                </tr>
                            @endforelse
                            <!-- More people... -->
                        </tbody>
                    </table>
                    <div class="m-2 p-2">
                        {{ $listings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">Create Listing</x-slot>
        <x-slot name="content">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Name
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="text" id="name" wire:model="name"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                placeholder="Name">
                                        </div>
                                        @error('name') <span class="text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700">
                                            Address
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="text" id="address" wire:model="address"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                placeholder="Address">
                                        </div>
                                        @error('address') <span class="text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="company_website" class="block text-sm font-medium text-gray-700">
                                            Website
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" wire:model="website" id="company_website"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                placeholder="www.example.com">
                                        </div>
                                        @error('website') <span class="text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">
                                            Email
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="email" id="email" wire:model="email"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                placeholder="Email">
                                        </div>
                                        @error('email') <span class="text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">
                                            Phone
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="tel" id="phone" wire:model="phone"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                placeholder="Phone">
                                        </div>
                                        @error('phone') <span class="text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                        Bio
                                    </label>
                                    <div class="mt-1">
                                        <textarea id="about" rows="3" wire:model="bio"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder="bio"></textarea>
                                    </div>
                                    @error('bio') <span class="text-red-400">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            @if ($editMode)
                <x-jet-button wire:click="listingUpdate">Update</x-jet-button>
            @else
                <x-jet-button wire:click="createLisitng">Create</x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
