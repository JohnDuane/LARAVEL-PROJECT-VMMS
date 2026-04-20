<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
    @include('layouts.sidenav')
<body class="bg-[#232323] text-white">
    @include('layouts.logout')

<main class="flex-1 p-6 min-h-screen">
<h1 class="text-3xl font-bold text-white">Services</h1>

<div class="max-w-7xl mx-auto pt-5 flex gap-6">

<!-- TABLE -->
<div class="w-[60%]">
<table class="rounded-sm w-full text-sm mb-6 border border-gray-700">

<thead class="bg-[#ff8800] text-black">
<tr>
<th>ID</th>
<th>Description</th>
<th>Price</th>
</tr>
</thead>

<tbody class="text-center">
@foreach($services as $s)
<tr class="border-b border-gray-700 cursor-pointer hover:bg-gray-800"
onclick="selectRow({{ $s->service_id }}, '{{ $s->job_desc }}', '{{ $s->price }}')">

<td>{{ $s->service_id }}</td>
<td>{{ $s->job_desc }}</td>
<td>{{ $s->price }}</td>

</tr>
@endforeach
</tbody>

</table>
</div>

<!-- FORM -->
<div class="w-[40%]">
<form id="serviceForm" method="POST">
@csrf

<input type="hidden" id="service_id">

<div class="bg-[#1a1a1a] border border-[#333] rounded-xl p-7 w-full max-w-md">

<h2 class="text-white text-lg font-medium mb-6">Service Form</h2>

<div class="mb-4">
<label class="block text-sm text-gray-400 mb-1">Job Description</label>
<input type="text" id="desc" name="job_desc"
class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
</div>

<div class="mb-4">
<label class="block text-sm text-gray-400 mb-1">Price</label>
<input type="number" step="0.01" id="price" name="price"
class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
</div>

<!-- Buttons -->
<div class="flex justify-end gap-3 mt-5">

<button type="button" onclick="addService()"
class="bg-orange-600 px-6 py-2 rounded-lg text-sm">
Add
</button>

<button type="button" onclick="updateService()"
class="bg-orange-600 px-6 py-2 rounded-lg text-sm">
Update
</button>

<button type="button" onclick="deleteService()"
class="bg-orange-600 px-6 py-2 rounded-lg text-sm">
Delete
</button>

</div>

</div>
</form>
</div>

</div>
</main>

<script>
let selectedId = null;

function selectRow(id, desc, price) {
    selectedId = id;

    document.getElementById("service_id").value = id;
    document.getElementById("desc").value = desc;
    document.getElementById("price").value = price;
}

function addService() {
    let form = document.getElementById("serviceForm");
    form.action = "/services/store";
    form.submit();
}

function updateService() {
    if (!selectedId) return alert("Select a row first");

    let form = document.getElementById("serviceForm");
    form.action = "/services/update/" + selectedId;
    form.submit();
}

function deleteService() {
    if (!selectedId) return alert("Select a row first");

    let form = document.getElementById("serviceForm");
    form.action = "/services/delete/" + selectedId;
    form.submit();
}
</script>

</body>
</html>