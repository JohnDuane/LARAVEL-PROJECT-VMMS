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

<main class="flex-1 p-6 min-h-screen">
        <h1 class="text-3xl font-bold text-white">Vehicles</h1>
<div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- LAMESA -->
  <div class="w-[60%]">
    <div class="mb-6">
  

  <!-- SEARCH TAGIL -->
  <input 
    type="text"
    id="searchVehicle"
    placeholder="Search by plate or make..."
    onkeyup="filterVehicles()"
    class="w-full mb-3 bg-[#1f1f1f] border border-gray-700 text-gray-200 
           rounded-xl px-4 py-2.5 text-sm 
           focus:outline-none focus:ring-2 focus:ring-orange-500"
  />

  <!-- TABLE NIYA HASHHSHASHAHS -->
  <div style="scrollbar-width: none; -ms-overflow-style: none;" class="h-[420px] overflow-y-auto no-scrollbar rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">
    
    <table class="w-full text-sm text-left text-gray-300">

      <!-- Header -->
      <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
        <tr>
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Plate</th>
          <th class="px-4 py-3">Make</th>
          <th class="px-4 py-3">Engine</th>
        </tr>
      </thead>

      <!-- LAWAS -->
      <tbody id="vehicleTable" class="divide-y divide-gray-700">
        @foreach($vehicles as $v)
        <tr 
          class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
          onclick="selectRow({{ $v->vehicle_id }}, '{{ $v->plate_number }}', '{{ $v->make }}', '{{ $v->engine_model }}', {{ $v->customer_id }})"
        >
          <td class="px-4 py-3 text-gray-400">{{ $v->vehicle_id }}</td>
          <td class="px-4 py-3 text-white font-medium">{{ $v->plate_number }}</td>
          <td class="px-4 py-3">{{ $v->make }}</td>
          <td class="px-4 py-3">{{ $v->engine_model }}</td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>
  </div>
    <!-- FORM 137 -->
  <div class="w-[40%]">
  <form id="vehicleForm" method="POST">
  @csrf

  <input type="hidden" id="vehicle_id">

  <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <h2 class="text-white text-lg font-medium mb-6">Add/Edit Vehicle</h2>


    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Plate Number</label>
        <input type="text" id="plate" name="plate_number" required
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>

    
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Make/Brand</label>
        <input type="text" id="make" name="make"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>

    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Engine Model</label>
        <input type="text" id="engine" name="engine_model"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>


    <label class="block text-sm text-gray-400 mb-1">Customer</label>
    <select name="customer_id" id="customer" required placeholder="Customer ID" class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500">
                <option value="">Select Customer</option>
                  @foreach($customers as $c)
                    <option value="{{ $c->id }}">
                      {{ $c->cust_name }}
                    </option>
                  @endforeach
    </select>

    <!-- Buttons -->
    <div class="flex justify-end gap-3 px-3 mt-5">

        <button type="button" onclick="addVehicle()"
            class="bg-[#ff8800] hover:bg-[#232323] text-white rounded-lg px-6 py-2 text-sm">
            Add
        </button>

	<button type="button" onclick="updateVehicle()"
            class="bg-[#ff8800] hover:bg-[#232323] text-white rounded-lg px-6 py-2 text-sm">
            Update
        </button>

	<button type="button" onclick="deleteVehicle()"
            class="bg-[#ff8800] hover:bg-[#232323] text-white rounded-lg px-6 py-2 text-sm">
            Delete
        </button>
    </div>

            </div>
        </form>
    </div>
</div>

</main>

<script>
let selectedId = null;

function selectRow(id, plate, make, engine, customerId) {
    selectedId = id;

    document.getElementById("vehicle_id").value = id;
    document.getElementById("plate").value = plate;
    document.getElementById("make").value = make;
    document.getElementById("engine").value = engine;

    document.getElementById("customer").value = customerId;
}

function addVehicle() {
    let form = document.getElementById("vehicleForm");
    form.action = "/vehicles/store";
    form.submit();

    selectedId = null;
}

function updateVehicle() {
    if (!selectedId) return alert("Select a row first");

    let form = document.getElementById("vehicleForm");
    form.action = "/vehicles/update/" + selectedId;
    form.submit();
}

function deleteVehicle() {
    if (!selectedId) return alert("Select a row first");

    let form = document.getElementById("vehicleForm");
    form.action = "/vehicles/delete/" + selectedId;
    form.submit();
}

function filterVehicles() {
  let input = document.getElementById("searchVehicle").value.toLowerCase();
  let rows = document.querySelectorAll("#vehicleTable tr");

  rows.forEach(row => {
    let plate = row.children[1].textContent.toLowerCase();
    let make = row.children[2].textContent.toLowerCase();

    if (plate.includes(input) || make.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
</script>


</body>
</html>