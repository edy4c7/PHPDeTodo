<?php
/**
 * Todo
 */
class Todo
{
    public $id;
    public $text;
    public $isDone;

    function __construct(?int $id, string $text, bool $isDone = false)
    {
        $this->id = $id;
        $this->text = $text;
        $this->isDone = $isDone;
    }
}
/* End of file todo.php */
