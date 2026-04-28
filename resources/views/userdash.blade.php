<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])

</head>
    @include('layouts.logout')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <canvas id="jobOrdersChart" class="w-full h-40"></canvas> -->


<body>
    @include('layouts.sidenav')

    <main class="flex-1 p-6 min-h-screen">
        <h1 class="text-3xl font-bold text-white mb-[9px]">Dashboard</h1>
       

  <!-- Main Card -->
  <div class="bg-zinc-900 rounded-2xl p-4 md:p-6 shadow-lg">

    <h2 class="text-white text-lg md:text-xl font-semibold mb-4">
      Job Orders Growth (Weekly)
    </h2>

    <!-- ✅ GRAPH INSIDE CARD -->
      <div class-"h-56">
        <canvas id="jobOrdersChart"></canvas>
      </div>
  </div>

  <!-- Stats -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">

    <button onclick="window.location.href='/viewcustomervehicles'"
      class="bg-zinc-900 text-white rounded-xl p-4 flex items-center gap-3 shadow-md hover:bg-zinc-800 transition w-full text-left">

      <img src="{{ asset('icons/mdi_car.png') }}" alt="">
        <div>
          <p class="text-xs text-gray-400">Total Vehicles</p>
          <p class="text-lg font-semibold">{{ $totalVehicles }}</p>
          <p class="text-xs text-gray-500">Active in System</p>
        </div>
      </button>

      <button 
        class="bg-zinc-900 text-white rounded-xl p-4 flex items-center gap-3 shadow-md hover:bg-zinc-800 transition w-full text-left">

        <img src="{{ asset('icons/mdi_calendar.png') }}" alt="">
          <div>
            <p class="text-xs text-gray-400">Job Orders</p>
            <p class="text-lg font-semibold">{{ $totalJobOrders }}</p>
            <p class="text-xs text-gray-500">On The System</p>
          </div>
      </button>

      <button onclick="window.location.href='/reminders'" 
        class="bg-zinc-900 text-white rounded-xl p-4 flex items-center gap-3 shadow-md hover:bg-zinc-800 transition w-full text-left">

        <img src="{{ asset('icons/material-symbols_warning.png') }}" alt="">
        <div>
          <p class="text-xs text-gray-400">Alerts / Reminders</p>

              <div class="flex items-center gap-2">
                  <!-- Total -->
                  <p class="text-lg font-semibold text-white">
                    {{ $totalAlerts }}
                  </p>

                </div>
          <p class="text-xs text-gray-500">
            {{ $overdueCount }} overdue • {{ $pendingCount }} pending
          </p>

        </div>
      </button>

  </div>

  <!-- Quick Actions -->
  <h2 class="text-white text-lg font-semibold mt-6 mb-3">
    Quick Actions
  </h2>

  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

    <button onclick="window.location.href='/joborderform'" class="bg-zinc-900 text-white rounded-xl p-6 flex flex-col items-center justify-center shadow-md hover:bg-zinc-800 transition">
      <span class="text-2xl">➕</span>
      <span class="text-sm mt-2">Add Job Order</span>
    </button>

    <button onclick="window.location.href='/addsupplier'" class="bg-zinc-900 text-white rounded-xl p-6 flex flex-col items-center justify-center shadow-md hover:bg-zinc-800 transition">
      <span class="text-2xl">🖨️</span>
      <span class="text-sm mt-2">Add Supplier</span>
    </button>

    <button onclick="window.location.href='/addmechanic'" class="bg-zinc-900 text-white rounded-xl p-6 flex flex-col items-center justify-center shadow-md hover:bg-zinc-800 transition">
      <span class="text-2xl">✏️</span>
      <span class="text-sm mt-2">Add Mechanic</span>
    </button>

    <button onclick="window.location.href='/addservices'" class="bg-zinc-900 text-white rounded-xl p-6 flex flex-col items-center justify-center shadow-md hover:bg-zinc-800 transition">
      <span class="text-2xl">🗑️</span>
      <span class="text-sm mt-2">Add Services</span>
    </button>

  </div>

        
    </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('jobOrdersChart');

    if (!ctx) return; // safety check

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Job Orders',
                data: @json($data),
                borderColor: '#ff8800',
                borderWidth: 2,
                tension: 0.3,
                fill: false,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: '#fff' }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#ccc' }
                },
                y: {
                    ticks: { color: '#ccc' }
                }
            }
        }
    });

});
</script>


</body>
</html>