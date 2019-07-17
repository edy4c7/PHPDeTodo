<?php
require_once('model.php');
/**
 * Todo
 */
class Todo extends Model
{
    public $id;
    public $text;
    public $isDone
;

    function __construct(PDO $pdo, ?int $id, string $text, bool $isDone = false)
    {
        parent::__construct($pdo);
        $this->id = $id;
        $this->text = $text;
        $this->isDone = $isDone
;
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public static function all(PDO $pdo)
    {
        $sql = 'select * from todo order by done';
        foreach ($pdo->query($sql) as $r) {
            yield new Todo($pdo, $r['id'], $r['text'], $r['done']);
        }
    }

    public static function find(PDO $pdo, int $id)
    {
        $sql = 'select * from todo where id=:id';
        $sth = $pdo->prepare($sql);
        $sth->execute([':id' => $id]);
        $result = $sth->fetch();
        return new Todo($pdo, (int) $result['id'], $result['text'], $result['done']);
    }

    public function save()
    {
        if ($this->id === null) {
            $sql = 'insert into todo (text, done) values (?,?);';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([
                $this->text,
                (int) $this->isDone
            ]);
        } else {
            $sql = 'update todo set done = :done where id = :id;';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([
                ":done" => (int)$this->isDone,
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
