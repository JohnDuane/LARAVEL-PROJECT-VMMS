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
<h1 class="text-3xl font-bold text-white">Staff</h1>

<div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- TABLE -->
    <div class="w-[60%]">
    <table class="rounded-sm w-full text-sm mb-6 border border-gray-700">
        <thead class="bg-[#ff8800] text-black">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Contact</th>
            </tr>
        </thead>

        <tbody class="text-center">
            @foreach($staff as $s)
            <tr class="border-b border-gray-700 hover:bg-gray-800 cursor-pointer"
                onclick="selectStaff(
                    {{ $s->staff_id }},
                    '{{ $s->staff_name }}',
                    '{{ $s->role }}',
                    '{{ $s->contact_number }}'
                )">

                <td>{{ $s->staff_id }}</td>
                <td>{{ $s->staff_name }}</td>
                <td>{{ $s->role }}</td>
                <td>{{ $s->contact_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- FORM -->
    <div class="w-[40%]">
    <form action="{{ route('staff.store') }}" method="POST">
    @csrf

    <input type="hidden" id="staff_id" name="staff_id">

    <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <h2 class="text-white text-lg font-medium mb-6">Add Staff</h2>

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
    <div class="flex justify-end gap-3">

        <!-- SAVE -->
        <button type="submit"
            class="bg-orange-600 hover:bg-orange-500 text-white rounded-lg px-6 py-2 text-sm">
            Save
        </button>

        <!-- UPDATE -->
        <button type="submit" formaction="{{ route('staff.update') }}"
            class="bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-6 py-2 text-sm">
            Update
        </button>

        <!-- DELETE -->
        <button type="submit" formaction="{{ route('staff.delete') }}"
            class="bg-red-600 hover:bg-red-500 text-white rounded-lg px-6 py-2 text-sm">
            Delete
        </button>
    </div>

    </div>
    </form>
    </div>
</div>
</main>

<script>
function selectStaff(id, name, role, contact) {
    document.getElementById('staff_id').value = id;
    document.getElementById('staff_name').value = name;
    document.getElementById('role').value = role;
    document.getElementById('contact_number').value = contact;
}
</script>
    
</body>
</html>