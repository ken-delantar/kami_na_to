<?php
    include './includes/db_connection.php';
    require_once 'includes/header.php';

    // Fetch strands
    $sql = "SELECT * FROM strands";
    $strands = executeQuery($sql);
    $strands = $strands->fetchAll(PDO::FETCH_ASSOC);

    // Fetch school years
    $sql = "SELECT * FROM school_years";
    $school_years = executeQuery($sql);
    $school_years = $school_years->fetchAll(PDO::FETCH_ASSOC);

    // Fetch sections
    $sql = "SELECT * FROM sections";
    $sections = executeQuery($sql);
    $sections = $sections->fetchAll(PDO::FETCH_ASSOC);

    // Initialize filtering conditions
    $whereClauses = [];
    $params = [];

    // Handle filters
    if (!empty($_GET['strand'])) {
        $whereClauses[] = "strand = :strand";
        $params[':strand'] = $_GET['strand'];
    }

    if (!empty($_GET['section'])) {
        $whereClauses[] = "section_name = :section";
        $params[':section'] = $_GET['section'];
    }

    if (!empty($_GET['school_year'])) {
        $schoolYear = explode(' - ', $_GET['school_year']);
        $whereClauses[] = "school_year_start = :year_start AND school_year_end = :year_end";
        $params[':year_start'] = $schoolYear[0];
        $params[':year_end'] = $schoolYear[1];
    }

    if (!empty($_GET['search'])) {
        $whereClauses[] = "name LIKE :search";
        $params[':search'] = '%' . $_GET['search'] . '%';
    }

    // Construct SQL query
    $sql = "SELECT * FROM students";
    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(" AND ", $whereClauses);
    }

    // Execute the query with the filtering parameters
    $students = executeQuery($sql, $params);
    $students = $students->fetchAll(PDO::FETCH_ASSOC);
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
            <select name="strand" class="w-full border rounded p-2" onchange="this.form.submit()">
                <option value="">All Strands</option>
                <?php foreach ($strands as $row): ?>
                    <option value="<?= htmlspecialchars($row['strand']) ?>" <?= isset($_GET['strand']) && $_GET['strand'] == $row['strand'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['strand']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="add">+ Add</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
            <select name="section" class="w-full border rounded p-2" onchange="this.form.submit()">
                <option value="">All Sections</option>
                <?php foreach ($sections as $row): ?>
                    <option value="<?= htmlspecialchars($row['section_name']) ?>" <?= isset($_GET['section']) && $_GET['section'] == $row['section_name'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['section_name']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="add">+ Add</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">School Year</label>
            <select name="school_year" class="w-full border rounded p-2" onchange="this.form.submit()">
                <option value="">All Years</option>
                <?php foreach ($school_years as $row): ?>
                    <option value="<?= htmlspecialchars($row['year_start']) . ' - ' . htmlspecialchars($row['year_end']) ?>" <?= isset($_GET['school_year']) && $_GET['school_year'] == $row['year_start'] . ' - ' . $row['year_end'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['year_start']) . ' - ' . htmlspecialchars($row['year_end']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="add">+ Add</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <form method="get" class="flex">
                <input type="text" name="search" placeholder="Search students..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="flex-1 border rounded-l p-2" onchange="this.form.submit()">
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>    
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $student['lrn'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $student['id'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $student['name'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">Section A</td>
                        <td class="px-6 py-4 whitespace-nowrap">STEM</td>
                        <td class="px-6 py-4 whitespace-nowrap">Grade 11</td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $student['condition'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $student['status'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">Regular</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="documents.php?student_id=<?= $student['id'] ?>" class="text-green-600 hover:text-green-900 mr-3">
                                <i class="fas fa-file-alt"></i>
                            </a>
                            <a href="delete_student.php?id=<?= $student['id'] ?>" onclick="return confirmDelete()" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modals (Add Strand, Section, School Year) remain the same -->

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
