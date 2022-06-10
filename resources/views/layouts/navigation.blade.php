<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-10 w-auto fill-current text-gray-600" /> --}}
                        <img class="" src=" {{ asset('assets/logos/longadark.png') }}" width="100"
                            alt="">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')||request()->routeIs('viewPurchase')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('BulkSmsesIndex')"
                        :active="request()->routeIs('BulkSmsesIndex')||request()->routeIs('manageContactsIndex')||request()->routeIs('viewCampaigns')">
                        {{ __('Bulk Sms') }}
                    </x-nav-link>
                    @if (Auth::user()->hasRole('admin'))

                        <x-nav-link :href="route('viewFinances')"
                            :active="request()->routeIs('viewFinances')||request()->routeIs('viewPaymentsRefunds')||request()->routeIs('viewPriceList')">
                            {{ __('Finances') }}
                        </x-nav-link>
                        <x-nav-link :href="route('viewServiceProviders')"
                            :active="request()->routeIs('viewServiceProviders')">
                            {{ __('Service Providers') }}
                        </x-nav-link>

                    @endif

                    {{-- <x-nav-link :href="route('BulkSmsIndex')" :active="request()->routeIs('BulkSmsIndex')">
                        {{ __('Call Center') }}
                    </x-nav-link>

                    <x-nav-link :href="route('BulkSmsIndex')" :active="request()->routeIs('BulkSmsIndex')">
                        {{ __('Two Sms') }}
                    </x-nav-link>

                    <x-nav-link :href="route('BulkSmsIndex')" :active="request()->routeIs('BulkSmsIndex')">
                        {{ __('IVR') }}
                    </x-nav-link> --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        {{-- <div style="font-weight: 900;font-size:20px;line-height: 20px;" class="dropdown dropdown-right">
                            <div tabindex="0"
                                class="m-1 btn text-sm font-medium text-gray-400 hover:text-black-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                {{ Auth::user()->name }}
                            </div>
                            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                <li>
                                    <a>Profile</a>
                                </li>
                                <li>
                                    <a href="#logout"
                                        class="flex items-center text-sm font-medium text-gray-400 hover:text-black-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div class="capitalize">Logout</div>

                                        <div class="ml-1">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </div>
                                    </a>
                                   
                                </li>
                            </ul>
                        </div> --}}
                        <div class="p-20">

                            <div class="dropdown inline-block relative">
                                <button onclick="toggleDropDown() " type="button"
                                    class="border-2 border-solid border-gray-300 text-gray-500 font-semibold py-2 px-4 rounded inline-flex items-center">
                                    <span class="mr-1">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <svg class="fill-current h-4 w-8" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </button>
                                @if (Auth::user()->account)
                                    <div
                                        class="border-2 border-solid border-yellow-600 text-yellow-600 font-semibold py-2 px-4 rounded inline-flex items-center ml-3">
                                        <span class="mr-1">
                                            Sms Balance:
                                        </span>
                                        <spn class="mr-1">

                                            {{ Auth::user()->account->sms_balance }}


                                        </spn>
                                    </div>
                                @endif
                                <ul style="display: none;" id="dropdownBtn"
                                    class="dropdown-menu w-full absolute hidden text-gray-700 pt-2 pb-2 text-center bg-white rounded-md border-2 border-solid border-gray-300 mt-2">

                                    <li class="">
                                        <a href="{{ route('userProfile') }}"
                                            class="rounded-t hover:text-gray-900 py-2 px-4 block whitespace-no-wrap">
                                            Profile
                                        </a>
                                    </li>
                                    <li class="py-1 px-2">
                                        <div class="w-full font-bold text-base border-b border-gray-300">
                                        </div>
                                    </li>
                                    <li class="">
                                        <a href="#logout"
                                            class="rounded-b hover:text-gray-900 py-2 px-4 block whitespace-no-wrap"
                                            href="#">
                                            Logout
                                        </a>
                                        <div id="logout" class="modalDialog overflow-y-auto"
                                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            @include('layouts.logoutModal')
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </x-slot>

                    {{-- <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" style="font-weight: 900;font-size:15px;line-height: 20px;">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot> --}}
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
