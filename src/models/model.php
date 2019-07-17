<?php
/**
 * Model
 */
class Model
{
  protected $pdo;
  function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  function __destruct()
  {
    $this->pdo = null;
  }
}
/* End of file model.php */
