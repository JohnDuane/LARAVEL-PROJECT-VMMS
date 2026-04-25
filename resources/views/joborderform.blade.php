<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center p-8" style="background: linear-gradient(135deg, #c45c00 0%, #8b3a00 60%, #3a1a00 100%);">


@if(session('success'))
<script>
    if (confirm("Job order has been added!\n\nDo you want to save it as PDF?")) {
        window.open("{{ route('job-order.pdf', session('job_order_id')) }}", "_blank");
    }
</script>
@endif


<form action="{{ route('job-order.store') }}" method="POST">
@csrf

<input type="hidden" name="staff_id" id="mechanic_id">

<div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-2xl">
  <h2 class="text-white text-lg font-medium mb-6">Job Order/Repair Estimate</h2>

  <!-- Row 1 -->
  <div class="grid grid-cols-2 gap-x-6 gap-y-3 mb-3">
    
    <!-- Customers -->
<div class="overflow-hidden">
  <label class="block text-sm text-gray-400 mb-2 tracking-wide">Customers</label>

<input 
    type="text" 
    id="customerSearch"
    placeholder="Search customer..."
    onkeyup="filterCustomers()"
    class="w-full mb-2 bg-[#2a2a2a] border border-[#444] text-white px-3 py-2 rounded"
>

  <div style="scrollbar-width: none; -ms-overflow-style: none;" class="h-40 overflow-y-auto rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">
    <table class="w-full text-sm text-left text-gray-300">
      
      <!-- Header -->
      <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
        <tr>
          <th class="px-4 py-3 font-medium">ID</th>
          <th class="px-4 py-3 font-medium">Customer</th>
          <th class="px-4 py-3 text-center font-medium">Action</th>
        </tr>
      </thead>

      <!-- Body -->
      <tbody id="customerTableBody" class="divide-y divide-gray-700">
        @foreach($customers as $customer)
        <tr 
          class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
          onclick="selectCustomer('{{ $customer->id }}', '{{ $customer->cust_name }}')"
        >
          <td class="px-4 py-3 text-gray-400">{{ $customer->id }}</td>

          <td class="px-4 py-3 font-medium text-white">
            {{ $customer->cust_name }}
          </td>

          <td class="px-4 py-3 text-center">
            <button 
              type="button"
              onclick="event.stopPropagation(); selectCustomer('{{ $customer->id }}', '{{ $customer->cust_name }}')"
              class="px-3 py-1.5 text-xs font-semibold rounded-lg 
                     bg-orange-500 hover:bg-orange-600 
                     transition duration-150 shadow-md"
            >
              Select
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <input type="hidden" name="customer_id" id="customer_id">
</div>




    <!-- Cars -->
   <div>
  <label class="block text-sm text-gray-400 mb-2 tracking-wide">
    Cars
  </label>

  <input 
    type="text" 
    id="vehicleSearch"
    placeholder="Search plate or make..."
    onkeyup="filterVehicles()"
    class="w-full mb-2 bg-[#2a2a2a] border border-[#444] text-white px-3 py-2 rounded"
>

  <div style="scrollbar-width: none; -ms-overflow-style: none;" class="h-40 overflow-y-auto rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">
    <table class="w-full text-sm text-left text-gray-300">

      <!-- Header -->
      <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
        <tr>
          <th class="px-4 py-3 font-medium">Plate Number</th>
          <th class="px-4 py-3 font-medium">Make</th>
          <th class="px-4 py-3 text-center font-medium">Action</th>
        </tr>
      </thead>

      <!-- Body -->
      <tbody class="divide-y divide-gray-700" id="vehicleTableBody">
        @foreach($vehicles as $vehicle)
        <tr 
          class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
          onclick="event.stopPropagation(); selectVehicle('{{ $vehicle->vehicle_id }}', '{{ $vehicle->plate_number }}', '{{ $vehicle->make }}')"
          data-customer="{{ $vehicle->customer_id }}"
        >

          <td class="px-4 py-3 font-medium text-white">
            {{ $vehicle->plate_number }}
          </td>

          <td class="px-4 py-3 text-gray-300">
            {{ $vehicle->make }}
          </td>

          <td class="px-4 py-3 text-center">
            <button 
              type="button"
              onclick="event.stopPropagation(); selectVehicle('{{ $vehicle->vehicle_id }}')"
              class="px-3 py-1.5 text-xs font-semibold rounded-lg 
                     bg-orange-500 hover:bg-orange-600 
                     transition duration-150 shadow-md"
            >
              Select
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>

  <!-- Hidden input -->
  <input type="hidden" name="vehicle_id" id="vehicle_id">
</div>
  </div>

  <!-- Mechanic Dropdown -->
  <div class="mb-5">
    <label class="block text-sm text-gray-400 mb-1">Assign Mechanic</label>

    <div class="relative w-64">

      <input 
        type="text" 
        id="mechanic_input"
        onclick="toggleDropdown()"
        placeholder="Select or search mechanic"
        class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg pl-3 pr-10 py-2 text-sm"
      />

      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </div>

      <!-- ⚠️ STILL STATIC (you will replace this in STEP 5) -->
          
      <ul id="dropdown" class="absolute z-20 mt-1 w-full bg-[#2a2a2a] border border-[#444] rounded-lg shadow-xl max-h-48 overflow-y-auto hidden">  
      
      @foreach($mechanics as $mechanic)
            <li 
              class="px-3 py-2 text-sm text-gray-200 hover:bg-orange-600 cursor-pointer"
              onclick="selectMechanic('{{ $mechanic->staff_name }}', '{{ $mechanic->staff_id }}')"
            >
              {{ $mechanic->staff_name }}
            </li>
          @endforeach

      </ul>

    </div>
  </div>

  <!-- Bottom -->
  <div class="grid grid-row-2 gap-6">

    <div class="flex flex-col">
      <label class="block text-sm text-gray-400 mb-1">Services</label>
      <div class="bg-zinc-900 text-white rounded-xl p-4 w-full shadow-lg mt-4">

    <!-- TABLE -->
    <table class="w-full text-sm">
        <thead class="border-b border-zinc-700 text-zinc-400">
            <tr>
                <th class="py-2 text-left">SERVICE</th>
                <th>PRICE</th>
                <th></th>
            </tr>
        </thead>

        <tbody id="servicesTableBody">
            <!-- dynamic rows -->
        </tbody>
    </table>

    <!-- ADD SERVICE -->
    <div class="grid grid-cols-3 gap-3 items-center mt-4">

        <div class="relative w-full">

            <input 
                type="text" 
                id="service_input"
                onclick="toggleServiceDropdown()"
                placeholder="Select or search service"
                class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"
            />

            <ul id="serviceDropdown"
                class="absolute z-20 mt-1 w-full bg-[#2a2a2a] border border-[#444] rounded-lg shadow-xl max-h-48 overflow-y-auto hidden">

                @foreach($services as $service)
                    <li 
                        class="px-3 py-2 text-sm text-gray-200 hover:bg-green-600 cursor-pointer"
                        onclick="selectService('{{ $service->service_id }}', '{{ $service->job_desc }}', '{{ $service->price }}')"
                    >
                        {{ $service->job_desc }} - ₱{{ $service->price }}
                    </li>
                @endforeach

            </ul>
        </div>

        <input type="hidden" id="service_id">
        <input type="hidden" id="service_price">

        <div class="text-zinc-500 text-sm">auto</div>

        <button type="button" onclick="addServiceRow()"
            class="bg-green-500 hover:bg-green-600 text-white rounded px-3 py-1">
            +
        </button>
    </div>

    <!-- FOOTER -->
    <div class="flex justify-end mt-4 text-sm">
        <p class="text-white font-semibold">
            Services subtotal ₱<span id="servicesSubtotal">0.00</span>
        </p>

    </div>



</div>
    </div>

  </div>


  <div class="bg-zinc-900 text-white rounded-xl p-4 w-full max-w-4xl shadow-lg">

    <!-- TABLE -->
    <table class="w-full text-sm">
        <thead class="border-b border-zinc-700 text-zinc-400">
            <tr>
                <th class="py-2 text-left">PART NAME</th>
                <th>QTY USED</th>
                <th>UNIT COST</th>
                <th>AMOUNT</th>
                <th></th>
            </tr>
        </thead>

        <tbody id="partsTableBody">
            <!-- EMPTY BY DEFAULT -->
        </tbody>
    </table>

    <!-- ADD ROW -->
    <div class="grid grid-cols-5 gap-3 items-center mt-4">

        <!-- 🔥 DYNAMIC PARTS -->
        <div class="relative w-full">

            <input 
                type="text" 
                id="part_input"
                onclick="togglePartDropdown()"
                placeholder="Select or search part"
                class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"
            />

            <ul id="partDropdown"
                class="absolute z-20 mt-1 w-full bg-[#2a2a2a] border border-[#444] rounded-lg shadow-xl max-h-48 overflow-y-auto hidden">

                @foreach($parts as $part)
                    <li 
                        class="px-3 py-2 text-sm text-gray-200 hover:bg-orange-600 cursor-pointer"
                        onclick="selectPartDropdown('{{ $part->part_id }}', '{{ $part->part_name }}', '{{ $part->price }}', '{{ $part->stock }}')"
                    >
                        {{ $part->part_name }} (Stock: {{ $part->stock }})
                    </li>
                @endforeach

            </ul>
        </div>

        <input type="hidden" id="part_id_selected">
        <input type="hidden" id="part_price">
        <input type="hidden" id="part_stock">

        <!-- QTY -->
        <input type="number" id="qtyInput" placeholder="Qty"
            class="bg-zinc-800 border border-zinc-700 rounded px-2 py-1 w-16">

        <!-- AUTO -->
        <div class="text-zinc-500 text-sm">auto</div>
        <div class="text-zinc-500 text-sm">auto</div>

        <!-- ADD -->
        <button type="button" onclick="addPartRow()"
            class="bg-orange-500 hover:bg-orange-600 text-white rounded px-3 py-1">
            +
        </button>
    </div>

    <!-- FOOTER -->
    <div class="flex justify-between items-center mt-4 text-sm text-zinc-400">
        <p>Parts are pulled from database. Quantity cannot exceed stock.</p>
        <p class="text-white font-semibold">
            Parts subtotal ₱<span id="partsSubtotal">0.00</span>
        </p>

    </div>
        
</div>



    <div class="grid grid-cols-2 gap-4 mt-4">

  <!-- Date Issued -->
  <div>
    <label class="text-sm text-gray-400">Date Issued</label>
    <input type="date" name="date_issued"
      class="w-full bg-[#2a2a2a] border border-[#444] text-white rounded px-2 py-1" required>
  </div>

  <!-- Status -->
  <input type="hidden" name="status" value="Pending">

</div>

    <div class="flex justify-end mt-6">
        <p class="text-green-400 font-bold mt-2">
            Total Cost ₱<span id="totalCost">0.00</span>
        </p>
        
        <input type="hidden" name="total_cost" id="total_cost">
    </div>
        

  <!-- Buttons -->
  <div class="flex justify-end gap-3 mt-6">
    <button type="button" onclick="window.location.href='/userdash'" class="border border-gray-400 text-gray-300 rounded-lg px-7 py-2 text-sm">
      Cancel
    </button>

    <button type="submit" class="bg-orange-600 text-white rounded-lg px-8 py-2 text-sm">
      Add
    </button>
  </div>

</div>
</form>

</body>
</html>

<script>
function toggleDropdown() {
    document.getElementById('dropdown').classList.toggle('hidden');
}

function selectMechanic(name, id) {
    document.getElementById('mechanic_input').value = name;
    document.getElementById('mechanic_id').value = id;

    document.getElementById('dropdown').classList.add('hidden');
}

// close if click outside
document.addEventListener('click', function(e) {
    let input = document.getElementById('mechanic_input');
    let dropdown = document.getElementById('dropdown');

    if (!input.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});

let partsSubtotal = 0;

function addPartRow() {
    const partId = document.getElementById("part_id_selected").value;
    const partName = document.getElementById("part_input").value;
    const price = parseFloat(document.getElementById("part_price").value);
    const stock = parseInt(document.getElementById("part_stock").value);
    const qty = parseInt(document.getElementById("qtyInput").value);

    if (!partId || !qty || qty <= 0) {
        alert("Select part and valid quantity");
        return;
    }

    if (qty > stock) {
        alert("❌ Not enough stock!\nAvailable: " + stock);
        return;
    }

    const amount = price * qty;
    partsSubtotal += amount;

    const row = `
        <tr class="border-b border-zinc-700">
            <td>
                ${partName}
                <input type="hidden" name="parts[]" value="${partId}">
            </td>
            <td>
                <input type="number" name="qty[]" value="${qty}"
                    class="bg-zinc-800 w-16 px-2 py-1">
            </td>
            <td>₱${price.toFixed(2)}</td>
            <td>₱${amount.toFixed(2)}</td>
            <td>
                <button type="button" onclick="removePartRow(this, ${amount})"
                    class="text-red-500">✕</button>
            </td>
        </tr>
    `;

    document.getElementById("partsTableBody")
        .insertAdjacentHTML("beforeend", row);

    updateSubtotal();
    updateTotalCost();

    document.getElementById("part_input").value = "";
    document.getElementById("qtyInput").value = "";
}

function removePartRow(btn, amount) {
    btn.closest("tr").remove();
    partsSubtotal -= amount;
    updateSubtotal();
    updateTotalCost();
}

function updateSubtotal() {
    document.getElementById("partsSubtotal")
        .innerText = partsSubtotal.toFixed(2);
}


function selectCustomer(id, name) {
    document.getElementById('customer_id').value = id;

    const input = document.getElementById("customerSearch");

    // ✅ CLEAR TEXT + SET PLACEHOLDER
    input.value = "";
    input.placeholder = name;

    // FILTER VEHICLES
    document.querySelectorAll('[data-customer]').forEach(row => {
        row.style.display = (row.getAttribute('data-customer') == id) ? '' : 'none';
    });

    // highlight
    document.querySelectorAll("#customerTableBody tr").forEach(row => {
        row.classList.remove("bg-gray-600");
    });

    event.currentTarget.classList.add("bg-gray-600");
}

function selectVehicle(id, plate, make) {
    document.getElementById('vehicle_id').value = id;

    const input = document.getElementById("vehicleSearch");

    // ✅ SET PLACEHOLDER
    input.value = "";
    input.placeholder = plate + " - " + make;

    // highlight
    document.querySelectorAll("#vehicleTableBody tr").forEach(r => {
        r.classList.remove("bg-gray-600");
    });
}

let servicesSubtotal = 0;

function addServiceRow() {
    const serviceId = document.getElementById("service_id").value;
    const serviceName = document.getElementById("service_input").value;
    const price = parseFloat(document.getElementById("service_price").value);

    if (!serviceId) {
        alert("Select a service");
        return;
    }

    servicesSubtotal += price;

    const row = `
        <tr class="border-b border-zinc-700">
            <td>
                ${serviceName}
                <input type="hidden" name="services[]" value="${serviceId}">
            </td>

            <td>₱${price.toFixed(2)}</td>

            <td>
                <button type="button" onclick="removeServiceRow(this, ${price})"
                    class="text-red-500">✕</button>
            </td>
        </tr>
    `;

    document.getElementById("servicesTableBody")
        .insertAdjacentHTML("beforeend", row);

    updateServiceSubtotal();
    updateTotalCost();

    document.getElementById("service_input").value = "";
}

function removeServiceRow(btn, price) {
    btn.closest("tr").remove();
    servicesSubtotal -= price;
    updateServiceSubtotal();
    updateTotalCost();
}

function updateServiceSubtotal() {
    document.getElementById("servicesSubtotal")
        .innerText = servicesSubtotal.toFixed(2);
}

function updateTotalCost() {
    let total = partsSubtotal + servicesSubtotal;

    document.getElementById("totalCost").innerText = total.toFixed(2);
    document.getElementById("total_cost").value = total.toFixed(2);
}


document.getElementById("mechanic_input").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let items = document.querySelectorAll("#dropdown li");

    items.forEach(item => {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(input) ? "" : "none";
    });
});



