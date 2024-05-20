<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $data = [
            'judul' => 'Dashboard123',
            'menu' => 'dashboard',
            'page' => 'dashboard/v_dashboard',
        ];
        return view('v_template', $data);
    }
}
