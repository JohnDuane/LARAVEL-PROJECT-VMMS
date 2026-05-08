<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminders</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#232323] text-white">
<main class="flex-1 p-6 min-h-screen">

<div id="serviceViewer" class="bg-zinc-900/80 mt-4 p-4 rounded-xl border border-zinc-800 hidden">
    <h3 class="text-sm font-medium mb-2">Services for selected job</h3>

    <table class="w-full text-xs text-zinc-300">
        <thead class="bg-zinc-800 text-zinc-400 text-xs uppercase tracking-wide">
            <tr>
                <th class="text-left py-1">Service</th>
                <th>Price</th>
                <th>Interval</th>
            </tr>
        </thead>
        <tbody id="serviceViewerBody"></tbody>
    </table>
</div>

    {{-- ─── TOP ROW: Form + Reminders (equal 1/2 width each) ─── --}}
    <div class="flex gap-4 mb-6">

        {{-- LEFT: Create Reminder Form --}}

        {{-- RIGHT: All Reminders Table --}}
        <div class="w-full h-[250px]">
            <div class="bg-zinc-900/80 backdrop-blur-md p-5 rounded-2xl border border-zinc-800 shadow-lg h-full">

                <h2 class="text-lg font-semibold text-white mb-0.5">Service Maintenance Reminders</h2>
                <p class="text-xs text-zinc-500 mb-3">
                    Select a job below to display its maintenance reminders
                </p>


                <div class="overflow-y-auto max-h-[220px] no-scrollbar">
                    <table class="w-full text-xs text-zinc-300 table-fixed">
                        <colgroup>
                            <col class="w-[13%]">
                            <col class="w-[30%]">
                            <col class="w-[20%]">
                            <col class="w-[22%]">
                            <col class="w-[15%]">
                        </colgroup>
                        <thead class="bg-zinc-800 text-zinc-400 text-xs uppercase tracking-wide">
                            <tr>
                                <th class="py-2 px-2 text-left font-medium">Job</th>
                                <th class="py-2 px-2 text-left font-medium">Description</th>
                                <th class="py-2 px-2 text-left font-medium">Next Maintenance</th>
                                <th class="py-2 px-2 text-left font-medium">Status</th>
                                <th class="py-2 px-2 text-center font-medium">Action</th>
                            </tr>
                        </thead>
                        <tbody id="reminderTableBody">
                            <tr>
                                <td colspan="5" class="text-center py-10">
                                    <div class="text-zinc-500 text-sm">
                                        Select a job order below to view maintenance reminders
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    {{-- ─── BOTTOM: Job Orders Selector ─── --}}
    <div class="bg-zinc-900/80 backdrop-blur-md p-5 rounded-2xl border border-zinc-800 shadow-lg">

        <h2 class="text-lg font-semibold text-white mb-4">Job Orders</h2>

        {{-- Search --}}
        <input
            type="text"
            id="searchJob"
            placeholder="Search customer or vehicle..."
            oninput="filterJobs()"
            class="w-full mb-3 bg-zinc-800 border border-zinc-700 text-sm text-zinc-200
                   px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff8800]
                   focus:border-[#ff8800] transition"
        />

        {{-- Column headers --}}
        <div class="grid grid-cols-[56px_1fr_1fr_auto] gap-2 px-1 pb-2 border-b border-zinc-700 mb-1">
            <span class="text-[11px] font-medium text-zinc-500 uppercase tracking-wide">ID</span>
            <span class="text-[11px] font-medium text-zinc-500 uppercase tracking-wide">Customer</span>
            <span class="text-[11px] font-medium text-zinc-500 uppercase tracking-wide">Vehicle</span>
            <span></span>
        </div>

        {{-- Rows --}}
        <div id="jobList" class="overflow-y-auto max-h-[160px] no-scrollbar">
            @foreach($jobOrders as $job)
            <div class="job-row grid grid-cols-[56px_1fr_1fr_auto] gap-2 items-center px-1 py-2
                        border-b border-zinc-800 last:border-0 hover:bg-zinc-800/50 transition"
                 data-customer="{{ strtolower($job->cust_name) }}"
                 data-vehicle="{{ strtolower($job->make) }}">
                <span class="text-[11px] text-zinc-500 font-mono">#{{ $job->job_order_id }}</span>
                <span class="text-sm font-medium text-white truncate customer-name">{{ $job->cust_name }}</span>
                <span class="text-xs text-zinc-400 truncate vehicle-name">{{ $job->make }}</span>
                <button
                    onclick="selectJob(event, {{ $job->job_order_id }}); loadReminders({{ $job->job_order_id }})"
                    class="bg-[#ff8800] hover:bg-[#e67600]
                    text-black text-[10px] font-semibold
                    px-2.5 py-1 rounded-md">
                    Select
                </button>
            </div>
            @endforeach
        </div>

    </div>

</main>
</body>
</html>

<script>
function selectJob(event, id) {

    // Remove ALL active classes from every row
    document.querySelectorAll('.job-row').forEach(r => {
        r.classList.remove(
            'bg-orange-500/10',
            'border-l-4',
            'border-orange-500'
        );
    });

    // Add active classes to clicked row
    const row = event.currentTarget.closest('.job-row');

    row.classList.add(
        'bg-orange-500/10',
        'border-l-4',
        'border-orange-500'
    );
}

function filterJobs() {
    const q = document.getElementById('searchJob').value.toLowerCase().trim();
    document.querySelectorAll('#jobList .job-row').forEach(row => {
        if (q === '') { row.style.display = ''; return; }
        const match = row.dataset.customer.includes(q) || row.dataset.vehicle.includes(q);
        row.style.display = match ? '' : 'none';
    });
}


function loadReminders(jobId) {

    const tbody = document.getElementById('reminderTableBody');

    tbody.innerHTML = `
    <tr>
        <td colspan="5" class="text-center py-4 text-zinc-500">
            Loading reminders...
        </td>
    </tr>
    `;


    fetch(`/reminders/by-job/${jobId}`)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('reminderTableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-zinc-500 py-4">
                            <div class="flex flex-col items-center justify-center py-12 text-center">
                                <p class="text-zinc-400 text-sm font-medium">
                                    No maintenance reminders yet
                                </p>

                                <p class="text-zinc-500 text-xs mt-1">
                                    Select a job order below to load reminders
                                </p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            data.forEach(r => {
                const isOverdue = new Date(r.due_date) < new Date() && r.status === 'pending';

                tbody.innerHTML += `
                    <tr class="${isOverdue ? 'bg-red-900/20' : ''}">
                        <td class="py-2 px-2">#${r.job_order_id}</td>
                        <td class="py-2 px-2">
                            ${r.description}
                            ${r.type === 'auto' ? '<span class="text-[10px] text-blue-400">(Auto)</span>' : ''}
                        </td>
                        <td class="py-2 px-2">${r.due_date}</td>
                        <td class="py-2 px-2">
                            ${
                                r.status === 'completed'
                                ? '<span class="bg-green-900/50 text-green-400 px-2 py-0.5 rounded-full text-[11px]">Completed</span>'
                                : isOverdue
                                ? '<span class="bg-red-900/50 text-red-400 px-2 py-0.5 rounded-full text-[11px]">Overdue</span>'
                                : '<span class="bg-yellow-900/50 text-yellow-400 px-2 py-0.5 rounded-full text-[11px]">No Need to maintain yet</span>'
                            }
                        </td>
                        <td class="py-2 px-2 text-center">
                            ${
                                r.status !== 'completed'
                                ? `<a href="/reminders/complete/${r.id}" class="bg-green-700 text-white px-2 py-1 rounded text-[11px]">Done</a>`
                                : ''
                            }
                        </td>
                    </tr>
                `;
            });
        });
}
</script>