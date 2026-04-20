<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    @vite(['resources/css/app.css'])
</head>

@include('layouts.logout')

<body class="bg-[#232323] text-white">

@include('layouts.sidenav')

<main class="flex-1 p-6 min-h-screen">
    <h1 class="text-3xl font-bold text-white">Customers</h1>

<div class="max-w-7xl mx-auto pt-5 flex gap-6">

    <!-- TABLE -->
    <div class="w-[60%]">
    <table class="rounded-sm w-full text-sm mb-6 border border-gray-700">
        <thead class="bg-[#ff8800] text-black">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Address</th>
            </tr>
        </thead>

        <tbody class="text-center">
            @foreach($customers as $c)
            <tr class="border-b border-gray-700 hover:bg-gray-800 cursor-pointer"
                onclick="selectCustomer(
                    {{ $c->id }},
                    {{ json_encode($c->cust_name) }},
                    {{ json_encode($c->contact_number) }},
                    {{ json_encode($c->address) }}
                )">

                <td>{{ $c->id }}</td>
                <td>{{ $c->cust_name }}</td>
                <td>{{ $c->contact_number }}</td>
                <td>{{ $c->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- FORM -->
    <div class="w-[40%]">
    <form method="POST">
    @csrf

    <input type="hidden" id="id" name="id">

    <div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <h2 class="text-white text-lg font-medium mb-6">Add / Edit Customer</h2>

    <!-- Name -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Customer Name</label>
        <input type="text" id="cust_name" name="cust_name" required
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
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
    <div class="flex justify-end gap-3">

        <!-- SAVE -->
        <button type="submit" formaction="{{ route('customer.store') }}"
            class="bg-orange-600 hover:bg-orange-500 text-white rounded-lg px-6 py-2 text-sm">
            Save
        </button>

        <!-- UPDATE -->
        <button type="submit" formaction="{{ route('customer.update') }}"
            class="bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-6 py-2 text-sm">
            Update
        </button>

        <!-- DELETE -->
        <button type="submit" formaction="{{ route('customer.delete') }}"
            onclick="return confirm('Are you sure you want to delete this customer?')"
            class="bg-red-600 hover:bg-red-500 text-white rounded-lg px-6 py-2 text-sm">
            Delete
        </button>
    </div>

    </div>
    </form>
    </div>
</div>
</main>

<!-- SCRIPT -->
<script>
function selectCustomer(id, name, contact, address) {
    document.getElementById('id').value = id;
    document.getElementById('cust_name').value = name;
    document.getElementById('contact_number').value = contact;
    document.getElementById('address').value = address;
}
</script>

</body>
</html>