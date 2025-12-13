@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-8">Jobs List</h2>

        <div
            class="bg-white/15 backdrop-blur-lg border border-white/20 
                rounded-2xl shadow-lg overflow-hidden">

            <table class="w-full text-left text-white">
                <thead class="bg-white/10 border-b border-white/20">
                    <tr>
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Title</th>
                        <th class="px-6 py-4 font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="border-b border-white/10 hover:bg-white/10 transition">
                            <td class="px-6 py-4 text-white/80">
                                {{ $job->id }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $job->title }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-2">

                                    <button onclick="viewJob('{{ $job->uuid }}')"
                                        class="px-4 py-1.5 rounded-full bg-white/20 
                                           hover:bg-white/30 transition font-semibold">
                                        View
                                    </button>

                                    <button onclick="editJob('{{ $job->uuid }}')"
                                        class="px-4 py-1.5 rounded-full bg-blue-600 
                                           hover:bg-blue-700 transition font-semibold">
                                        Edit
                                    </button>

                                    <button onclick="deleteJob('{{ $job->uuid }}')"
                                        class="px-4 py-1.5 rounded-full bg-red-500 
                                           hover:bg-red-600 transition font-semibold">
                                        Delete
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('company.jobs.modals')


    {{-- API Scripts --}}
    <script>
        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        function viewJob(uuid) {
    fetch(`/company/jobs/${uuid}`)
        .then(res => res.json())
        .then(job => {
            document.getElementById('viewTitle').innerText = job.title;
            document.getElementById('viewDescription').innerText = job.description;
            document.getElementById('viewSalaryFrom').innerText = job.salary_from;
            document.getElementById('viewSalaryTo').innerText = job.salary_to;

            document.getElementById('viewModal').classList.remove('hidden');
        })
        .catch(() => alert('Failed to load job details'));
}


        // function viewJob(uuid) {
        //     fetch(`/company/jobs/${uuid}`)
        //         .then(res => res.json())
        //         .then(job => {
        //             document.getElementById('viewContent').innerText =
        //                 JSON.stringify(job, null, 2);
        //             document.getElementById('viewModal').classList.remove('hidden');
        //         });
        // }

        function editJob(uuid) {
            fetch(`/company/jobs/${uuid}`)
                .then(res => res.json())
                .then(job => {
                    document.getElementById('editUuid').value = uuid;
                    document.getElementById('editTitle').value = job.title;
                    document.getElementById('editDescription').value = job.description;
                    document.getElementById('editFrom').value = job.salary_from;
                    document.getElementById('editTo').value = job.salary_to;
                    document.getElementById('editModal').classList.remove('hidden');
                });
        }

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(`/company/jobs/${editUuid.value}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    title: editTitle.value,
                    description: editDescription.value,
                    salary_from: editFrom.value,
                    salary_to: editTo.value
                })
            }).then(() => location.reload());
        });

        function deleteJob(uuid) {
            if (!confirm('Delete this job?')) return;

            fetch(`/company/jobs/${uuid}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => location.reload());
        }
    </script>
@endsection
