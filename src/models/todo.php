<?php
require_once('model.php');
/**
 * Todo
 */
class Todo extends Model
{
  public $text;
  public $isCompleted;

  function __construct(PDO $pdo, string $text, bool $isCompleted = false)
  {
    parent::__construct($pdo);
    $this->text = $text;
    $this->isCompleted = $isCompleted;
  }

  public static function all(PDO $pdo)
  {
    $sql = 'select * from todo';
    foreach($pdo->query($sql) as $r){
      yield new Todo($pdo, $r['text'], $r['is_completed']);
    }
  }      
   
  public function save() 
  {
    $sql = 'insert into todo (text, is_completed) values (?,?);';
    $sth = $this->pdo->prepare($sql);
    $sth->execute([
      $this->text,
      (int) $this->isCompleted  
    ]);
  }

  public function delete() {}
}
/* End of file todo.php */
