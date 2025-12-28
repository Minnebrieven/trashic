<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\Rekening;

class ScoreboardController extends Controller
{
    public function index(Request $request) 
    {
        $users = Rekening::with('user')->orderByDesc('score')->get();

        // Tambahkan peringkat dan tandai user aktif
        $ranked = $users->values()->map(function ($user, $index) {
            $user->rank = $index + 1;
            return $user;
        });
    
        return view('public.scoreboard.index', compact('ranked'));
    }
}
