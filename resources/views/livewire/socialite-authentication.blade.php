<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Linking your external accounts') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Simplify your experience when using this website and our servers by linking your Steam and Discord account.') }}
        </x-slot>

        <x-slot name="content">
            <h3 class="text-lg font-medium text-gray-900">
                @if ($this->isSteamLinked)
                    {{ __('You have linked your Steam account.') }}
                @else
                    {{ __('You have not linked your Steam account.') }}
                @endif
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    {{ __('With your Steam account linked, you will not be required to login when connecting to our servers. We can also pull in some useful information to make your experience much better!') }}
                </p>
            </div>

            @if ($this->isSteamLinked)
                <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white">
                    <img src="https://badges.steamprofile.com/profile/default/steam/{{ $user->steam_id }}.png">
                </div>
            @endif

            <div class="mt-5">
                @if (! $this->isSteamLinked)
                    <x-jet-button type="button" wire:click="linkSteamAccount()" wire:loading.attr="disabled">
                        {{ __('Link Steam') }}
                    </x-jet-button>
                @else
                    <x-jet-button type="button" wire:click="$toggle('modalDisassociateSteamVisible')" wire:loading.attr="disabled">
                        {{ __('Disassociate Steam Account') }}
                    </x-jet-button>
                @endif
            </div>

            <x-jet-section-border />

            <h3 class="text-lg font-medium text-gray-900">
                @if ($this->isDiscordLinked)
                    {{ __('You have linked your Discord account.') }}
                @else
                    {{ __('You have not linked your Discord account.') }}
                @endif
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    {{ __('With your Discord account linked, your rank information from here will be carried across to our Discord Server. We can also ping you any important messages when they may arise!') }}
                </p>
            </div>

            @if ($this->isDiscordLinked)
                <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white">
                    <img src="https://badges.steamprofile.com/profile/default/steam/{{ $user->steam_id }}.png">
                </div>
            @endif

            <div class="mt-5">
                @if (! $this->isDiscordLinked)
                    <x-jet-button type="button" wire:click="linkDiscordAccount()" wire:loading.attr="disabled">
                        {{ __('Link Discord') }}
                    </x-jet-button>
                @else
                    <x-jet-button type="button" wire:click="$toggle('modalDisassociateDiscordVisible')" wire:loading.attr="disabled">
                        {{ __('Disassociate Discord Account') }}
                    </x-jet-button>
                @endif
            </div>
        </x-slot>

    </x-jet-action-section>

    <x-jet-dialog-modal wire:model="modalDisassociateSteamVisible">
        <x-slot name="title">
            {{ __('Are you sure you want to disassociate your Steam Account?') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Clicking the "Go to Steam" button below, you\'ll be redirected to Steam\'s login page. Complete the login process and you will then be redirected back here.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalDisassociateSteamVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="removeSteamAccount()">
                {{ __('Yes I\'m Sure!') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
