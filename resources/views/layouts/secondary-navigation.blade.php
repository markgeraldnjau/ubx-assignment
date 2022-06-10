<nav class="bg-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
        <div class="flex">
            <div class="flex">
                <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-sec-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Summary') }}
                        </x-sec-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-sec-nav-link :href="route('manageContactsIndex')" :active="request()->routeIs('manageContactsIndex')">
                            {{ __('Contact Management') }}
                        </x-sec-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-sec-nav-link :href="route('viewCampaigns')" :active="request()->routeIs('viewCampaigns')">
                            {{ __('Campaigns') }}
                        </x-sec-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-sec-nav-link :href="route('viewPurchase')" :active="request()->routeIs('viewPurchase')">
                            {{ __('Purchase') }}
                        </x-sec-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-sec-nav-link :href="route('BulkSmsesIndex')" :active="request()->routeIs('BulkSmsesIndex')">
                            {{ __('Report') }}
                        </x-sec-nav-link>
                    </div>
                    
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-sec-nav-link :href="route('BulkSmsesIndex')" :active="request()->routeIs('BulkSmsesIndex')">
                            {{ __('API') }}
                        </x-sec-nav-link>
                    </div>
            </div>
            
        </div>
    </div>
</nav>