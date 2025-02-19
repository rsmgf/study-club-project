<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #e3f2fd;
        }
        h2 {
            text-align: center;
            color: #1565c0;
        }
        .task-list, .history-list {
            background: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .task-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .task-item input[type="checkbox"] {
            margin-right: 10px;
        }
        .task-item span {
            flex-grow: 1;
            font-size: 16px;
        }
        .task-item button {
            background: none;
            border: none;
            cursor: pointer;
        }
        .task-item button img {
            width: 20px;
            height: 20px;
        }
        .completed {
            text-decoration: line-through;
            color: gray;
        }
        #add-task {
            display: flex;
            margin: 10px 0;
        }
        #task-input {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #1565c0;
            border-radius: 4px;
        }
        #add-button {
            background: #1565c0;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <h2>To-Do List</h2>
    
    <div id="add-task">
        <input type="text" id="task-input" placeholder="Add a new task">
        <button id="add-button" onclick="addTask()">+</button>
    </div>
    
    <div class="task-list">
        <h3>Tasks to Do</h3>
        <div id="tasks"></div>
    </div>
    
    <div class="history-list">
        <h3>History</h3>
        <div id="history"></div>
    </div>
    
    <script>
        let tasks = ["Learn JavaScript", "Complete Homework"];
        let history = ["Read a Book"];
        
        function renderTasks() {
            let taskContainer = document.getElementById("tasks");
            taskContainer.innerHTML = "";
            
            tasks.forEach((task, index) => {
                let div = document.createElement("div");
                div.classList.add("task-item");
                div.innerHTML = `
                    <input type="checkbox" onclick="completeTask(${index})">
                    <span>${task}</span>
                    <button onclick="deleteTask(${index})">
                        <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete">
                    </button>
                `;
                taskContainer.appendChild(div);
            });
        }
        
        function renderHistory() {
            let historyContainer = document.getElementById("history");
            historyContainer.innerHTML = "";
            
            history.forEach(task => {
                let div = document.createElement("div");
                div.classList.add("task-item", "completed");
                div.innerHTML = `
                    <input type="checkbox" checked disabled>
                    <span>${task}</span>
                `;
                historyContainer.appendChild(div);
            });
        }
        
        function completeTask(index) {
            let completedTask = tasks.splice(index, 1)[0];
            history.push(completedTask);
            renderTasks();
            renderHistory();
        }
        
        function deleteTask(index) {
            tasks.splice(index, 1);
            renderTasks();
        }
        
        function addTask() {
            let taskInput = document.getElementById("task-input");
            let newTask = taskInput.value.trim();
            if (newTask) {
                tasks.push(newTask);
                taskInput.value = "";
                renderTasks();
            }
        }
        
        renderTasks();
        renderHistory();
    </script>
</body>
</html>
