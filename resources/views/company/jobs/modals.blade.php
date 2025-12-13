<!-- VIEW MODAL -->
<div id="viewModal"
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm 
            flex items-center justify-center z-50">

    <!-- Modal Card -->
    <div class="bg-white/15 backdrop-blur-lg border border-white/20
                rounded-2xl shadow-xl w-full max-w-lg p-6 text-white">

        <h3 class="text-2xl font-bold mb-6">Job Details</h3>

        <div class="space-y-4 text-white/90">

            <div>
                <span class="font-semibold">Title</span>
                <p id="viewTitle" class="mt-1"></p>
            </div>

            <div>
                <span class="font-semibold">Description</span>
                <p id="viewDescription" class="mt-1 text-sm leading-relaxed"></p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <span class="font-semibold">Salary From</span>
                    <p id="viewSalaryFrom" class="mt-1"></p>
                </div>

                <div>
                    <span class="font-semibold">Salary To</span>
                    <p id="viewSalaryTo" class="mt-1"></p>
                </div>
            </div>

        </div>

        <!-- Actions -->
        <div class="flex justify-end mt-8">
            <button onclick="closeModal('viewModal')"
                class="px-6 py-2 rounded-full bg-white/20 hover:bg-white/30
                       transition font-semibold">
                Close
            </button>
        </div>

    </div>
</div>



<!-- EDIT MODAL -->
<div id="editModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

    <div
        class="bg-white/15 backdrop-blur-lg border border-white/20 
                rounded-2xl shadow-xl w-full max-w-lg p-6 text-white">

        <h3 class="text-2xl font-bold mb-6">Edit Job</h3>

        <form id="editForm" class="space-y-4">
            <input type="hidden" id="editUuid">

            <div>
                <label class="block mb-1 font-semibold">Title</label>
                <input id="editTitle"
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                           text-white focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea id="editDescription" rows="4"
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                           text-white focus:outline-none focus:ring-2 focus:ring-blue-300"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Salary From</label>
                    <input id="editFrom" type="number"
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                               text-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Salary To</label>
                    <input id="editTo" type="number"
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                               text-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal('editModal')"
                    class="px-6 py-2 rounded-full bg-white/20 hover:bg-white/30
                           transition font-semibold">
                    Cancel
                </button>

                <button type="submit"
                    class="px-6 py-2 rounded-full bg-blue-600 hover:bg-blue-700
                           transition font-semibold shadow">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
