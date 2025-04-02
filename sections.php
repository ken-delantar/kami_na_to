<?php require_once 'includes/header.php'; ?>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Manage Sections</h2>
    </div>

    <!-- Add Section Form -->
    <div class="mb-8 p-4 border border-gray-200 rounded-lg">
        <h3 class="text-lg font-medium mb-4">Add New Section</h3>
        <form method="post">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Section Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Grade Level</label>
                    <select name="grade_level" class="w-full border rounded p-2" required>
                        <option value="11">Grade 11</option>
                        <option value="12">Grade 12</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Add Section
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Sections List -->
    <h3 class="text-lg font-medium mb-4">Existing Sections</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Placeholder Data -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Section A</td>
                    <td class="px-6 py-4 whitespace-nowrap">Grade 11</td>
                    <td class="px-6 py-4 whitespace-nowrap">25</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="#" onclick="return confirmDelete()" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Section B</td>
                    <td class="px-6 py-4 whitespace-nowrap">Grade 12</td>
                    <td class="px-6 py-4 whitespace-nowrap">30</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="#" onclick="return confirmDelete()" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Section C</td>
                    <td class="px-6 py-4 whitespace-nowrap">Grade 12</td>
                    <td class="px-6 py-4 whitespace-nowrap">40</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="#" onclick="return confirmDelete()" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this section?");
}
</script>

<?php require_once 'includes/footer.php'; ?>
