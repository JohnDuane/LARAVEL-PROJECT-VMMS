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
        <h1 class="text-3xl font-bold text-white">Vehicles and Owners</h1>

<input 
  type="text" 
  id="searchMaster"
  placeholder="Search name, contact, or make..."
  onkeyup="filterMaster()"
  class="mt-3 mb-3 w-full bg-[#1f1f1f] border border-gray-700 text-gray-200 
         rounded-xl px-4 py-2.5 text-sm 
         focus:outline-none focus:ring-2 focus:ring-orange-500"
/>

<div class="overflow-hidden rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">

  <div class="max-h-[420px] overflow-y-auto no-scrollbar">
    <table class="w-full text-sm text-left text-gray-300">


      <!-- Body -->
      <tbody id="masterTable">

      <tr id="noResults" class="hidden">
          <td colspan="7" class="text-center py-6 text-gray-400">
              No results found
          </td>
      </tr>

        @foreach($customers as $customerId => $customerVehicles)

            <!-- 🔶 CUSTOMER HEADER ROW -->
            <tr class="bg-[#2a2a2a] hover:bg-[#333] transition cursor-pointer" 
                data-customer="{{ $customerId }}"
                onclick="toggleCustomer('{{ $customerId }}')">

            <td colspan="7" class="px-5 py-4">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-white font-semibold text-lg">
                            {{ $customerVehicles[0]->cust_name }}
                        </p>
                        <p class="text-gray-400 text-sm">
                            📞 {{ $customerVehicles[0]->contact_number }}
                        </p>
                    </div>

                    <div class="text-gray-400 text-xs">
                        Click to view vehicles
                    </div>

                </div>

            </td>
            </tr>

            <!-- 🔻 VEHICLES -->
           @foreach($customerVehicles as $v)
<tr class="vehicle-row customer-{{ $customerId }} hidden bg-[#1f1f1f]">
    <td colspan="7" class="px-6 py-3">

        <div class="grid grid-cols-4 gap-4 text-sm bg-[#262626] p-4 rounded-xl">

            <div>
                <p class="text-gray-400 text-xs">Plate</p>
                <p class="text-white font-semibold">{{ $v->plate_number }}</p>
            </div>

            <div>
                <p class="text-gray-400 text-xs">Make</p>
                <p>{{ $v->make }}</p>
            </div>

            <div>
                <p class="text-gray-400 text-xs">Engine</p>
                <p>{{ $v->engine_model }}</p>
            </div>

            <div>
                <p class="text-gray-400 text-xs">Vehicle ID</p>
                <p>{{ $v->vehicle_id }}</p>
            </div>

        </div>

    </td>
</tr>
@endforeach

        @endforeach

        </tbody>

    </table>
  </div>

</div>

<div class="flex justify-end mt-6 me-10">
    <button type="button" onclick="window.location.href='/userdash'" class="border border-gray-400 text-gray-300 rounded-lg px-7 py-2 text-sm">
        Cancel
    </button>
</div>

</main>

</body>
</html>

<script>
function filterMaster() {
    let input = document.getElementById("searchMaster").value.toLowerCase();

    // get all customer header rows
    let headers = document.querySelectorAll("#masterTable tr[data-customer]");

    headers.forEach(header => {
        let customerId = header.dataset.customer;

        let vehicleRows = document.querySelectorAll(".customer-" + customerId);

        let found = false;

        // check header (customer info)
        let headerText = header.textContent.toLowerCase();
        if (headerText.includes(input)) {
            found = true;
        }

        // check vehicles under this customer
        vehicleRows.forEach(row => {
            let rowText = row.textContent.toLowerCase();
            if (rowText.includes(input)) {
                found = true;
            }
        });

        // show/hide entire block
        if (found) {
            header.style.display = "";
            vehicleRows.forEach(r => r.style.display = "");
        } else {
            header.style.display = "none";
            vehicleRows.forEach(r => r.style.display = "none");
        }
    });
}

function toggleCustomer(customerId) {
    let rows = document.querySelectorAll(".customer-" + customerId);

    rows.forEach(row => {
        row.classList.toggle("hidden");
    });
}
</script>