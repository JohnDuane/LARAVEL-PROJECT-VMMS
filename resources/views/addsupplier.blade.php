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
    <h1 class="text-3xl font-bold text-white">Suppliers</h1>


    <div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- LAMESA -->
  <div class="w-[60%]">
    <div class="mb-6">
  

  <!-- SEARCH TAGIL -->
  <input 
    type="text"
    id="searchSupplier"
    placeholder="Search supplier..."
    onkeyup="filterSuppliers()"
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
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Contact</th>
            <th class="px-4 py-3">Address</th>
        </tr>
        </thead>

        <tbody id="supplierTable">
            @foreach($suppliers as $s)
                <tr 
                class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
                onclick='selectRow(
                    this,
                    {{ $s->supplier_id }},
                    @json($s->supplier_name),
                    @json($s->contact_number),
                    @json($s->address)
                )'
                >

                    <td class="px-4 py-3">{{ $s->supplier_id }}</td>
                    <td class="px-4 py-3">{{ $s->supplier_name }}</td>
                    <td class="px-4 py-3">{{ $s->contact_number }}</td>
                    <td class="px-4 py-3">{{ $s->address }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
  </div>
</div>
  </div>
    <!-- FORM 137 -->
  <div class="w-[40%]">
  <form id="supplierForm" method="POST">
  @csrf

    <input type="hidden" id="supplier_id" name="supplier_id">

  <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-white text-lg font-medium">Add / Edit Supplier</h2>

        <button type="button" onclick="clearForm()"
            class="text-sm text-gray-400 hover:text-white">
            Clear
        </button>
    </div>


    <div class="mb-4">
    <label class="block text-sm text-gray-400 mb-1">Supplier Name</label>
    <input type="text" id="name" name="supplier_name" required
    class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>

    <div class="mb-4">
    <label class="block text-sm text-gray-400 mb-1">Contact Number</label>
    <input type="text" id="contact" name="contact_number"
    class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>

    <div class="mb-4">
    <label class="block text-sm text-gray-400 mb-1">Address</label>
    <input type="text" id="address" name="address"
    class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>


    <!-- Buttons -->
        <div class="flex justify-between mt-6">

            <!-- PRIMARY -->
            <button type="button" onclick="addSupplier()"
                class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg text-sm font-medium">
                + Add Supplier
            </button>

            <!-- SECONDARY -->
            <div class="flex gap-2">
                <button id="updateBtn" type="button" onclick="updateSupplier()"
                    class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm opacity-50 cursor-not-allowed">
                    Update
                </button>

                <button id="deleteBtn" type="button" onclick="deleteSupplier()"
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
    
</body>
</html>

<script>
   let selectedId = null;
let selectedRow = null;

function selectRow(row, id, name, contact, address) {
    // Remove old highlight
    if (selectedRow) {
        selectedRow.classList.remove("bg-orange-500/20");
    }

    // Highlight new row
    selectedRow = row;
    row.classList.add("bg-orange-500/20");

    selectedId = id;

    // Fill form
    document.getElementById("supplier_id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("contact").value = contact;
    document.getElementById("address").value = address;

    toggleButtons();
}

function toggleButtons() {
    let disabled = !selectedId;

    let updateBtn = document.getElementById("updateBtn");
    let deleteBtn = document.getElementById("deleteBtn");

    updateBtn.disabled = disabled;
    deleteBtn.disabled = disabled;

    updateBtn.classList.toggle("opacity-50", disabled);
    updateBtn.classList.toggle("cursor-not-allowed", disabled);

    deleteBtn.classList.toggle("opacity-50", disabled);
    deleteBtn.classList.toggle("cursor-not-allowed", disabled);
}

function clearForm() {
    selectedId = null;

    document.getElementById("supplierForm").reset();

    if (selectedRow) {
        selectedRow.classList.remove("bg-orange-500/20");
        selectedRow = null;
    }

    toggleButtons();
}

function addSupplier() {
    let form = document.getElementById("supplierForm");
    form.action = "/suppliers/store";
    form.submit();

    clearForm();
}

function updateSupplier() {
    if (!selectedId) return;

    let form = document.getElementById("supplierForm");
    form.action = "/suppliers/update/" + selectedId;
    form.submit();
}

function deleteSupplier() {
    if (!selectedId) return;

    if (!confirm("Are you sure you want to delete this supplier?")) return;

    let form = document.getElementById("supplierForm");
    form.action = "/suppliers/delete/" + selectedId;
    form.submit();
}

function filterSuppliers() {
    let input = document.getElementById("searchSupplier").value.toLowerCase();
    let rows = document.querySelectorAll("#supplierTable tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
}

// Init
window.onload = toggleButtons;
</script>