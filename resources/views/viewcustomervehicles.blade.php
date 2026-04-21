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
        <h1 class="text-3xl font-bold text-white">Job Order Records</h1>
<div class="max-w-7xl mx-auto pt-5 flex gap-6">
	<table class="rounded-sm w-full text-sm mb-6 border border-gray-700">
    <thead class="bg-[#ff8800] text-black">
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Vehicle ID</th>
            <th>Plate</th>
            <th>Make</th>
            <th>Engine Model</th>
        </tr>
    </thead>

    <tbody class="text-center">
        @foreach($vehicle as $v)
            <tr class="border-b border-gray-700 hover:bg-gray-800">
                <td>{{ $v->customer_id }}</td>
                <td>{{ $v->cust_name }}</td>
                <td>{{ $v->contact_number }}</td>
                <td>{{ $v->vehicle_id }}</td>
                <td>{{ $v->plate_number }}</td>
                <td>{{ $v->make }}</td>
                <td>{{ $v->engine_model }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
</main>

</body>
</html>