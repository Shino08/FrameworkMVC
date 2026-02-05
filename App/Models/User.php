<?php
declare(strict_types=1);

namespace App\Models;

use Lib\Model;

class User extends Model
{
    /**
     * Simula una búsqueda en la base de datos por email
     * @param string $email
     * @return array|null Retorna el usuario o null si no existe
     */
    public function findByEmail(string $email): ?array
    {
        // --- AQUÍ IRÍA TU CONSULTA SQL REAL ---
        // $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        // $stmt->execute(['email' => $email]);
        // return $stmt->fetch();

        // --- SIMULACIÓN DE DATOS ---
        // Imaginemos que esto viene de la base de datos
        $usersBaseDeDatos = [
            [
                'id' => 1,
                'email' => 'admin@test.com',
                'password' => '123456', // En la realidad, esto sería un hash
                'name' => 'Administrador'
            ],
            [
                'id' => 2,
                'email' => 'juan@test.com',
                'password' => 'secret',
                'name' => 'Juan Perez'
            ]
        ];

        foreach ($usersBaseDeDatos as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }

        return null;
    }

    public function register(string $email, string $name, string $lastname, string $password): ?array
    {
        $userRegister = [
            [
                'id' => 1,
                'lastname' => 'guillermo',
                'email' => 'admin@test.com',
                'password' => '123456',
                'name' => 'Administrador'
            ]
        ];

        foreach ($userRegister as $userR) {
            if ($userR['email'] === $email && $userR['name'] === $name && $userR['lastname'] === $lastname 
            && $userR['password'] === $password 
            ) 
            {
                return $userR;
            }
        }

        return null;
    }
}
