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
<div class="mb-6">



  <!-- 📦 Table -->
  <div class="overflow-hidden rounded-2xl border border-gray-700 bg-[#1f1f1f] shadow-inner">

    <div style="scrollbar-width: none; -ms-overflow-style: none;" class="max-h-[420px] overflow-y-auto no-scrollbar">
      <table class="w-full text-sm text-left text-gray-300">

        <!-- Header -->
        <thead class="bg-[#262626] text-gray-400 uppercase text-xs sticky top-0">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Description</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Interval</th> <!-- NEW -->
          </tr>
        </thead>

        <!-- Body -->
        <tbody id="serviceTable" class="divide-y divide-gray-700">
        @foreach($services as $s)
        <tr 
          class="hover:bg-[#2e2e2e] transition duration-150 cursor-pointer"
          onclick="selectRow(
            {{ $s->service_id }},
            '{{ $s->job_desc }}',
            '{{ $s->price }}',
            '{{ $s->interval_value }}',
            '{{ $s->interval_unit }}'
          )"
        >
          <td class="px-4 py-3 text-gray-400">{{ $s->service_id }}</td>

          <td class="px-4 py-3 font-medium text-white">
            {{ $s->job_desc }}
          </td>

          <td class="px-4 py-3 text-gray-300">
            ₱{{ $s->price }}
          </td>

          <td class="px-4 py-3 text-gray-300">
            {{ $s->interval_value }} {{ $s->interval_unit }}
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


<div class="mb-4">
<label class="block text-sm text-gray-400 mb-1">Interval Value</label>
<input type="number" id="interval_value" name="interval_value"
class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm"/>
</div>

<div class="mb-4">
<label class="block text-sm text-gray-400 mb-1">Interval Unit</label>
<select id="interval_unit" name="interval_unit"
class="w-full bg-[#2a2a2a] border border-[#444] text-gray-100 rounded-lg px-3 py-2 text-sm">
  <option value="">None</option>
  <option value="days">Days</option>
  <option value="months">Months</option>
  <option value="years">Years</option>
</select>
</div>


<!-- Buttons -->
<div class="flex justify-end gap-3 mt-5">

<button type="button" onclick="addService()"
class="bg-[#ff8800] px-6 py-2 rounded-lg text-sm">
Add
</button>

<button type="button" onclick="updateService()"
class="bg-[#ff8800] px-6 py-2 rounded-lg text-sm">
Update
</button>

<button type="button" onclick="deleteService()"
class="bg-[#ff8800] px-6 py-2 rounded-lg text-sm">
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

function selectRow(id, desc, price, interval_value, interval_unit) {
    selectedId = id;

    document.getElementById("service_id").value = id;
    document.getElementById("desc").value = desc;
    document.getElementById("price").value = price;
    document.getElementById("interval_value").value = interval_value;
    document.getElementById("interval_unit").value = interval_unit;
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