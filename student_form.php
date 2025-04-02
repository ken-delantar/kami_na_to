<?php require_once 'includes/header.php'; ?>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Add New Student</h2>

    <form method="post" action="./back-end/student_form.php">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Student Number *</label>
                <input type="text" name="student_number" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full name *</label>
                <input type="text" name="Fullname" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">LRN *</label>
                <input type="text" name="LRN" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Grade Level *</label>
                <select name="grade_level" class="w-full border rounded p-2" required>
                    <option value="11">Grade 11</option>
                    <option value="12">Grade 12</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Strand</label>
                <select name="strand_id" class="w-full border rounded p-2">
                    <option value="">Select Strand</option>
                    <option value="1">STEM</option> <!-- Placeholder data -->
                    <option value="2">ABM</option>
                    <option value="3">HUMSS</option>
                    <option value="4">GAS</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                <select name="section_id" class="w-full border rounded p-2">
                    <option value="">Select Section</option>
                    <option value="1">Section 1</option> <!-- Placeholder data -->
                    <option value="2">Section 2</option>
                    <option value="3">Section 3</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">School Year</label>
                <select name="school_year_id" class="w-full border rounded p-2">
                    <option value="">Select School Year</option>
                    <option value="1">2024-2025</option> <!-- Placeholder data -->
                    <option value="2">2023-2024</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">School Origin</label>
                <select name="school_origin" class="w-full border rounded p-2">
                    <option value="">School Origin</option>
                    <option value="1">Public</option> <!-- Placeholder data -->
                    <option value="2">Private</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="school_year_id" class="w-full border rounded p-2">
                    <option value="">Category</option>
                    <option value="1">VPB</option> <!-- Placeholder data -->
                    <option value="2">Payee</option>
                    <option value="3">Pending</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="">Status</option>
                    <option value="1">Active</option> <!-- Placeholder data -->
                    <option value="2">Inactive</option>
                </select>
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Billing Status</label>
                <select name="school_year_id" class="w-full border rounded p-2">
                    <option value="">Billing Status</option>
                    <option value="1">Billing</option> <!-- Placeholder data -->
                    <option value="2">Not-billing</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sex</label>
                <select name="sex" class="w-full border rounded p-2">
                    <option value="">Sex</option>
                    <option value="1">Male</option> <!-- Placeholder data -->
                    <option value="2">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">condition</label>
                <select name="condition" class="w-full border rounded p-2">
                    <option value="">NA</option>
                    <option value="1">Nomral</option> <!-- Placeholder data -->
                    <option value="2">PWD</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Year End Status</label>
                <select name="school_year_id" class="w-full border rounded p-2">
                    <option value="">Year End Status</option>
                    <option value="1">Passed</option> <!-- Placeholder data -->
                    <option value="2">Failed</option>
                    <option value="3">NA</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start of Class</label>
                    <input type="text" name="" class="w-full border rounded p-2">
                </select>
            </div>


        <div class="mt-6 flex justify-end space-x-3">
            <a href="students.php" class="bg-gray-300 text-gray-800 px-3 py-2 rounded mr-3 hover:bg-gray-400 transition">
                Cancel
            </a>
            <button type="submit" class="bg-blue-600 text-white px-1 py-2 rounded hover:bg-blue-700 transition">
                Add Student
            </button>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
