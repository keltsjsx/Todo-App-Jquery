<?php

require_once 'config.php';

$query = "SELECT * FROM tasks";
$tasks = mysqli_query($connection, $query);

if(mysqli_num_rows($tasks) > 0) {
    while($task = mysqli_fetch_assoc($tasks)) {
?>
    <li>
        <span class="text"><?= $task['title'] ?></span>
        <i class="icon fas fa-trash" data-id="<?= $task['id'] ?>" id="btnDelete"></i>
    </li>

<?php
    }
    echo '<div class="pending-text">You have '. mysqli_num_rows($tasks) .' <span class="text-danger">pending tasks</span></div>';
} else {
    echo "<li><span class='text'>No Records</span></li>";
}
?>