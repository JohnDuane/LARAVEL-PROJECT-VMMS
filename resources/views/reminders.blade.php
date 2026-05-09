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



    {{-- ─── TOP ROW: Form + Reminders (equal 1/2 width each) ─── --}}
    <div class="flex gap-4 mb-6">

        {{-- LEFT: Create Reminder Form --}}

        {{-- RIGHT: All Reminders Table --}}
        
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
        <div id="jobList" class="overflow-y-auto max-h-[500px] no-scrollbar">

        @foreach($jobOrders as $job)

            <!-- 🔶 JOB HEADER -->
            <div
                class="job-row bg-[#2a2a2a] hover:bg-[#333] transition cursor-pointer
                    rounded-xl mb-3 border border-zinc-700"
                onclick="toggleJob('{{ $job->job_order_id }}')"
                data-customer="{{ strtolower(trim(($job->first_name ?? '') . ' ' . ($job->middle_name ?? '') . ' ' . ($job->last_name ?? ''))) }}"
                data-vehicle="{{ strtolower($job->make) }}"
            >

                <div class="px-5 py-4 flex justify-between items-center">

                    <div>
                        <p class="text-white font-semibold text-lg">
                            {{ trim(($job->first_name ?? '') . ' ' . ($job->middle_name ?? '') . ' ' . ($job->last_name ?? '')) }}
                        </p>

                        <div class="flex gap-4 mt-1 text-sm text-gray-400">
                            <span>Job #{{ $job->job_order_id }}</span>
                            <span>{{ $job->make }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">

                        <!-- RED DOT -->
                        <div
                            id="alert-{{ $job->job_order_id }}"
                            class="hidden w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse">
                        </div>

                        <!-- OVERDUE COUNT -->
                        <span
                            id="alert-text-{{ $job->job_order_id }}"
                            class="text-xs text-red-400 hidden">
                        </span>

                        <div class="text-xs text-gray-400">
                            Click to view reminders
                        </div>

                    </div>

                </div>

            </div>

            <!-- 🔻 REMINDERS -->
            <div
                id="job-{{ $job->job_order_id }}"
                class="hidden mb-5"
            >

                <div class="bg-[#1f1f1f] rounded-xl border border-zinc-800 overflow-hidden">

                    <table class="w-full text-sm text-zinc-300">

                        <thead class="bg-zinc-800 text-zinc-400 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">Description</th>
                                <th class="px-4 py-3 text-left">Due Date</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody id="reminders-{{ $job->job_order_id }}">

                            <tr>
                                <td colspan="4" class="text-center py-6 text-zinc-500">
                                    Loading reminders...
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        @endforeach

        </div>

    </div>

</main>
</body>
</html>

<script>

function filterJobs() {
    const q = document.getElementById('searchJob').value.toLowerCase().trim();
    document.querySelectorAll('#jobList .job-row').forEach(row => {
        if (q === '') { row.style.display = ''; return; }
        const match = row.dataset.customer.includes(q) || row.dataset.vehicle.includes(q);
        row.style.display = match ? '' : 'none';
    });
}


async function checkOverdue(jobId) {

    const res = await fetch(`/reminders/by-job/${jobId}`);
    const data = await res.json();

    let overdueCount = 0;

    data.forEach(r => {

        const isOverdue =
            new Date(r.due_date) < new Date()
            && r.status === 'pending';

        if (isOverdue) {
            overdueCount++;
        }
    });

    // show red alert
    if (overdueCount > 0) {

        document
            .getElementById(`alert-${jobId}`)
            .classList.remove("hidden");

        const text =
            document.getElementById(`alert-text-${jobId}`);

        text.classList.remove("hidden");

        text.innerText =
            overdueCount + " overdue";

        // 🔥 MOVE JOB TO TOP
        const jobCard =
            document.querySelector(
                `[onclick="toggleJob('${jobId}')"]`
            );

        const jobList =
            document.getElementById("jobList");

        const reminderContainer =
            document.getElementById(`job-${jobId}`);

        // move BOTH header + dropdown
        jobList.prepend(reminderContainer);
        jobList.prepend(jobCard);
    }
}

async function toggleJob(jobId) {

    let container = document.getElementById(`job-${jobId}`);

    // toggle open/close
    container.classList.toggle("hidden");

    // if already loaded, stop
    if (container.dataset.loaded) {
        return;
    }

    const tbody = document.getElementById(`reminders-${jobId}`);

    tbody.innerHTML = `
        <tr>
            <td colspan="4" class="text-center py-5 text-zinc-500">
                Loading reminders...
            </td>
        </tr>
    `;

    const res = await fetch(`/reminders/by-job/${jobId}`);
    const data = await res.json();

    tbody.innerHTML = '';

    if (data.length === 0) {

        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center py-6 text-zinc-500">
                    No reminders found
                </td>
            </tr>
        `;

        return;
    }

        // 🔥 sort overdue first
        data.sort((a, b) => {

            const aOverdue =
                new Date(a.due_date) < new Date()
                && a.status === 'pending';

            const bOverdue =
                new Date(b.due_date) < new Date()
                && b.status === 'pending';

            return bOverdue - aOverdue;
        });

        let overdueCount = 0;

        data.forEach(r => {

        const isOverdue =
            new Date(r.due_date) < new Date()
            && r.status === 'pending';

            if (isOverdue) {
                overdueCount++;
            }

        tbody.innerHTML += `
            <tr class="border-t border-zinc-800">

                <td class="px-4 py-4">
                    ${r.description}
                </td>

                <td class="px-4 py-4">
                    ${r.due_date}
                </td>

                <td class="px-4 py-4">

                    ${
                        r.status === 'completed'
                        ? `
                        <span class="bg-green-900/40 text-green-400 px-2 py-1 rounded-full text-xs">
                            Completed
                        </span>
                        `
                        : isOverdue
                        ? `
                        <span class="bg-red-900/40 text-red-400 px-2 py-1 rounded-full text-xs">
                            Overdue
                        </span>
                        `
                        : `
                        <span class="bg-yellow-900/40 text-yellow-400 px-2 py-1 rounded-full text-xs">
                            Pending
                        </span>
                        `
                    }

                </td>

                <td class="px-4 py-4 text-center">

                    ${
                        r.status !== 'completed'
                        ? `
                        <a
                            href="/reminders/complete/${r.id}"
                            class="bg-green-600 hover:bg-green-700
                                   text-white px-3 py-1 rounded-lg text-xs"
                        >
                            Mark Done
                        </a>
                        `
                        : ''
                    }

                </td>

            </tr>
        `;
    });


    
    container.dataset.loaded = true;
}

window.onload = function () {

    @foreach($jobOrders as $job)
        checkOverdue({{ $job->job_order_id }});
    @endforeach

};
</script>