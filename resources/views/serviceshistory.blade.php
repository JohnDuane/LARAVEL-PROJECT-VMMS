@php
use Illuminate\Support\Str;
@endphp
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     @vite(['resources/css/app.css'])

</head>
    @include('layouts.logout')
<body class="text-white">
    @include('layouts.sidenav')

<main class="flex-1 p-8 pb-7">
        <div>
            <h1 class="text-3xl font-bold text-white leading-tight">
                Job Orders
            </h1>

            <p class="text-sm text-gray-400 mt-1">
                Manage and track all service records
            </p>
        </div>
<div class="max-w-7xl mx-auto pt-5 space-y-4">


    	<!-- 🔍 Search -->
<div class="relative mb-2">
    <input 
        type="text"
        id="searchHistory"
        placeholder="Search customer, plate, make, mechanic..."
        onkeyup="filterHistory()"
        class="w-full bg-[#181818] border border-gray-700/70 
               text-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm
               focus:ring-2 focus:ring-orange-500 
               focus:border-orange-500 outline-none transition"
    />

    <span class="absolute left-4 top-3 text-gray-500">
        🔍
    </span>
</div>


<!-- 📦 Table Container -->
<div class="overflow-hidden rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">
  
<div class="h-[420px] overflow-y-auto no-scrollbar">

    <table class="w-full text-sm text-left text-gray-300">

      <!-- Header -->
      <thead class="bg-[#242424] text-gray-500 uppercase text-[11px] tracking-wider sticky top-0 z-10">
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
      <tbody id="historyTable">

      <tr id="noResults" class="hidden">
          <td colspan="7" class="text-center py-6 text-gray-400">
              No results found
          </td>
      </tr>

      @foreach($data->groupBy('cust_name') as $customerName => $jobs)

          <!-- 🔶 CUSTOMER HEADER -->
          <tr class="bg-[#222222] hover:bg-[#2c2c2c] transition-all duration-150 cursor-pointer border-b border-gray-800"
              data-customer="{{ Str::slug($customerName) }}"
              onclick="toggleCustomer('{{ Str::slug($customerName) }}')">

              <td colspan="7" class="px-6 py-5">

                  <div class="flex justify-between items-center">

                      <div>
                          <p class="text-white font-semibold text-base">
                              {{ $customerName }}
                          </p>

                          <p class="text-gray-500 text-xs mt-1">
                              {{ count($jobs) }} Job Order{{ count($jobs) > 1 ? 's' : '' }}
                          </p>
                      </div>

                      <div class="text-gray-500 text-xs">
                          View Job Orders
                      </div>

                  </div>

              </td>
          </tr>

          <!-- 🔻 JOB ORDERS -->
          @foreach($jobs as $v)

          <tr
              onclick="selectJob({{ $v->job_order_id }}, this)"
              class="job-row customer-{{ Str::slug($customerName) }} hidden
              bg-[#1b1b1b] hover:bg-[#292929]
              transition duration-150 cursor-pointer border-b border-gray-800">

              <td class="px-6 py-4 text-sm text-gray-400">
                  {{ $v->job_order_id }}
              </td>

              <td class="px-6 py-4 text-sm text-white font-medium customer">
                  {{ $v->cust_name }}
              </td>

              <td class="px-6 py-4 text-sm text-gray-300 plate">
                  {{ $v->plate_number }}
              </td>

              <td class="px-6 py-4 text-sm text-gray-300 make">
                  {{ $v->make }}
              </td>

              <td class="px-6 py-4 text-sm text-gray-300 mechanic">
                  {{ $v->mechanic_name }}
              </td>

              <td class="px-6 py-4 text-sm">
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

              <td class="px-6 py-4 text-sm text-gray-400">
                  {{ $v->date_issued }}
              </td>

          </tr>

          @endforeach

      @endforeach

      </tbody>

    </table>

  </div>
</div>

</div>

<div class="flex justify-end gap-3 mt-6">

    <button onclick="printJobOrder()"
        class="bg-orange-500 hover:bg-orange-600
               text-white text-sm font-medium
               px-5 py-2.5 rounded-xl transition">
        Print Job Order
    </button>

    <button
        class="bg-[#2a2a2a] hover:bg-[#363636]
               border border-gray-700
               text-gray-200 text-sm font-medium
               px-5 py-2.5 rounded-xl transition">
        View Customer Vehicles
    </button>

    <button
        class="bg-[#2a2a2a] hover:bg-[#363636]
               border border-gray-700
               text-gray-200 text-sm font-medium
               px-5 py-2.5 rounded-xl transition">
        View Parts
    </button>

</div>
</main>

<script>
let selectedJobId = null;

function selectJob(id, el) {
    selectedJobId = id;

    document.querySelectorAll(".job-row").forEach(row => {
        row.classList.remove(
            "bg-orange-500/20",
            "border-l-4",
            "border-orange-500"
        );
    });

    el.classList.add(
        "bg-orange-500/20",
        "border-l-4",
        "border-orange-500"
    );
}

function printJobOrder() {
    if (!selectedJobId) {
        alert("Please select a job order first!");
        return;
    }

    window.open(`/job-order/pdf/${selectedJobId}`, "_blank");
}

function toggleCustomer(customerId) {
    let rows = document.querySelectorAll(".customer-" + customerId);

    rows.forEach(row => {
        row.classList.toggle("hidden");
    });
}

function filterHistory() {

    let input = document
        .getElementById("searchHistory")
        .value
        .toLowerCase();

    let headers = document.querySelectorAll("#historyTable tr[data-customer]");

    headers.forEach(header => {

        let customerId = header.dataset.customer;

        let jobRows = document.querySelectorAll(".customer-" + customerId);

        let found = false;

        // check customer header
        let headerText = header.textContent.toLowerCase();

        if (headerText.includes(input)) {
            found = true;
        }

        // check all job rows
        jobRows.forEach(row => {

            let rowText = row.textContent.toLowerCase();

            if (rowText.includes(input)) {
                found = true;
            }
        });

        // show/hide
        if (found) {

            header.style.display = "";

            jobRows.forEach(row => {
                row.style.display = "";
            });

        } else {

            header.style.display = "none";

            jobRows.forEach(row => {
                row.style.display = "none";
            });
        }

    });
}
</script>
</body>
</html>