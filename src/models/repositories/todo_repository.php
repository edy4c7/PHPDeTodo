<?php
require_once('repository.php');

class TodoRepository implements Repository {
    private $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function __destruct()
    {
        $this->pdo = null;
    }

    public function findAll()
    {
        $sql = 'select * from todo order by done';
        foreach ($this->pdo->query($sql) as $r) {
            yield new Todo($r['id'], $r['text'], $r['done']);
        }
    }

    public function findById($id)
    {
        $sql = 'select * from todo where id=:id';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':id' => $id]);
        $result = $sth->fetch();
        return new Todo((int) $result['id'], $result['text'], $result['done']);
    }

    public function save($entity)
    {
        if ($entity->id === null) {
            $sql = 'insert into todo (text, done) values (?,?);';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([
                $entity->text,
                (int) $entity->isDone
            ]);
        } else {
            $sql = 'update todo set done = :done where id = :id;';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([
                ':done' => (int) $entity->isDone,
                ':id' => $entity->id,
            ]);
        }
    }

    public function delete($id)
    {
        $sql = 'delete from todo where id = :id;';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            ':id' => $id,
        ]);
    }
}
