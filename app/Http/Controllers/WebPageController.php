<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebPageController extends Controller
{
    public function dashboard()
    {
        $apiToken = Auth::user()->createToken('auth_token')->plainTextToken;
        \Log::info('API Token: ' . $apiToken);

        $data = array(
            'apiToken' => $apiToken,
            'coba' => 'testing aja',
        );
        return view('admin.dashboard', $data);
    }
}
