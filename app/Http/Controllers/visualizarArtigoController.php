<?php

namespace App\Http\Controllers;
use App\Models\Creator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Content;

class visualizarArtigoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'sendEmail']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('visualizarArtigo');
    }

    public function show($id)
    {
        $content = Creator::find($id);

        $content->increment('views');

        return view('visualizarArtigo', ['content' => $content]);
    }

    public function sendEmail(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $content = Creator::find($id); // Busca os dados do banco de dados

        Mail::send('emails.email-template', [
            'subject' => $content->subject,
            'name' => $content->name,
            'email_message' => $content->message,
            'id' => $id
        ], function ($email_message) use ($request) {
            $email_message->to($request->input('email'))
                          ->subject('Base de conhecimento SGBR!')
                          ->from('testes.sgbr@gmail.com', 'SGBR Sistemas');
        });

        // Armazenar a mensagem de sucesso na sessão
        $request->session()->flash('success', 'E-mail enviado com sucesso!');

        // Redirecionar para a página de sucesso
        return redirect()->back();
    }
}
