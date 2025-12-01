<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSedder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_ARGON2ID),
                'role'     => 'admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'user1',
                'email'    => 'user@gmail.com',
                'password' => password_hash('user123', PASSWORD_ARGON2ID),
                'role'     => 'user',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}
