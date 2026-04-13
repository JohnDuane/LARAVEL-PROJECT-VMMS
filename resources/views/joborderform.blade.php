<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center p-8" style="background: linear-gradient(135deg, #c45c00 0%, #8b3a00 60%, #3a1a00 100%);">
    <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-2xl">
    <h2 class="text-white text-lg font-medium mb-6">Job Order/Repair Estimate</h2>
 
    <!-- Row 1: Customer & Make -->
    <div class="grid grid-cols-2 gap-x-6 gap-y-3 mb-3">
      <div>
        <label class="block text-sm text-gray-400 mb-1">Customer</label>
        <input type="text" placeholder="John Duane Aranda"
          class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
      </div>
      <div>
        <label class="block text-sm text-gray-400 mb-1">Make</label>
        <input type="text"
          class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
      </div>
 
      <!-- Row 2: Contact & Plate -->
      <div>
        <label class="block text-sm text-gray-400 mb-1">Contact</label>
        <input type="text"
          class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
      </div>
      <div>
        <label class="block text-sm text-gray-400 mb-1">Plate</label>
        <input type="text"
          class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
      </div>
    </div>
 
    <!-- Date Received -->
    <div class="mb-5">
      <label class="block text-sm text-gray-400 mb-1">Date Received</label>
      <input type="date" value="2025-12-17"
        class="bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>
 
    <!-- Bottom Two Columns -->
    <div class="grid grid-cols-2 gap-6">
 
      <!-- Left: Job Description + Parts/Materials -->
      <div class="flex flex-col gap-3">
        <div>
          <label class="block text-sm text-gray-400 mb-1">Job Description</label>
          <textarea rows="5"
            class="w-full bg-white border border-gray-400 text-gray-900 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500 resize-y"></textarea>
        </div>
        <div>
          <label class="block text-sm text-gray-400 mb-1">Parts/Materials</label>
          <textarea rows="5"
            class="w-full bg-white border border-gray-400 text-gray-900 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500 resize-y"></textarea>
        </div>
      </div>
 
      <!-- Right: Add Image + Items in Car -->
      <div class="flex flex-col gap-3">
        <div>
          <label class="block text-sm text-gray-400 mb-1">Add Image (Optional)</label>
          <div class="bg-[#f5f0e0] border border-gray-500 rounded-lg h-[120px] flex items-center justify-center cursor-pointer hover:border-orange-400 transition-colors">
            <div class="flex flex-col items-center gap-1">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.5">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
                <line x1="19" y1="5" x2="19" y2="11"/>
                <line x1="22" y1="8" x2="16" y2="8"/>
              </svg>
              <span class="text-xs text-gray-500">Click to upload</span>
            </div>
          </div>
        </div>
        <div>
          <label class="block text-sm text-gray-400 mb-1">Items in Car</label>
          <textarea rows="5"
            class="w-full bg-white border border-gray-400 text-gray-900 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500 resize-y"></textarea>
        </div>
      </div>
 
    </div>
 
    <!-- Buttons -->
    <div class="flex justify-end gap-3 mt-6">
      <button onclick="window.location.href='{{ route('usermygarage') }}'" class="border border-gray-400 text-gray-300 rounded-lg px-7 py-2 text-sm hover:bg-[#2a2a2a] transition-colors">
        Cancel
      </button>
      <button class="bg-orange-600 hover:bg-orange-500 text-white rounded-lg px-8 py-2 text-sm font-medium transition-colors">
        Add
      </button>
    </div>
 
  </div>
</body>
</html>