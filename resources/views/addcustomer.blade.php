<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    @vite(['resources/css/app.css'])
</head>

@include('layouts.logout')

<body class="text-white">

@include('layouts.sidenav')

<main class="flex-1 p-6 min-h-screen">
    <h1 class="text-3xl font-bold text-white">Customers</h1>

<div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- TABLE -->
    <div class="w-[60%]">
    <div class="mb-6">
  

  <!-- 🔍 Search -->
  <input 
    type="text" 
    id="searchCustomer"
    placeholder="Search name or contact..."
    onkeyup="filterCustomers()"
    class="mb-3 w-full bg-[#1f1f1f] border border-gray-700 text-gray-200 
           rounded-xl px-4 py-2.5 text-sm 
           focus:outline-none focus:ring-2 focus:ring-orange-500"
  />

  <!-- 📦 Table -->
  <div class="overflow-hidden rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">

    <div style="scrollbar-width: none; -ms-overflow-style: none;" class="max-h-[420px] overflow-y-auto no-scrollbar">
      <table class="w-full text-sm text-left text-gray-300">

        <!-- Header -->
        <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Contact</th>
            <th class="px-4 py-3">Address</th>
          </tr>
        </thead>

        <!-- Body -->
        <tbody id="customerTable" class="divide-y divide-gray-700">
          @foreach($customers as $c)
          <tr 
            class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
            onclick="selectCustomer(
              this,
              {{ $c->id }},
              {{ json_encode($c->first_name) }},
              {{ json_encode($c->middle_name) }},
              {{ json_encode($c->last_name) }},
              {{ json_encode($c->contact_number) }},
              {{ json_encode($c->address) }}
            )"
          >
            <td class="px-4 py-3 text-gray-400">{{ $c->id }}</td>
            <td class="px-4 py-3 font-medium text-white customer-name">
              {{ trim($c->first_name . ' ' . $c->middle_name . ' ' . $c->last_name) }}
            </td>
            <td class="px-4 py-3 text-gray-300 customer-contact">
              {{ $c->contact_number }}
            </td>
            <td class="px-4 py-3 text-gray-300">
              {{ $c->address }}
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>
</div>
    </div>

    <!-- FORM -->
    <div class="w-[40%]">
    <form method="POST" id="customerForm">
    @csrf

    <input type="hidden" id="id" name="id">

    <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-white text-lg font-medium">Add / Edit Customer</h2>

        <button type="button" onclick="clearCustomerForm()"
            class="text-sm text-gray-400 hover:text-white">
            Clear
        </button>
    </div>

    <!-- Name -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Customer Name</label>
        <!-- <input type="text" id="cust_name" name="cust_name" required
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/> -->

            
            
            <!-- First Name -->
            <div class="mb-4">
                <label class="block text-sm text-gray-400 mb-1">
                    First Name
                </label>

                <input type="text"
                    id="first_name"
                    name="first_name"
                    required
                    class="w-full bg-[#2a2a2a] border border-[#444]
                          text-gray-100 rounded-lg px-3 py-2 text-sm"/>
            </div>

            <!-- Middle Name -->
            <div class="mb-4">
                <label class="block text-sm text-gray-400 mb-1">
                    Middle Name
                </label>

                <input type="text"
                    id="middle_name"
                    name="middle_name"
                    class="w-full bg-[#2a2a2a] border border-[#444]
                          text-gray-100 rounded-lg px-3 py-2 text-sm"/>
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label class="block text-sm text-gray-400 mb-1">
                    Last Name
                </label>

                <input type="text"
                    id="last_name"
                    name="last_name"
                    required
                    class="w-full bg-[#2a2a2a] border border-[#444]
                          text-gray-100 rounded-lg px-3 py-2 text-sm"/>
            </div>



    </div>

    <!-- Contact -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
    </div>

    <!-- Address -->
    <div class="mb-5">
        <label class="block text-sm text-gray-400 mb-1">Address</label>
        <textarea id="address" name="address" rows="3"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm resize-none"></textarea>
    </div>

    <!-- BUTTONS -->
    <div class="flex justify-between mt-6">

      <!-- PRIMARY -->
      <button type="submit"
          formaction="{{ route('customer.store') }}"
          class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg text-sm font-medium">
          + Add Customer
      </button>

      <!-- SECONDARY -->
      <div class="flex gap-2">
          <button id="updateBtn" type="submit" 
              formaction="{{ route('customer.update') }}"
              class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm opacity-50 cursor-not-allowed">
              Update
          </button>

          <button id="deleteBtn" type="submit" 
              formaction="{{ route('customer.delete') }}"
              onclick="return confirm('Delete this customer?')"
              class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm opacity-50 cursor-not-allowed">
              Delete
          </button>
      </div>
</div>

    </div>
    </form>
    </div>
</div>
</main>

<!-- SCRIPT -->
<script>
let selectedCustomerId = null;
let selectedCustomerRow = null;

