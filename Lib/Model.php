<?php
declare(strict_types=1);

namespace Lib;

class Model
{
    protected $db;

    public function __construct()
    {
        // En una app real, instanciarías la conexión PDO aquí
        // $this->db = new \PDO('mysql:host=localhost;dbname=test', 'root', '');
    }
}
