<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form']);
    }

    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel
            ->select('users.*, roles.name as role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->where('username', $username)
            ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Login gagal');
        }

        session()->set([
            'user_id'   => $user['id'],
            'name'      => $user['name'],
            'role_id'   => $user['role_id'],
            'role_name' => $user['role_name'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->remove([
            'user_id',
            'name',
            'role_id',
            'role_name',
            'logged_in'
        ]);

        session()->destroy();

        return redirect()->to('/login');
    }
}