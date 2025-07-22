<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $generated = $user->pix()->where('status', 'generated')->count();
        $paid = $user->pix()->where('status', 'paid')->count();
        $expired = $user->pix()->where('status', 'expired')->count();

        return view('index', compact('generated', 'paid', 'expired'));
    }
}
