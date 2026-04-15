<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    @vite(['resources/css/app.css'])
</head>
  
  @include('layouts.logout')

<body>

@include('layouts.sidenav')
<main class="flex-1 p-6 min-h-screen">
<form action="{{ route('customer.store') }}" method="POST">
@csrf

<div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

    <h2 class="text-white text-lg font-medium mb-6">Add Customer</h2>

    <!-- Customer Name -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Customer Name</label>
        <input type="text" name="cust_name" required
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>

    <!-- Contact -->
    <div class="mb-4">
        <label class="block text-sm text-gray-400 mb-1">Contact Number</label>
        <input type="text" name="contact_number"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500"/>
    </div>

    <!-- Address -->
    <div class="mb-5">
        <label class="block text-sm text-gray-400 mb-1">Address</label>
        <textarea name="address" rows="3"
            class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-orange-500 resize-none"></textarea>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end gap-3">
        <a href="{{ route('userdash') }}"
            class="border border-gray-400 text-gray-300 rounded-lg px-6 py-2 text-sm">
            Cancel
        </a>

        <button type="submit"
            class="bg-orange-600 hover:bg-orange-500 text-white rounded-lg px-6 py-2 text-sm">
            Save
        </button>
    </div>

</div>
</form>
</main>
</body>
</html>