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
}
/* End of file model.php */
