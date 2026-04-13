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

        <h1 class="pb-4 text-3xl font-bold text-white">Cars in the Garage</h1>

        
    <!-- Vehicle Card -->
    <div class="bg-[#1a1a1a] rounded-xl flex items-center gap-3 p-3 mb-5 relative">
 
      <!-- Car Image -->
      <div class="w-24 h-16 rounded-lg overflow-hidden flex-shrink-0">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/ninth/Lamborghini_Huracan_LP_610-4_%28colour_corrected%29.jpg/320px-Lamborghini_Huracan_LP_610-4_%28colour_corrected%29.jpg"
          alt="Lamborghini Huracan"
          class="w-full h-full object-cover"
          onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center\'><svg width=\'32\' height=\'32\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'#888\' stroke-width=\'1.5\'><rect x=\'1\' y=\'7\' width=\'22\' height=\'11\' rx=\'2\'/><path d=\'M5 7V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2\'/><circle cx=\'7\' cy=\'18\' r=\'2\'/><circle cx=\'17\' cy=\'18\' r=\'2\'/></svg></div>'"
        />
      </div>
 
      <!-- Info -->
      <div class="flex-1 min-w-0">
        <p class="text-white font-semibold text-sm mb-1">2006 Lamborghini Huracan</p>
        <p class="text-gray-400 text-xs">Customer: <span class="text-gray-300"></span></p>
        <p class="text-gray-400 text-xs">Contact: <span class="text-gray-300"></span></p>
        <p class="text-gray-400 text-xs">Plate No: <span class="text-gray-300"></span></p>
      </div>
 
      <!-- Actions -->
      <div class="flex flex-col items-center gap-3 flex-shrink-0">
        <!-- Checkmark -->
        <button class="text-white hover:text-green-400 transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </button>
        <!-- Delete -->
        <button class="text-red-500 hover:text-red-400 transition-colors">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
            <path d="M10 11v6"/>
            <path d="M14 11v6"/>
            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
          </svg>
        </button>
      </div>
 
    </div>
 
    <!-- Add Car Button -->
    <div class="flex justify-center">
      <button class="bg-orange-500 hover:bg-orange-400 text-white text-sm font-medium rounded-full px-8 py-2 transition-colors">
        Add Car
      </button>
    </div>
 

    </main> 
        
</body>
</html>