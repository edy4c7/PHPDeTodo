<?php
require_once('model.php');
/**
 * Todo
 */
class Todo extends Model
{
    public $id;
    public $text;
    public $isCompleted;

    function __construct(PDO $pdo, ?int $id, string $text, bool $isCompleted = false)
    {
        parent::__construct($pdo);
        $this->id = $id;
        $this->text = $text;
        $this->isCompleted = $isCompleted;
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public static function all(PDO $pdo)
    {
        $sql = 'select * from todo order by is_completed';
        foreach ($pdo->query($sql) as $r) {
            yield new Todo($pdo, $r['id'], $r['text'], $r['is_completed']);
        }
    }

    public static function find(PDO $pdo, int $id)
    {
        $sql = 'select * from todo where id=:id';
        $sth = $pdo->prepare($sql);
        $sth->execute([':id' => $id]);
        $result = $sth->fetch();
        return new Todo($pdo, (int) $result['id'], $result['text'], $result['is_completed']);
    }

    public function save()
    {
        if ($this->id === null) {
            $sql = 'insert into todo (text, is_completed) values (?,?);';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([
                $this->text,
                (int) $this->isCompleted
            ]);
        } else {
            $sql = 'update todo set is_completed = :is_completed where id = :id;';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([
                ":is_completed" => (int)$this->isCompleted,
                ":id" => $this->id,
            ]);
        }
    }

    public function delete()
    {
        $sql = 'delete from todo where id = :id;';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            ":id" => $this->id,
        ]);
    }
}
/* End of file todo.php */
