<div>
    <div class="flex justify-between items-center">
        <div class="flex flex-row mb-1 sm:mb-0">
            <button class="inline-flex items-center justify-center px-4 py-2 text-base leading-5 rounded-md border font-medium shadow-sm transition ease-in-out duration-150 focus:outline-none focus:shadow-outline bg-green-600 border-green-600 text-gray-100 hover:bg-green-500 hover:border-green-500 hover:text-gray-100 focus:outline-none">
                <i class="fas fa-plus"></i> <span class="px-2 font-semibold">Add User</span>
            </button>
        </div>

        <div class="my-2 flex sm:flex-row flex-col">
            <div class="flex flex-row mb-1 sm:mb-0">
                <div class="relative">
                    <select wire:model="perPage" class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input wire:model="search" placeholder="Search"
                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>
    </div>
    
    {{-- <div class="px-3 py-4 flex justify-center"> --}}
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5"><a wire:click.prevent="sortBy('name')" role="button" href="#">Name</a></th>
                    <th class="text-left p-3 px-5"><a wire:click.prevent="sortBy('email')" role="button" href="#">Email</a></th>
                    <th class="text-left p-3 px-5"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">Created</a></th>
                    <th class="text-left p-3 px-5"><a wire:click.prevent="sortBy('role')" role="button" href="#">Role</a></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-orange-100 {{ ($loop->odd) ? "bg-gray-100" : "" }}">
                        <td class="p-3 px-5"><input type="text" value="{{ $user->name }}" class="bg-transparent"></td>
                        <td class="p-3 px-5"><input type="text" value="{{ $user->email }}" class="bg-transparent"></td>
                        <td class="p-3 px-5">{{ $user->created_at->format('d-M-Y') }}</td>
                        <td class="p-3 px-5">
                            <select value="user.role" class="bg-transparent">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </td>
                        <td class="p-3 px-5 flex justify-end">
                            <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Save</button>
                            <button type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $users->links() }}
    </div>
   
</div>
