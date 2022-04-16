<?php

require_once 'config.php';

$task_id = $_POST['task_id'];

$query = "DELETE FROM tasks WHERE id = $task_id";

$tasks = mysqli_query($connection, $query);

if($tasks) {
    $result = [
        'response' => '200',
        'message' => 'Task Deleted'
    ];
    echo json_encode($result);
} else {
    return $result = [
        'response' => '500',
        'message' => 'Task failed to delete'
    ];
    echo json_encode($result);
}
?>