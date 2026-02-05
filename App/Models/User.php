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
        // 1. Validar si el usuario ya existe (usando la "base de datos" simulada)
        if ($this->findByEmail($email)) {
            return null; // El usuario ya existe
        }

        // 2. Crear el nuevo usuario (Simulación)
        // En una app real, aquí haríamos: $this->db->query("INSERT INTO users...")
        return [
            'id' => rand(3, 100), // ID aleatorio simulado
            'email' => $email,
            'password' => $password, // En producción debe ser hasheado
            'name' => $name,
            'lastname' => $lastname
        ];
    }
}
