<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Login | Website Peluang Matematika',
            'validation' => $validation
        ];
        return view('auth', $data);
    }
    public function aksi_login()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[15]',
                'errors' => [
                    'required'     => 'Password wajib diisi.',
                    'min_length'   => 'Password minimal 6 karakter.',
                    'max_length'   => 'Password maksimal 15 karakter.',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }


        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        // ❌ Username tidak ditemukan
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Akun tidak ditemukan.');
        }

        // ❌ User nonaktif
        if ($user['is_active'] == 0) {
            return redirect()->back()->withInput()->with('error', 'Akun Anda tidak aktif.');
        }

        // ❌ Password salah
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah.');
        }

        // ✔ Set session user
        session()->set([
            'user_id'   => $user['id_user'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        // ✔ Redirect berdasarkan role
        switch ($user['role']) {
            case 'admin':
                return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
            case 'user':
                return redirect()->to('/user/dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect()->to('/')->with('warning', 'Role tidak dikenali.');
        }
    }

    // register
    public function register()
    {
        $validation = \Config\Services::validation();
        $data = [
            'title' => 'Register | Website Peluang Matematika',
            'validation' => $validation
        ];
        return view('register', $data);
    }
    public function aksi_register()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|is_unique[tb_user.username]',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                    'min_length' => 'Minimal 3 karakter.',
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[tb_user.email]',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Minimal 6 karakter.'
                ]
            ],
            'password_confirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_ARGON2ID),
            'role'     => 'user', // default
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/auth/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda berhasil logout.');
    }
}
