<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .accordion-content {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.3s ease-out;
        }

        .accordion-content.open {
            grid-template-rows: 1fr;
        }

        .accordion-inner {
            overflow: hidden;
        }

        .chevron {
            transition: transform 0.3s ease-out;
        }

        .chevron.rotate {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="flex h-screen overflow-hidden relative">

        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-gray-900/50 z-20 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:relative inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg shrink-0 border-r border-gray-200 dark:border-gray-700 flex flex-col z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div
                class="h-16 flex items-center justify-between px-6 border-b border-gray-200 dark:border-gray-700 shrink-0">
                <a href="{{ route('dashboard') }}"
                    class="font-bold text-xl text-indigo-600 dark:text-indigo-400 flex items-center gap-2">
                    <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
                    Admin Panel
                </a>
                <button id="close-sidebar"
                    class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-200 dark:hover:bg-gray-700 focus:outline-none">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <!-- Single Item -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <i data-lucide="home" class="w-5 h-5 mr-3 text-indigo-500"></i>
                    Dashboard
                </a>

                <!-- Multi-level Item 1 -->
                <div class="accordion-item mt-2">
                    <button
                        class="accordion-trigger w-full flex items-center justify-between px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition focus:outline-none">
                        <div class="flex items-center">
                            <i data-lucide="users" class="w-5 h-5 mr-3 text-indigo-500"></i>
                            <span>Users</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 chevron text-gray-500"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="accordion-inner">
                            <ul class="pl-11 pr-3 py-2 space-y-1">
                                <li>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:text-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-indigo-400 transition">All
                                        Users</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:text-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-indigo-400 transition">Admins</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Multi-level Item 2 -->
                <div class="accordion-item mt-1">
                    <button
                        class="accordion-trigger w-full flex items-center justify-between px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition focus:outline-none">
                        <div class="flex items-center">
                            <i data-lucide="settings" class="w-5 h-5 mr-3 text-indigo-500"></i>
                            <span>Settings</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 chevron text-gray-500"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="accordion-inner">
                            <ul class="pl-11 pr-3 py-2 space-y-1">
                                <li>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:text-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-indigo-400 transition">General</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:text-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-indigo-400 transition">Security</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden w-full">

            <!-- Header -->
            <header
                class="h-16 bg-white dark:bg-gray-800 shadow z-10 shrink-0 flex items-center justify-between px-4 lg:px-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <button id="open-sidebar"
                        class="lg:hidden p-2 mr-3 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-700 focus:outline-none">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    @isset($header)
                        <h2 class="font-semibold text-lg lg:text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ $header }}
                        </h2>
                    @endisset
                </div>

                <div class="relative">
                    <button id="profile-menu-btn"
                        class="flex items-center gap-2 p-1 focus:outline-none rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </span>
                        <i data-lucide="chevron-down"
                            class="w-4 h-4 text-gray-500 dark:text-gray-400 hidden sm:block"></i>
                    </button>

                    <!-- Dropdown -->
                    <div id="profile-dropdown"
                        class="absolute right-0 mt-3 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 border border-gray-200 dark:border-gray-700 hidden z-50">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Signed in as</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{
                                auth()->user()->email ?? 'admin@example.com' }}</p>
                        </div>

                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4 text-gray-500"></i>
                            Profile
                        </a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition flex items-center gap-2">
                            <i data-lucide="settings" class="w-4 h-4 text-gray-500"></i>
                            Settings
                        </a>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition flex items-center gap-2">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Scrollable Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900 p-4 lg:p-6">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer
                class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-4 lg:px-6 shrink-0 z-10">
                <div
                    class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-xs lg:text-sm text-gray-500 dark:text-gray-400">
                    <div class="mb-2 md:mb-0 text-center md:text-left">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                    <div class="space-x-4">
                        <a href="#" class="hover:text-gray-800 dark:hover:text-gray-200 transition">Privacy</a>
                        <a href="#" class="hover:text-gray-800 dark:hover:text-gray-200 transition">Terms</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts for Icons, Accordion and Mobile Sidebar -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Sidebar Logic
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');

            function toggleSidebar() {
                const isOpen = !sidebar.classList.contains('-translate-x-full');

                if (isOpen) {
                    // Close
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                    }, 300);
                } else {
                    // Open
                    overlay.classList.remove('hidden');
                    // Small delay to allow display:block to apply before opacity transition
                    setTimeout(() => {
                        overlay.classList.remove('opacity-0');
                        sidebar.classList.remove('-translate-x-full');
                    }, 10);
                }
            }

            openBtn.addEventListener('click', toggleSidebar);
            closeBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Accordion Logic
            const triggers = document.querySelectorAll('.accordion-trigger');

            triggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const content = trigger.nextElementSibling;
                    const chevron = trigger.querySelector('.chevron');

                    // Optional: Close other accordions when one is opened
                    document.querySelectorAll('.accordion-content').forEach(otherContent => {
                        if (otherContent !== content && otherContent.classList.contains('open')) {
                            otherContent.classList.remove('open');
                            const otherChevron = otherContent.previousElementSibling.querySelector('.chevron');
                            if (otherChevron) otherChevron.classList.remove('rotate');
                        }
                    });

                    // Toggle current accordion
                    content.classList.toggle('open');
                    chevron.classList.toggle('rotate');
                });
            });

            // Profile Dropdown Logic
            const profileBtn = document.getElementById('profile-menu-btn');
            const profileDropdown = document.getElementById('profile-dropdown');

            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                        profileDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>
