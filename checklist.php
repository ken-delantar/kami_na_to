<?php
// Data persistence using a file
define('TASK_FILE', 'tasks.json');

// Load tasks from file
function loadTasks() {
    if (file_exists(TASK_FILE)) {
        return json_decode(file_get_contents(TASK_FILE), true) ?: [];
    }
    return [];
}

// Save tasks to file
function saveTasks($tasks) {
    file_put_contents(TASK_FILE, json_encode($tasks));
}

// Initialize tasks
$tasks = loadTasks();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task'])) {
        $tasks[] = ['name' => $_POST['task'], 'completed' => false];
        saveTasks($tasks);
    } elseif (isset($_POST['toggle'])) {
        $index = $_POST['toggle'];
        $tasks[$index]['completed'] = !$tasks[$index]['completed'];
        saveTasks($tasks);
    } elseif (isset($_POST['remove'])) {
        array_splice($tasks, $_POST['remove'], 1);
        saveTasks($tasks);
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel-like Checklist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            padding: 20px;
        }
        .container {
            width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .completed td {
            text-decoration: line-through;
            color: gray;
        }
        input[type="checkbox"] {
            transform: scale(1.5);
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
            display: block;
            width: 100%;
            text-align: center;
        }
        .btn:hover {
            background-color: #218838;
        }
        .delete-btn {
            background-color: #dc3545;
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            color: white;
            border-radius: 4px;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Document Checklist</h2>
        
        <!-- Add new task form -->
        <form method="POST">
            <input type="text" name="task" placeholder="Enter new task" required>
            <button type="submit" class="btn">Add Task</button>
        </form>
        
        <!-- Display tasks in an Excel-like table -->
        <table>
            <thead>
                <tr>
                    <th>✔</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $index => $task): ?>
                    <tr class="<?php echo $task['completed'] ? 'completed' : ''; ?>">
                        <td>
                            <form method="POST">
                                <input type="hidden" name="toggle" value="<?php echo $index; ?>">
                                <input type="checkbox" onclick="this.form.submit()" <?php echo $task['completed'] ? 'checked' : ''; ?>>
                            </form>
                        </td>
                        <td><?php echo htmlspecialchars($task['name']); ?></td>
                        <td>
                            <form method="POST">
                                <button type="submit" name="remove" value="<?php echo $index; ?>" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
