<?php

require_once 'config.php';

$title = $_POST['task_title'];

$query = "INSERT INTO tasks (title) VALUES ('$title')";
$tasks = mysqli_query($connection, $query);

if($tasks) {
    $result = [
        'response' => '200',
        'message' => 'New Task Created'
    ];
    echo json_encode($result);
} else {
    return $result = [
        'response' => '500',
        'message' => 'Task failed to create'
    ];
    echo json_encode($result);
}
?>