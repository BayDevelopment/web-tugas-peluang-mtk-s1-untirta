<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function dashboard()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');

        $data = [
            'title' => 'Dashboard Admin | Website Peluang Matematika',
            'user'  => [
                'username' => $username
            ],
        ];

        return view('templates/users/dashboard', $data);
    }
}
