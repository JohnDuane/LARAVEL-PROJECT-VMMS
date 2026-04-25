<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <main class="flex-1 p-6 min-h-screen">
    <h1 class="text-3xl font-bold text-white">Parts Inventory</h1>

<div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- PARTS TABLE -->
    <div class="w-[60%]">

        <input 
            type="text"
            id="searchPart"
            placeholder="Search part..."
            onkeyup="filterParts()"
            class="w-full mb-3 bg-[#1f1f1f] border border-gray-700 text-gray-200 
                   rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500"
        />

        <div class="h-[630px] overflow-y-auto rounded-2xl border border-gray-700 bg-[#1f1f1f]">
            <table class="w-full text-sm text-gray-300">
    <thead class="bg-[#262626] text-xs uppercase sticky top-0">
    <tr>
        <th class="px-4 py-3">ID</th>
        <th class="px-4 py-3">Part</th>
        <th class="px-4 py-3">Price</th>
        <th class="px-4 py-3">Stock</th> <!-- NEW -->
    </tr>
</thead>

<tbody id="partTable">
    @foreach($parts as $p)
    <tr onclick="selectPart({{ $p->part_id }}, '{{ $p->part_name }}', '', {{ $p->price }})"
        class="hover:bg-[#2e2e2e] cursor-pointer">

        <td class="px-4 py-3">{{ $p->part_id }}</td>
        <td class="px-4 py-3">{{ $p->part_name }}</td>
        <td class="px-4 py-3">₱{{ $p->price }}</td>

        <!-- 🔥 STOCK FROM VIEW -->
        <td class="px-4 py-3 font-semibold text-green-400">
            {{ $p->stock }}
        </td>
    </tr>
    @endforeach
</tbody>
</table>
        </div>
    </div>

    <!-- FORM -->
    <div class="w-[40%]">
        <form id="partForm" method="POST">
        @csrf

        <input type="hidden" id="part_id" name="part_id">
        
        <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7">

    <h2 class="text-white text-lg mb-5">Add / Edit Part</h2>

    <!-- 🧾 PART INFORMATION -->
    <div class="mb-4">
        <p class="text-xs text-gray-400 mb-2 uppercase">Part Details</p>

        <label class="text-sm text-gray-300">Part Name</label>
        <input type="text" id="part_name" name="part_name" required class="input">

        <label class="text-sm text-gray-300 mt-3 block">
            Selling Price <span class="text-gray-500 text-xs">(Price for customers)</span>
        </label>
        <input type="number" step="0.01" id="price" name="price" class="input">
    </div>

    <!-- 📦 STOCK IN SECTION -->
    <div class="mt-6 pt-4 border-t border-gray-700">
        <p class="text-xs text-gray-400 mb-2 uppercase">Stock In (Optional)</p>

        <label class="text-sm text-gray-300">Supplier</label>
        <select name="supplier_id" id="supplier" class="input">
            <option value="">Select Supplier</option>
            @foreach($suppliers as $s)
                <option value="{{ $s->supplier_id }}">
                    {{ $s->supplier_name }}
                </option>
            @endforeach
        </select>

        <label class="text-sm text-gray-300 mt-3 block">Quantity Received</label>
        <input type="number" name="quantity_received" placeholder="e.g. 10" class="input">

        <label class="text-sm text-gray-300 mt-3 block">
            Cost per Unit <span class="text-gray-500 text-xs">(Your purchase cost)</span>
        </label>
        <input type="number" step="0.01" name="cost_per_unit" placeholder="e.g. 300" class="input">

        <label class="text-sm text-gray-300 mt-3 block">Stock In Date</label>
        <input type="date" name="stock_in_arrived" class="input">
    </div>

    <!-- BUTTONS -->
    <div class="flex justify-end gap-3 mt-6">
        <button type="button" onclick="addPart()" class="btn">Add</button>
        <button type="button" onclick="updatePart()" class="btn">Update</button>
        <button type="button" onclick="deletePart()" class="btn">Delete</button>
    </div>

</div>
        </form>
    </div>

</div>
</main>

<style>
.input {
    width: 100%;
    background: #2a2a2a;
    border: 1px solid #444;
    color: white;
    padding: 8px;
    border-radius: 8px;
}

.btn {
    background: #ff8800;
    padding: 8px 16px;
    border-radius: 8px;
}
</style>

</body>
</html>

<script>

let selectedId = null;

function selectPart(id, name, desc, price) {
    selectedId = id;

    document.getElementById("part_id").value = id;
    document.getElementById("part_name").value = name;
    // document.getElementById("description").value = desc;
    document.getElementById("price").value = price;
}

function addPart() {
    let form = document.getElementById("partForm");

    if (selectedId) {
        // ✅ stock in existing part
        form.action = "/parts/stockin/" + selectedId;
    } else {
        // ✅ create new
        form.action = "/stockin/store";
    }

    form.submit();
}

function updatePart() {
    if (!selectedId) return alert("Select a part first");

    let form = document.getElementById("partForm");
    form.action = "/stockin/update/" + selectedId;
    form.submit();
}

function deletePart() {
    if (!selectedId) return alert("Select a part first");

    let form = document.getElementById("partForm");
    form.action = "/stockin/delete/" + selectedId;
    form.submit();
}

function filterParts() {
    let input = document.getElementById("searchPart").value.toLowerCase();
    let rows = document.querySelectorAll("#partTable tr");

    rows.forEach(row => {
        let name = row.children[1].textContent.toLowerCase();

        row.style.display = name.includes(input) ? "" : "none";
    });
}

</script>