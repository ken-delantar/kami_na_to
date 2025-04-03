<?php
session_start();

define('CHECKLIST_FILE', 'checklist.json');

// Load checklist from file
function loadChecklist() {
    return file_exists(CHECKLIST_FILE) ? json_decode(file_get_contents(CHECKLIST_FILE), true) : [];
}

// Save checklist to file
function saveChecklist($checklist) {
    file_put_contents(CHECKLIST_FILE, json_encode($checklist, JSON_PRETTY_PRINT));
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checklist = loadChecklist();

    if (isset($_POST['toggle'])) {
        $item = $_POST['toggle'];
        $checklist[$item] = !$checklist[$item];
    } elseif (isset($_POST['delete'])) {
        unset($checklist[$_POST['delete']]);
    } elseif (isset($_POST['new_item'])) {
        $newItem = trim($_POST['new_item']);
        if (!empty($newItem) && !isset($checklist[$newItem])) {
            $checklist[$newItem] = false;
        }
    }

    saveChecklist($checklist);
    echo json_encode($checklist);
    exit;
}

// Load checklist for initial display
$checklist = loadChecklist();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Checklist</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f8f9fa; }
        .container { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #007bff; color: white; }
        .btn { padding: 8px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-primary { background: #007bff; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .delete-btn { cursor: pointer; color: red; font-size: 14px; border: none; background: none; }
        .input-group { display: flex; gap: 5px; margin-top: 10px; }
        .input-group input { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.check-item').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateChecklist("toggle", this.dataset.item);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    updateChecklist("delete", this.dataset.item);
                });
            });

            document.querySelector("#addItemForm").addEventListener("submit", function(event) {
                event.preventDefault();
                let newItem = document.querySelector("#newItemInput").value.trim();
                if (newItem) {
                    updateChecklist("new_item", newItem);
                    document.querySelector("#newItemInput").value = "";
                }
            });
        });

        function updateChecklist(action, item) {
            let formData = new FormData();
            formData.append(action, item);

            fetch("index.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                renderChecklist(data);
            })
            .catch(error => console.error("Error:", error));
        }

        function renderChecklist(data) {
            let tableBody = document.querySelector("#checklistBody");
            tableBody.innerHTML = "";

            for (let item in data) {
                let checked = data[item] ? "checked" : "";
                tableBody.innerHTML += `
                    <tr>
                        <td><input type="checkbox" class="check-item" data-item="${item}" ${checked}></td>
                        <td>${item}</td>
                        <td><button class="delete-btn" data-item="${item}">❌</button></td>
                    </tr>
                `;
            }

            // Reattach event listeners
            document.querySelectorAll('.check-item').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateChecklist("toggle", this.dataset.item);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    updateChecklist("delete", this.dataset.item);
                });
            });
        }
    </script>
</head>
<body>

<div class="container">
    <h2>My Checklist</h2>

    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Item</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="checklistBody">
            <?php foreach ($checklist as $item => $checked): ?>
                <tr>
                    <td><input type="checkbox" class="check-item" data-item="<?= htmlspecialchars($item) ?>" <?= $checked ? 'checked' : '' ?>></td>
                    <td><?= htmlspecialchars($item) ?></td>
                    <td><button class="delete-btn" data-item="<?= htmlspecialchars($item) ?>">❌</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form id="addItemForm" class="input-group">
        <input type="text" id="newItemInput" placeholder="Add new item..." required>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

</body>
</html>
