<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->checkLogin();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('dashboard');
    }
}