function selectCustomer(
    row,
    id,
    firstName,
    middleName,
    lastName,
    contact,
    address
) {
    // Remove old highlight
    if (selectedCustomerRow) {
        selectedCustomerRow.classList.remove("bg-orange-500/20");
    }

    // Highlight new
    selectedCustomerRow = row;
    row.classList.add("bg-orange-500/20");

    selectedCustomerId = id;

    // Fill form
    document.getElementById('id').value = id;
    document.getElementById('first_name').value = firstName;
    document.getElementById('middle_name').value = middleName;
    document.getElementById('last_name').value = lastName;
    document.getElementById('contact_number').value = contact;
    document.getElementById('address').value = address;

    toggleCustomerButtons();
}


function toggleCustomerButtons() {
    let disabled = !selectedCustomerId;

    let updateBtn = document.getElementById("updateBtn");
    let deleteBtn = document.getElementById("deleteBtn");

    updateBtn.disabled = disabled;
    deleteBtn.disabled = disabled;

    updateBtn.classList.toggle("opacity-50", disabled);
    updateBtn.classList.toggle("cursor-not-allowed", disabled);

    deleteBtn.classList.toggle("opacity-50", disabled);
    deleteBtn.classList.toggle("cursor-not-allowed", disabled);
}


function clearCustomerForm() {
    selectedCustomerId = null;

    document.getElementById("customerForm").reset();

    if (selectedCustomerRow) {
        selectedCustomerRow.classList.remove("bg-orange-500/20");
        selectedCustomerRow = null;
    }

    toggleCustomerButtons();
}


function filterCustomers() {
  let input = document.getElementById("searchCustomer").value.toLowerCase();
  let rows = document.querySelectorAll("#customerTable tr");

  rows.forEach(row => {
    let name = row.querySelector(".customer-name").textContent.toLowerCase();
    let contact = row.querySelector(".customer-contact").textContent.toLowerCase();

    if (name.includes(input) || contact.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
const customerForm = document.getElementById("customerForm");

customerForm.addEventListener("submit", function(e) {


    e.preventDefault();

    const action = document.querySelector(
        'button[type="submit"]:focus'
    )?.getAttribute("formaction");

    alert(action);

    console.log(action);

    // 👉 If NOT ADD → just submit normally (no modal, no fetch)
    if (!action.includes('/customer/store')) {
        this.action = action;   // set correct route
        this.submit();          // normal Laravel request
        return;
    }

    // 👉 ONLY ADD uses AJAX + modal
    let formData = new FormData(this);

    console.log("FETCH STARTING");
    console.log(action);

    fetch(action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
            "X-Requested-With": "XMLHttpRequest"
        },
        body: formData
    })
    .then(async res => {
        const text = await res.text();

        console.log("RAW RESPONSE:");
        console.log(text);

        try {
            return JSON.parse(text);
        } catch (e) {
            console.error("JSON PARSE FAILED");
            console.error(e);
            return null;
        }
    })

    .then(data => {

        console.log("PARSED DATA:", data);

        if (data && data.success) {
            const modal = document.getElementById('vehicleModal');
            const content = document.getElementById('modalContent');

            modal.classList.remove('hidden');

            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }, 10);

            document.getElementById('vehicle_customer_id').value = data.customer_id;
        }
    })
    .catch(err => console.error(err));
});

function closeVehicleModal() {
    const modal = document.getElementById('vehicleModal');
    const content = document.getElementById('modalContent');

    modal.classList.add('opacity-0');
    content.classList.remove('scale-100');
    content.classList.add('scale-90');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 500);
}

function submitVehicle() {
    let form = document.getElementById('vehicleForm');
    let formData = new FormData(form);

    fetch("/vehicles/store", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
            "X-Requested-With": "XMLHttpRequest"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert("✅ Customer and Vehicle added!");

        closeVehicleModal();
        location.reload();
    });
}

window.onload = function() {
    toggleCustomerButtons();
};
</script>

<!-- 🚗 VEHICLE MODAL -->
<div id="vehicleModal" 
     class="fixed inset-0 flex items-center justify-center bg-black/60 hidden z-50 opacity-0 transition-opacity duration-1000">

  <div id="modalContent"
       class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md 
              transform scale-90 transition-all duration-500">

    <h2 class="text-white text-lg font-medium mb-6">Add Vehicle For Customer</h2>

    <form id="vehicleForm">
      @csrf

      <input type="hidden" id="vehicle_customer_id" name="customer_id">

      <!-- Plate -->
      <div class="mb-4">
        <label class="text-sm text-gray-400">Plate Number</label>
        <input type="text" name="plate_number" required
          class="w-full bg-[#2a2a2a] p-2 rounded"/>
      </div>

      <!-- Make -->
      <div class="mb-4">
        <label class="text-sm text-gray-400">Make</label>
        <input type="text" name="make" required
          class="w-full bg-[#2a2a2a] p-2 rounded"/>
      </div>

      <!-- Engine -->
      <div class="mb-4">
        <label class="text-sm text-gray-400">Engine</label>
        <input type="text" name="engine_model" required
          class="w-full bg-[#2a2a2a] p-2 rounded"/>
      </div>

      <div class="flex justify-end gap-3 mt-4">
        <button type="button" onclick="closeVehicleModal()"
          class="bg-gray-600 px-4 py-2 rounded">
          Cancel
        </button>

        <button type="button" onclick="submitVehicle()"
          class="bg-[#ff8800] px-4 py-2 rounded">
          Add Vehicle
        </button>
      </div>

    </form>

  </div>
</div>

</body>
</html>