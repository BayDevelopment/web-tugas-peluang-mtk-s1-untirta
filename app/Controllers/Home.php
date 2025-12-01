<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome | Website Peluang Matematika'
        ];
        return view('welcome_message', $data);
    }
}
