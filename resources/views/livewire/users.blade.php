<div class="p-6">
    <div class="flex item-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Add User') }}
        </x-jet-button>
    </div>

    {{--  The data table  --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $item->name }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $item->email }}</td>
                                    <td class="px-6 py-4 text-right text-sm">
                                        @if ($item->id != Auth::user()->id)
                                        <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                            {{ __('Update') }}
                                        </x-jet-button>
                                        <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                            {{ __('Delete') }}
                                        </x-jet-danger-button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="3">
                                        No Results Found.
                                    </td>
                                </tr>
                            @endif ()

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br /><br />
    {{ $data->links() }}

    {{--  The createUser modal  --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Create User') }} {{ $modelId }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Username') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model.debounce.800ms="email" />
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            @if (!$modelId)
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" wire:model.debounce.800ms="password" />
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            @if ($modelId)
            <x-jet-button class="ml-2" wire:click="updateUser" wire:loading.attr="disabled">
                {{ __('Update User') }}
            </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="createUser" wire:loading.attr="disabled">
                    {{ __('Create User') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
    {{--  The userDelete modal  --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete User') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this user? Once the user has been deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Delete User') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
