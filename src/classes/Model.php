<?php

namespace App;

use Exception;
use PDO;

abstract class Model
{
    /**
     * @var string
     */
    protected $table;
    
    /**
     * @var Connection
     */
    protected $db;


    public function __construct(Connection $db)
    {
        if (empty($this->table)) {
            throw new Exception('$table must be set in: ' . get_class($this) . PHP_EOL);
        }
        $this->db = $db;
    }

}
