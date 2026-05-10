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

    <main class="flex-1 p-6 min-h-screen">
<h1 class="text-3xl font-bold text-white">Mechanics/Staff</h1>

<div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- TABLE -->
    <div class="w-[60%]">
    <div class="mb-6">
  

  <!-- 🔍 Search -->
  <input 
    type="text" 
    id="searchStaff"
    placeholder="Search name or contact..."
    onkeyup="filterStaff()"
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
            <th class="px-4 py-3">Role</th>
            <th class="px-4 py-3">Contact</th>
          </tr>
        </thead>

        <!-- Body -->
        <tbody id="staffTable" class="divide-y divide-gray-700">
          @foreach($staff as $s)
          <tr 
            class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
            onclick='selectStaff(
              this,
              {{ $s->staff_id }},
              @json($s->staff_name),
              @json($s->role),
              @json($s->contact_number)
            )'
          >
            <td class="px-4 py-3 text-gray-400">{{ $s->staff_id }}</td>

            <td class="px-4 py-3 font-medium text-white staff-name">
              {{ $s->staff_name }}
            </td>

            <td class="px-4 py-3 text-gray-300">
              {{ $s->role }}
            </td>

            <td class="px-4 py-3 text-gray-300 staff-contact">
              {{ $s->contact_number }}
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
    <form action="{{ route('staff.store') }}" method="POST">
    @csrf

    <input type="hidden" id="staff_id" name="staff_id">

    <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-white text-lg font-medium">Add / Edit Staff</h2>

        <button type="button" onclick="clearStaffForm()"
            class="text-sm text-gray-400 hover:text-white">
            Clear
        </button>
    </div>

    <!-- Name -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Staff Name</label>
        <input type="text" id="staff_name" name="staff_name" required
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
    </div>

    <!-- Role -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Role</label>
        <input type="text" id="role" name="role"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
    </div>

    <!-- Contact -->
    <div class="mb-5">
        <label class="block text-sm text-gray-400 mb-1">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
    </div>

    <!-- Buttons -->
    <div class="flex justify-between mt-6">

        <!-- PRIMARY -->
        <button type="submit"
            class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg text-sm font-medium">
            + Save
        </button>

        <!-- SECONDARY -->
        <div class="flex gap-2">
            <button id="updateBtn" type="submit" formaction="{{ route('staff.update') }}"
                class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm opacity-50 cursor-not-allowed">
                Update
            </button>

            <button id="deleteBtn" type="submit" formaction="{{ route('staff.delete') }}"
                onclick="return confirm('Delete this staff?')"
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

<script>
let selectedStaffId = null;
let selectedRow = null;

function selectStaff(row, id, name, role, contact) {
    // Remove old highlight
    if (selectedRow) {
        selectedRow.classList.remove("bg-orange-500/20");
    }

    // Highlight new row
    selectedRow = row;
    row.classList.add("bg-orange-500/20");

    selectedStaffId = id;

    // Fill form
    document.getElementById('staff_id').value = id;
    document.getElementById('staff_name').value = name;
    document.getElementById('role').value = role;
    document.getElementById('contact_number').value = contact;

    toggleButtons();
}

function toggleButtons() {
    let disabled = !selectedStaffId;

    let updateBtn = document.getElementById("updateBtn");
    let deleteBtn = document.getElementById("deleteBtn");

    updateBtn.disabled = disabled;
    deleteBtn.disabled = disabled;

    updateBtn.classList.toggle("opacity-50", disabled);
    updateBtn.classList.toggle("cursor-not-allowed", disabled);

    deleteBtn.classList.toggle("opacity-50", disabled);
    deleteBtn.classList.toggle("cursor-not-allowed", disabled);
}

function clearStaffForm() {
    selectedStaffId = null;

    document.querySelector("form").reset();

    if (selectedRow) {
        selectedRow.classList.remove("bg-orange-500/20");
        selectedRow = null;
    }

    toggleButtons();
}

function filterStaff() {
    let input = document.getElementById("searchStaff").value.toLowerCase();
    let rows = document.querySelectorAll("#staffTable tr");

    rows.forEach(row => {
        let name = row.querySelector(".staff-name").textContent.toLowerCase();
        let contact = row.querySelector(".staff-contact").textContent.toLowerCase();

        row.style.display = (name.includes(input) || contact.includes(input)) ? "" : "none";
    });
}

// Init
window.onload = toggleButtons;
</script>
    
</body>
</html>