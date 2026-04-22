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
<table class="rounded-sm w-full text-sm mb-6 border border-gray-700">
  <thead class="bg-[#ff8800] text-black">
    <tr>
      <th>ID</th>
      <th>Customer</th>
      <th>Vehicle</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody class="text-center">
    @foreach($jobOrders as $job)
    <tr class="border-b border-gray-700 hover:bg-gray-800 cursor-pointer">
      <td>{{ $job->job_order_id }}</td>
      <td>{{ $job->cust_name }}</td>
      <td>{{ $job->make }}</td>
      <td>
        <button onclick="selectJob({{ $job->job_order_id }}, '{{ $job->make }}')"
          class="bg-[#ff8800] px-2 py-1 rounded">
          Select
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-6 bg-zinc-900 p-4 rounded-xl text-white">

  <h2 class="text-lg font-semibold mb-3">Create Reminder</h2>

  <p id="selectedJobText">No job selected</p>

  <form action="/reminders/store" method="POST">
    @csrf

    <input type="hidden" name="job_order_id" id="job_order_id">

    <div class="mt-3">
      <label>Description</label>
      <input type="text" name="description"
        class="w-full bg-gray-800 p-2 rounded">
    </div>

    <div class="mt-3">
      <label>Due Date</label>
      <input type="date" name="due_date"
        class="w-full bg-gray-800 p-2 rounded">
    </div>

    <button type="submit"
      class="mt-4 bg-[#ff8800] px-4 py-2 rounded">
      Create Reminder
    </button>
  </form>
</div>
    </main>

</body>
</html>

<script>
function selectJob(id, vehicle) {
    document.getElementById('job_order_id').value = id;
    document.getElementById('selectedJobText').innerText =
        "Selected Job Order: #" + id + " - " + vehicle;
}
</script>