//service drop down logic
function toggleServiceDropdown() {
    document.getElementById('serviceDropdown').classList.toggle('hidden');
}

function selectService(id, name, price) {
    document.getElementById('service_input').value = name;
    document.getElementById('service_id').value = id;
    document.getElementById('service_price').value = price;

    document.getElementById('serviceDropdown').classList.add('hidden');
}

// SEARCH
document.getElementById("service_input").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let items = document.querySelectorAll("#serviceDropdown li");

    items.forEach(item => {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(input) ? "" : "none";
    });
});


//part drop down logic
function togglePartDropdown() {
    document.getElementById('partDropdown').classList.toggle('hidden');
}

function selectPartDropdown(id, name, price, stock) {
    document.getElementById('part_input').value = name;
    document.getElementById('part_id_selected').value = id;
    document.getElementById('part_price').value = price;
    document.getElementById('part_stock').value = stock;

    document.getElementById('partDropdown').classList.add('hidden');
}

// SEARCH
document.getElementById("part_input").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let items = document.querySelectorAll("#partDropdown li");

    items.forEach(item => {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(input) ? "" : "none";
    });
});



function filterCustomers() {
    let input = document.getElementById("customerSearch").value.toLowerCase();
    let rows = document.querySelectorAll("#customerTableBody tr");

    rows.forEach(row => {
        let name = row.children[1].textContent.toLowerCase();
        row.style.display = name.includes(input) ? "" : "none";
    });
}

function filterVehicles() {
    let input = document.getElementById("vehicleSearch").value.toLowerCase();
    let rows = document.querySelectorAll("#vehicleTableBody tr");

    rows.forEach(row => {
        let plate = row.children[0].textContent.toLowerCase();
        let make = row.children[1].textContent.toLowerCase();

        row.style.display = (plate.includes(input) || make.includes(input)) ? "" : "none";
    });
}

</script>



