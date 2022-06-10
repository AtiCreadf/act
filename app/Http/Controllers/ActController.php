<?php

namespace App\Http\Controllers;

use App\Models\Act;

class ActController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Act $act)
    {
        $this->middleware('auth');
        $this->repositorio = $act;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $acts = $this->repositorio->orderBy('TX_ORGAO')->get();
        return view('act.index', compact('acts'));
    }
}
