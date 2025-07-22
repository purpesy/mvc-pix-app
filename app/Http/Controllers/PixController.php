<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Pix;

class PixController extends Controller
{
    public function generate(Request $request)
    {
        $user = $request->user();

        $pix = $user->pix()->create([
            'token' => (string) Str::uuid(),
            'status' => 'generated',
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        return response()->json([
            'token' => $pix->token,
            'status' => $pix->status,
            'expires_at' => $pix->expires_at->toIso8601String(),
            'link' => url('/pix/' . $pix->token),
        ], 201);
    }

    
}
