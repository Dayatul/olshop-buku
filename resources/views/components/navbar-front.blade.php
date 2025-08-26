<nav x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 10"
    :class="scrolled ? 'shadow-md border-b border-gray-200' : 'shadow-none border-transparent'"
    class="bg-white sticky top-0 shadow z-50">
    <div class="container mx-auto flex items-center justify-between p-4">
        <a href="#" class="w-[150px]"><img src="{{ asset('/assets/logo/logo-wigati.webp') }}" alt=""></a>
        <div class="flex space-x-6 font-semibold">
            <a href="{{ route('front.index') }}"
                class="relative pb-1 {{ request()->routeIs('front.index') ? 'text-red-600 after:w-full' : 'text-gray-800 after:w-0' }}
              hover:text-red-600 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Home
            </a>

            <a href="{{ route('front.product') }}"
                class="relative pb-1 {{ request()->routeIs('front.product') ? 'text-red-600 after:w-full' : 'text-gray-800 after:w-0' }}
              hover:text-red-600 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Product
            </a>

            <a href="{{ route('front.blog') }}"
                class="relative pb-1 {{ request()->routeIs('front.blog') || request()->routeIs('front.article.details') ? 'text-red-600 after:w-full' : 'text-gray-800 after:w-0' }}
              hover:text-red-600 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Blog
            </a>

            <a href="{{ route('front.about') }}"
                class="relative pb-1 {{ request()->routeIs('front.about') ? 'text-red-600 after:w-full' : 'text-gray-800 after:w-0' }}
              hover:text-red-600 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                About Us
            </a>

            <a href="{{ route('front.contact') }}"
                class="relative pb-1 {{ request()->routeIs('front.contact') ? 'text-red-600 after:w-full' : 'text-gray-800 after:w-0' }}
              hover:text-red-600 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Contact
            </a>
        </div>

        <div class="relative" x-data="{ open: false }">
            @guest
                <a href="{{ route('login') }}"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            @endguest

            @auth
                <button @click="open = !open"
                    class="bg-red-600 text-white px-4 py-2 rounded flex items-center font-semibold">
                    <i class="fas fa-user mr-2"></i> {{ Auth::user()->name }}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg z-50">
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 hover:bg-gray-100 font-semibold">Dashboard</a>

                    @role('buyer')
                        <a href="{{ route('carts.index') }}" class="block px-4 py-2 hover:bg-gray-100 font-semibold">Cart</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 font-semibold">Status Pembelian</a>
                    @endrole

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 font-semibold">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
