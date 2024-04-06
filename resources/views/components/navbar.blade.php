<!-- Navbar -->
<nav x-data="{ mobileMenuOpen: false }" class="bg-purple-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <img class="block lg:hidden h-8 w-auto" src="/path-to-your-logo.png" alt="HiveComb Logo">
                    <img class="hidden lg:block h-8 w-auto" src="/path-to-your-logo.png" alt="HiveComb Logo">
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <!-- Navigation Links -->
                    <a href="#"
                        class="text-gray-200 hover:bg-purple-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="#"
                        class="text-gray-200 hover:bg-purple-700 px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                    <a href="#"
                        class="text-gray-200 hover:bg-purple-700 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                </div>
            </div>
            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed. -->
                    <svg :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <svg :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="sm:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#"
                class="text-gray-200 hover:bg-purple-700 block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="#"
                class="text-gray-200 hover:bg-purple-700 block px-3 py-2 rounded-md text-base font-medium">Projects</a>
            <a href="#"
                class="text-gray-200 hover:bg-purple-700 block px-3 py-2 rounded-md text-base font-medium">Contact</a>
        </div>
    </div>
</nav>
