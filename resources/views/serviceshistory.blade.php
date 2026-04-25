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
        <h1 class="text-3xl font-bold text-white">Job Order Records</h1>
<div class="max-w-7xl mx-auto pt-5 space-y-4">
    	<!-- 🔍 Search -->
<input 
  type="text" 
  id="searchHistory"
  placeholder="Search customer, plate, make, or mechanic..."
  onkeyup="filterHistory()"
  class="mb-3 w-full bg-[#1f1f1f] border border-gray-700 text-gray-200 
         rounded-xl px-4 py-2.5 text-sm 
         focus:outline-none focus:ring-2 focus:ring-orange-500"
/>

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
        <tr class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
            onclick="selectJob({{ $v->job_order_id }})">

          <td class="px-4 py-3 text-gray-400">
            {{ $v->job_order_id }}
          </td>

          <td class="px-4 py-3 text-white font-medium customer">
            {{ $v->cust_name }}
          </td>

          <td class="px-4 py-3 text-gray-300 plate">
            {{ $v->plate_number }}
          </td>

          <td class="px-4 py-3 text-gray-300 make">
            {{ $v->make }}
          </td>

          <td class="px-4 py-3 text-gray-300 mechanic">
            {{ $v->mechanic_name }}
          </td>

          <!-- 🔥 STATUS BADGE -->
          <td class="px-4 py-3">
            @if($v->status == 'completed')
              <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">
                Completed
              </span>
            @elseif($v->status == 'pending')
              <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">
                Pending
              </span>
            @else
              <span class="bg-gray-500/20 text-gray-300 px-2 py-1 rounded-full text-xs">
                {{ $v->status }}
              </span>
            @endif
          </td>

          <td class="px-4 py-3 text-gray-400">
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

function selectJob(id) {
    selectedJobId = id;

    document.querySelectorAll("tr").forEach(row => {
        row.classList.remove("bg-gray-600");
    });

    event.currentTarget.classList.add("bg-gray-600");
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