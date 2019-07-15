<?php
require_once(dirname(__FILE__) . '/../src/models/todo.php');
use PHPUnit\Framework\TestCase;

class TodoTest extends TestCase{
  public function testGetAll()
  {
    $pdo = $this->getMockBuilder(PDO::class)
                ->disableOriginalConstructor()
                ->setMethods(['query'])
                ->getMock();
    
    $pdo->expects($this->once())
        ->method('query')
        ->with($this->equalTo('select * from todo'));
    
    Todo::getAll($pdo);
  } 
}
/* End of file todo_test.php */
