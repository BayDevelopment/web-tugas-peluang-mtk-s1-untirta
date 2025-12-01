<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
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
            'navlink' => 'dashboard'
        ];

        return view('templates/users/dashboard', $data);
    }
    public function tentang_saya()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "Tentang Saya | Website Peluang Matematika",
            'navlink' => "tentang saya",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/users/tentang-saya', $data);
    }

    // pages
    public function kalkulator()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "Kalkulator Peluang | Website Peluang Matematika",
            'navlink' => "kalkulator",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/pages/kalkulator-peluang', $data);
    }
    public function simulasi_koin_dadu()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "Simulasi Koin & Dadu | Website Peluang Matematika",
            'navlink' => "simulasi",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/pages/simulasi-dadu-koin', $data);
    }
    public function bahan_ajar()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "Bahan Ajar Peluang | Website Peluang Matematika",
            'navlink' => "bahan ajar",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/pages/bahan-ajar', $data);
    }
    public function modul_ajar()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "Modul Ajar Peluang | Website Peluang Matematika",
            'navlink' => "modul ajar",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/pages/modul-ajar', $data);
    }

    public function lkpd_digital()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "LKPD Siap Cetak | Website Peluang Matematika",
            'navlink' => "lpkd",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/pages/lkpd-siapcetak', $data);
    }
    public function quiz()
    {
        $session = session();

        // Ambil session username
        $username = $session->get('username');
        $data = [
            'title' => "Quiz | Website Peluang Matematika",
            'navlink' => "quiz",
            'user'    => [
                'username' => $username
            ]
        ];
        return view('templates/pages/quiz', $data);
    }
}
