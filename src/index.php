<?php
    require_once('models/todo.php'); 
    require_once('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>php de todo</title>
</head>
<body>
    <form action="create.php" method="post">
        <input type="text" name="text" id="text">
        <button type="submit">Add</button>
    </form>
    <?php foreach(Todo::getAll(getPDO()) as $item): ?>
    <p>
        <?php echo $item->text; ?>
        <input type="checkbox" name="completed" id="completed" <?php echo $item->isCompleted ? 'checked' : ''?>>
    </p>
    <?php endforeach; ?>
</body>
</html>
