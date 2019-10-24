<?php
require_once('models/todo.php');
require_once('models/repositories/todo_repository.php');
require_once('utils/db.php');
try {
    $dao = new TodoRepository(getPDO());
    $items = $dao->findAll();
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>php de todo</title>
</head>

<body>
    <div class="container">
        <h1>PHP De Todo</h1>
        <form action="create.php" method="post">
            <div class="input-group">
                <input class="form-control" type="text" name="text" id="text">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" name="submit">Add</button>
                </div>
            </div>
        </form>
        <ul class="todo-list list-group">
            <?php foreach ($items as $item) : ?>
                <li class="todo-item list-group-item <?= $item->isDone ? 'list-group-item-dark' : '' ?>" data-todo-id="<?= $item->id ?>">
                    <input type="checkbox" name="done" class="chk-done" <?= $item->isDone ? 'checked' : '' ?>>
                    <?= htmlspecialchars($item->text) ?>
                    <button name="delete" class="btn btn-danger btn-delete">delete</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>
