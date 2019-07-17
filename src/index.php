<?php
    require_once('models/todo.php'); 
    require_once('db.php');
    try {
        $items = Todo::all(getPDO());
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>php de todo</title>
</head>
<body>
    <form action="create.php" method="post">
        <input type="text" name="text" id="text">
        <button type="submit" name="submit">Add</button>
    </form>
    <ul>
        <?php foreach($items as $item): ?>
        <li>
            <span class="<?= $item->isCompleted ? 'completed' : ''?>"><?= htmlspecialchars($item->text); ?></span>
            <a href="update.php?id=<?= $item->id?>"><?= $item->isCompleted ? 'undone': 'done'?></a>
            <a href="delete.php?id=<?= $item->id?>">delete</a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
