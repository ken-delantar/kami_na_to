<?php
    // include '../includes/db_connection.php';
    include './includes/db_connection.php';
    require_once 'includes/header.php';

    //Strand
    $sql = "SELECT * FROM strands";
    $strands = executeQuery($sql);
    $strands = $strands->fetchAll(PDO::FETCH_ASSOC);

    //School Year
    $sql = "SELECT * FROM school_years";
    $school_years = executeQuery($sql);
    $school_years = $school_years->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Grade 11 Students</h2>
        <a href="student_form.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-user-plus mr-2"></i> Add Student
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Strand</label>
            <select id="strandSelect" onchange="handleStrandSelection(this)" class="w-full border rounded p-2">
                <option value="">All Strands</option>
                <?php foreach ($strands as $row): ?>
                    <option value="<?= htmlspecialchars($row['strand']) ?>">
                        <?= htmlspecialchars($row['strand']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="add">+ Add</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
            <select id="sectionSelect" onchange="handleSectionSelection(this)" class="w-full border rounded p-2">
                <option value="">All Sections</option>
                <?php foreach ($strand as $row): ?>
                    <option value="<?= htmlspecialchars($row['strand']) ?>">
                        <?= htmlspecialchars($row['strand']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="add">+ Add</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">School Year</label>
            <select id="schoolYearSelect" onchange="handleSchoolYearSelection(this)" class="w-full border rounded p-2">
                <option value="">All Years</option>
                <?php foreach ($school_years as $row): ?>
                    <option value="<?= htmlspecialchars($row['year_start']) . ' - ' . htmlspecialchars($row['year_end']) ?>">
                        <?= htmlspecialchars($row['year_start']) . ' - ' . htmlspecialchars($row['year_end']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="add">+ Add</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <form method="get" class="flex">
                <input type="text" name="search" placeholder="Search students..." class="flex-1 border rounded-l p-2">
                <button type="submit" class="bg-blue-600 text-white px-4 rounded-r hover:bg-blue-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Students Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LRN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Strand</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>    
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">123456</td>
                    <td class="px-6 py-4 whitespace-nowrap">S001</td>
                    <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap">Section A</td>
                    <td class="px-6 py-4 whitespace-nowrap">STEM</td>
                    <td class="px-6 py-4 whitespace-nowrap">Grade 11</td>
                    <td class="px-6 py-4 whitespace-nowrap">Good</td>
                    <td class="px-6 py-4 whitespace-nowrap">Active</td>
                    <td class="px-6 py-4 whitespace-nowrap">Regular</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="student_form.php?id=1" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="documents.php?student_id=1" class="text-green-600 hover:text-green-900 mr-3">
                            <i class="fas fa-file-alt"></i>
                        </a>
                        <a href="delete_student.php?id=1" onclick="return confirmDelete()" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modals -->
<!-- Strand Modal -->
<div id="addStrand" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add New Strand</h2>

        <form action="/back-end/student.php" method="POST">
            <input type="hidden" name="action" value="addStrand">
            
            <input type="text" name="strand" class="w-full border rounded p-2 mb-4" placeholder="Enter new strand">
            <div class="flex justify-end space-x-2">
                <button onclick="closeModal('addStrand')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Section Modal -->
<div id="addSection" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add New Section</h2>
        <div class="flex justify-end space-x-2">
            <form action="/back-end/student.php" method="POST">
                <input type="hidden" name="action" value="addSection">

                <select name="school_year" class="w-full border rounded p-2 mb-4">
                    <?php foreach ($school_years as $row): ?>
                        <option value="<?= htmlspecialchars($row['id']) ?>">
                            <?= htmlspecialchars($row['year_start']) . ' - ' . htmlspecialchars($row['year_end']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="strand" class="w-full border rounded p-2 mb-4">
                    <?php foreach ($strands as $row): ?>
                        <option value="<?= htmlspecialchars($row['id']) ?>">
                            <?= htmlspecialchars($row['strand']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="grade_level" class="w-full border rounded p-2 mb-4">
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                </select>

                <input type="number" name="section" placeholder="Section Name" class="w-full border rounded p-2 mb-4">

                <div class="flex justify-end space-x-2">
                    <button onclick="closeModal('addStrand')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Insert</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- School Year Modal -->
<div id="addSchoolYear" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add School Year</h2>

        <form action="/back-end/student.php" method="POST">
            <input type="hidden" name="action" value="addSchoolYear" class="w-full border rounded p-2 mb-4">
            <input type="number" name="year_start" placeholder="Year Start" class="w-full border rounded p-2 mb-4">
            <input type="number" name="year_end" placeholder="Year End" class="w-full border rounded p-2 mb-4">
            <input type="date" name="class_start" placeholder="Class Start">
            <div class="flex justify-end space-x-2">
                <button onclick="closeModal('addStrand')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
function handleStrandSelection(select) {
    if (select.value === "add") {
        select.value = "";
        document.getElementById("addStrand").classList.remove("hidden");
    }
}

function handleSectionSelection(select) {
    if (select.value === "add") {
        select.value = "";
        document.getElementById("addSection").classList.remove("hidden");
    }
}

function handleSchoolYearSelection(select) {
    if (select.value === "add") {
        select.value = "";
        document.getElementById("addSchoolYear").classList.remove("hidden");
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
}

function saveSection() {
    let newSection = document.getElementById("newSection").value;
    if (newSection.trim() !== "") {
        alert("New Section Added: " + newSection);
        closeModal('addSection');
    } else {
        alert("Please enter a section name.");
    }
}

function saveSchoolYear() {
    let newSchoolYear = document.getElementById("newSchoolYear").value;
    if (newSchoolYear.trim() !== "") {
        alert("New School Year Added: " + newSchoolYear);
        closeModal('addSchoolYear');
    } else {
        alert("Please enter a school year.");
    }
}
</script>

<?php require_once 'includes/footer.php'; ?>
