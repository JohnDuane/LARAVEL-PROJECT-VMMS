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
        <h1 class="text-3xl font-bold text-white">Job Order Records</h1>
<div class="max-w-7xl mx-auto pt-5 flex gap-6">
	<table class="rounded-sm w-full text-sm mb-6 border border-gray-700">
        <thead class="bg-[#ff8800] text-black">
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Plate</th>
        <th>Make</th>
        <th>Mechanic</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
</thead>

        <tbody class="text-center">
            @foreach($data as $v)
                <tr class="border-b border-gray-700 hover:bg-gray-800 cursor-pointer"
                    onclick="selectJob({{ $v->job_order_id }})">

                    <td>{{ $v->job_order_id }}</td>
                    <td>{{ $v->cust_name }}</td>
                    <td>{{ $v->plate_number }}</td>
                    <td>{{ $v->make }}</td>
                    <td>{{ $v->mechanic_name }}</td>
                    <td>{{ $v->status }}</td>
                    <td>{{ $v->date_issued }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="flex justify-end gap-3 mt-6">

    <!-- PRINT BUTTON -->
    <button onclick="printJobOrder()"
        class="bg-[#ff8800] hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        Print Job Order
    </button>

    <!-- PLACEHOLDER BUTTON 1 -->
    <button
        class="bg-[#ff8800] hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        View Customer Vehicles
    </button>

    <!-- PLACEHOLDER BUTTON 2 -->
    <button
        class="bg-[#ff8800] hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
        View Parts
    </button>

</div>
</main>

<script>
let selectedJobId = null;

function selectJob(id) {
    selectedJobId = id;

    document.querySelectorAll("tr").forEach(row => {
        row.classList.remove("bg-gray-600");
    });

    event.currentTarget.classList.add("bg-gray-600");
}

function printJobOrder() {
    if (!selectedJobId) {
        alert("Please select a job order first!");
        return;
    }

    window.open(`/job-order/pdf/${selectedJobId}`, "_blank");
}
</script>
</body>
</html>