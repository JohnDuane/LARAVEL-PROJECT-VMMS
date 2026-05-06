 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     @vite(['resources/css/app.css'])

</head>
    @include('layouts.logout')
<body class="bg-[#232323] text-white">
    @include('layouts.sidenav')

<main class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-white mb-1">Job Orders</h1>
        <p class="text-sm text-gray-400">Manage and track all service records</p>
<div class="max-w-7xl mx-auto pt-5 space-y-4">


    	<!-- 🔍 Search -->
<div class="relative">
    <input 
        type="text"
        id="searchHistory"
        placeholder="Search job orders..."
        onkeyup="filterHistory()"
        class="w-full bg-[#1a1a1a] border border-gray-700 text-gray-200 
               rounded-xl pl-10 pr-4 py-2.5 text-sm 
               focus:ring-2 focus:ring-orange-500 outline-none"
    />
    
    <span class="absolute left-3 top-2.5 text-gray-500 text-sm">
        🔍
    </span>
</div>


<!-- 📦 Table Container -->
<div class="overflow-hidden rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">

<div class="h-[420px] overflow-y-auto no-scrollbar">

    <table class="w-full text-sm text-left text-gray-300">

      <!-- Header -->
      <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
        <tr>
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Customer</th>
          <th class="px-4 py-3">Plate</th>
          <th class="px-4 py-3">Make</th>
          <th class="px-4 py-3">Mechanic</th>
          <th class="px-4 py-3">Status</th>
          <th class="px-4 py-3">Date</th>
        </tr>
      </thead>

      <!-- Body -->
      <tbody id="historyTable" class="divide-y divide-gray-700">

        @foreach($data as $v)
        <tr 
          onclick="selectJob({{ $v->job_order_id }}, this)"
          class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer">

          <td class="px-4 py-4 text-gray-400">
            {{ $v->job_order_id }}
          </td>

          <td class="px-4 py-4 text-white font-medium customer">
            {{ $v->cust_name }}
          </td>

          <td class="px-4 py-4 text-gray-300 plate">
            {{ $v->plate_number }}
          </td>

          <td class="px-4 py-4 text-gray-300 make">
            {{ $v->make }}
          </td>

          <td class="px-4 py-4 text-gray-300 mechanic">
            {{ $v->mechanic_name }}
          </td>

          <!-- 🔥 STATUS BADGE -->
          <td class="px-4 py-4">
            @if($v->status == 'completed')
              <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs font-medium">
                Completed
              </span>
            @elseif($v->status == 'pending')
              <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs font-medium">
                Pending
              </span>
            @else
              <span class="bg-gray-500/20 text-gray-300 px-2 py-1 rounded-full text-xs font-medium">
                {{ $v->status }}
              </span>
            @endif
          </td>

          <td class="px-4 py-4 text-gray-400">
            {{ $v->date_issued }}
          </td>


        </tr>
        @endforeach

      </tbody>

    </table>

  </div>
</div>

</div>

<div class="flex justify-end gap-3 mt-6">

    <!-- PRINT BUTTON -->
    <button onclick="printJobOrder()"
        class="bg-[#ff8800] hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        Print Job Order
    </button>

    <!-- PLACEHOLDER BUTTON 1 -->
    <button
        class="bg-[#ff8800] hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        View Customer Vehicles
    </button>

    <!-- PLACEHOLDER BUTTON 2 -->
    <button
        class="bg-[#ff8800] hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
        View Parts
    </button>

</div>
</main>

<script>
let selectedJobId = null;

function selectJob(id, el) {
    selectedJobId = id;

    document.querySelectorAll("#historyTable tr").forEach(row => {
        row.classList.remove("bg-orange-500/20", "border-l-4", "border-orange-500");
    });

    el.classList.add("bg-orange-500/20", "border-l-4", "border-orange-500");
}

function printJobOrder() {
    if (!selectedJobId) {
        alert("Please select a job order first!");
        return;
    }

    window.open(`/job-order/pdf/${selectedJobId}`, "_blank");
}

function filterHistory() {
  let input = document.getElementById("searchHistory").value.toLowerCase().trim();
  let rows = document.querySelectorAll("#historyTable tr");

  rows.forEach(row => {
    let customer = row.querySelector(".customer")?.textContent.toLowerCase() || "";
    let plate = row.querySelector(".plate")?.textContent.toLowerCase() || "";
    let make = row.querySelector(".make")?.textContent.toLowerCase() || "";
    let mechanic = row.querySelector(".mechanic")?.textContent.toLowerCase() || "";

    if (input === "") {
      row.style.display = "";
      return;
    }

    if (
      customer.includes(input) ||
      plate.includes(input) ||
      make.includes(input) ||
      mechanic.includes(input)
    ) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
</script>
</body>
</html>