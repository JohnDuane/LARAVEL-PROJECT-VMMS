<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
    @include('layouts.logout')
<body>
    @include('layouts.sidenav')
    <main class="flex-1 p-6 min-h-screen">
        <!-- Header + Sort -->
    <div class="flex items-center gap-3 mb-4">
      <span class="text-white font-semibold text-sm">Recent:</span>
      <div class="relative">
        <select class="appearance-none bg-[#1a1a1a] border border-gray-600 text-white text-sm rounded-md pl-3 pr-7 py-1 focus:outline-none cursor-pointer">
          <option>Recent</option>
          <option>Oldest</option>
          <option>A - Z</option>
          <option>Z - A</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"/>
          </svg>
        </div>
      </div>
    </div>
 
    <!-- Vehicle List -->
    <div class="flex flex-col gap-3">
 
      <button class="w-full bg-[#1a1a1a] hover:bg-[#252525] text-white text-sm font-medium text-left px-8 py-8 rounded-xl transition-colors">
        2006 Lamborghini Huracan
      </button>

        <button class="w-full bg-[#1a1a1a] hover:bg-[#252525] text-white text-sm font-medium text-left px-8 py-8 rounded-xl transition-colors">
            2015 Porsche 911 GT3
        </button>
 
    </div>
    </main>
</body>
</html>