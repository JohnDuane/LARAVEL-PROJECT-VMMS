<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center p-8" style="background: linear-gradient(135deg, #c45c00 0%, #8b3a00 60%, #3a1a00 100%);">

<form action="{{ route('job-order.store') }}" method="POST">
@csrf

<input type="hidden" name="mechanic_id" id="mechanic_id">

<div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-2xl">
  <h2 class="text-white text-lg font-medium mb-6">Job Order/Repair Estimate</h2>

  <!-- Row 1 -->
  <div class="grid grid-cols-2 gap-x-6 gap-y-3 mb-3">
    
    <!-- Customers -->
    <div>
      <label class="block text-sm text-gray-400 mb-1">Customers</label>
      <div class="h-38 overflow-y-auto border border-gray-200 rounded-xl">
        <table class="w-full table-fixed bg-amber-50 text-sm">
          <thead>
            <tr>
              <th class="p-2">ID</th>
              <th class="p-2">Customer Name</th>
              <th class="p-2">Option</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <tr><td class="p-2">1</td><td class="p-2">John Doe</td><td class="p-2"></td></tr>
            <tr><td class="p-2">2</td><td class="p-2">Jane Smith</td><td class="p-2"></td></tr>
            <tr><td class="p-2">3</td><td class="p-2">Shining Star</td><td class="p-2"></td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Cars -->
    <div>
      <label class="block text-sm text-gray-400 mb-1">Cars</label>
      <div class="h-38 overflow-y-auto border border-gray-200 rounded-xl">
        <table class="w-full table-fixed bg-amber-50 text-sm">
          <thead>
            <tr>
              <th class="p-2">ID</th>
              <th class="p-2">Plate Number</th>
              <th class="p-2">Make</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <tr><td class="p-2">1</td><td class="p-2">XWM123</td><td class="p-2">Toyota</td></tr>
            <tr><td class="p-2">2</td><td class="p-2">ABC456</td><td class="p-2">Honda</td></tr>
            <tr><td class="p-2">3</td><td class="p-2">XYZ789</td><td class="p-2">Ford</td></tr>
          </tbody>
        </table>
      </div>
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
      <div class="h-38 overflow-y-auto border border-gray-200 rounded-xl">
            <table class="w-full table-fixed bg-amber-50 text-sm">
                  <thead>
                    <tr>
                      <th class="p-2">Job Description</th>
                      <th class="p-2">Price</th>
                      <th class="p-2">Option</th>
                    </tr>
                  </thead>
                  <tbody class="text-gray-700">
                    <tr><td class="p-2">Oil Change</td><td class="p-2">$50.00</td><td class="p-2"></td></tr>
                    <tr><td class="p-2">Tire Rotation</td><td class="p-2">$30.00</td><td class="p-2"></td></tr>
                    <tr><td class="p-2">Brake Inspection</td><td class="p-2">$75.00</td><td class="p-2"></td></tr>
                    <tr><td class="p-2">Brake Replacement</td><td class="p-2">$150.00</td><td class="p-2"></td></tr>
                  </tbody>
            </table>
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
        <select id="partSelect"
            class="bg-zinc-800 border border-zinc-700 rounded px-2 py-1">
            
            <option value="">Select Part</option>

            @foreach($parts as $part)
                <option value="{{ $part->part_id }}" data-price="{{ $part->price }}">
                    {{ $part->part_name }}
                </option>
            @endforeach

        </select>

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
</script>


<script>
let partsSubtotal = 0;

function addPartRow() {
    const select = document.getElementById("partSelect");
    const qtyInput = document.getElementById("qtyInput");

    const partId = select.value;
    const partName = select.options[select.selectedIndex].text;
    const price = parseFloat(select.options[select.selectedIndex].dataset.price);
    const qty = parseInt(qtyInput.value);

    if (!partId || !qty || qty <= 0) {
        alert("Select part and valid quantity");
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

    // reset inputs
    select.value = "";
    qtyInput.value = "";
}

function removePartRow(btn, amount) {
    btn.closest("tr").remove();
    partsSubtotal -= amount;
    updateSubtotal();
}

function updateSubtotal() {
    document.getElementById("partsSubtotal")
        .innerText = partsSubtotal.toFixed(2);
}
</script>