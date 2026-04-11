
    <div class="flex h-screen">
        <aside class="w-64 flex flex-col" style="background-color: #232323">
            
            <img class="my-5 mx-11" style="width: 160px; height: 85px;" src="{{ asset('images/HEAD-LOGO-LIGHT.png') }}" alt="Logo">

            <nav style="font-size: 20px; font-weight:bold" class="text-BSAPri flex-grow text-center space-y-2 font-poppins">
                <a href="#" class="mt-25 block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 hover:text-white bg-olive-50/0">
                    Dashboard
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    Projects
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    Team
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    Reports
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-600">
                    Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 p-10 overflow-y-auto">
            <h1 class="text-3xl font-semibold text-gray-800">Welcome Back</h1>
            <p class="mt-4 text-gray-600">This is where your main dashboard content would go.</p>
        </main>
    </div>
