<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conteudo;

class TinymceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tinymce');
    }

    public function salvar(Request $request)
    {
        $conteudo = $request->input('conteudo');
        $name = $request->input('name');
        Conteudo::create(['conteudo' => $conteudo]);
        return redirect('/home');
    }
}
