<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#232323] text-white">
    <main class="flex-1 p-6 min-h-screen">

<!-- 📦 Table -->
<div class="flex gap-6">

  <!-- LEFT SIDE (Job Orders) -->
  <div class="w-1/2">

    <!-- 🔍 Search -->
    <input 
      type="text" 
      id="searchJob"
      placeholder="Search customer or vehicle..."
      onkeyup="filterJobs()"
      class="mb-3 w-full bg-[#1f1f1f] border border-gray-700 text-gray-200 
             rounded-xl px-4 py-2.5 text-sm 
             focus:outline-none focus:ring-2 focus:ring-orange-500"
    />

    <!-- 📦 Table -->
    <div class="overflow-hidden rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">
      <div class="max-h-[180px] overflow-y-auto no-scrollbar">

        <table class="w-full text-sm text-left text-gray-300">

          <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
            <tr>
              <th class="px-4 py-3">ID</th>
              <th class="px-4 py-3">Customer</th>
              <th class="px-4 py-3">Vehicle</th>
              <th class="px-4 py-3 text-center">Action</th>
            </tr>
          </thead>

          <tbody id="jobTable" class="h-[230px] divide-y divide-gray-700">
            @foreach($jobOrders as $job)
            <tr class="hover:bg-[#2e2e2e] transition duration-150">
              <td class="px-4 py-3 text-gray-400">{{ $job->job_order_id }}</td>
              <td class="px-4 py-3 font-medium text-white customer-name">{{ $job->cust_name }}</td>
              <td class="px-4 py-3 text-gray-300 vehicle-name">{{ $job->make }}</td>
              <td class="px-4 py-3 text-center">
                <button 
                  onclick="selectJob({{ $job->job_order_id }}, '{{ $job->make }}')"
                  class="bg-[#ff8800] hover:bg-[#e67600] text-black 
                         px-3 py-1.5 text-xs font-semibold rounded-lg transition shadow-md">
                  Select
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>

        </table>

      </div>
    </div>

  </div>


  <!-- RIGHT SIDE (Reminders) -->
  <div class="w-1/2">

    <div class="bg-[#1f1f1f] p-4 rounded-xl border border-gray-700 h-full">

      <h2 class="text-lg font-semibold mb-3">All Reminders</h2>

      <div class="max-h-[240px] overflow-y-auto no-scrollbar">

        <table class="w-full text-sm text-gray-300">
          <thead class="text-gray-400 border-b border-gray-700 sticky top-0 bg-[#1f1f1f]">
            <tr>
              <th class="py-2">Job</th>
              <th>Description</th>
              <th>Due Date</th>
              <th>Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($reminders as $r)

            @php
              $isOverdue = \Carbon\Carbon::now()->gt($r->due_date) && $r->status == 'pending';
            @endphp

            <tr class="border-b border-gray-700 {{ $isOverdue ? 'bg-red-900/40' : '' }}">
              <td class="py-2">#{{ $r->job_order_id }}</td>
              <td>{{ $r->description }}</td>
              <td>{{ $r->due_date }}</td>

              <td>
                @if($r->status == 'completed')
                  <span class="text-green-400">Completed</span>
                @elseif($isOverdue)
                  <span class="text-red-400">Overdue</span>
                @else
                  <span class="text-yellow-400">Pending</span>
                @endif
              </td>

              <td class="text-center">
                @if($r->status != 'completed')
                <a href="/reminders/complete/{{ $r->id }}"
                  class="bg-green-600 px-2 py-1 rounded text-xs">
                  Done
                </a>
                @endif
              </td>
            </tr>

            @endforeach
          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>



<div class="mt-6 bg-zinc-900 p-4 rounded-xl text-white">

  <h2 class="text-lg font-semibold mb-3">Create Reminder</h2>

  <p id="selectedJobText">No job selected</p>

  <form action="/reminders/store" method="POST">
    @csrf

    <input type="hidden" name="job_order_id" id="job_order_id">

    <div class="mt-3">
      <label>Description</label>
      <input type="text" name="description"
        class="w-full bg-gray-800 p-2 rounded">
    </div>

    <div class="mt-3">
      <label>Due Date</label>
      <input type="date" name="due_date"
        class="w-full bg-gray-800 p-2 rounded">
    </div>

    <button type="submit"
      class="mt-4 bg-[#ff8800] px-4 py-2 rounded">
      Create Reminder
    </button>
  </form>
</div>


    </main>

</body>
</html>

<script>
function selectJob(id, vehicle) {
    document.getElementById('job_order_id').value = id;
    document.getElementById('selectedJobText').innerText =
        "Selected Job Order: #" + id + " - " + vehicle;
}


function filterJobs() {
  let input = document.getElementById("searchJob").value.toLowerCase().trim();
  let rows = document.querySelectorAll("#jobTable tr");

  rows.forEach(row => {
    let customer = row.querySelector(".customer-name")?.textContent.toLowerCase() || "";
    let vehicle = row.querySelector(".vehicle-name")?.textContent.toLowerCase() || "";

    // show all if empty
    if (input === "") {
      row.style.display = "";
      return;
    }

    if (customer.includes(input) || vehicle.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}


</script>

