<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creators = Creator::paginate(10);

        return $creators;
    }

    public function mostAccessedArticlesReport()
    {
        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('-30 days'));
    
        $mostAccessedArticles = Creator::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('views', 'desc')
            ->get();
    
        return view('report.most-accessed-articles', [
            'mostAccessedArticles' => $mostAccessedArticles,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $conteudo = $request->input('conteudo');
        $subject = $request->input('subject');
        Creator::create([
            'name' => $name,
            'subject' => $subject,
            'conteudo' => $conteudo,
        ]);
        return redirect('/home?registroadicionado=true');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function show(Creator $creator)
    {
        return $creator;
    }

    public function edit($id)
    {
        $post = Creator::find($id);
        return view('tinymce', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $creator = Creator::find($id);
        $creator->fill($request->all());
        $creator->save();
        return redirect('/home?registroatualizado=true');
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        if ($id) {
            $creator = Creator::find($id);
            $creator->fill($request->all());
            $creator->save();
            return redirect('/home?registroatualizado=true');
        } else {
            $creator = new Creator;
            $creator->fill($request->all());
            $creator->save();
            return redirect('/home?registroadicionado=true');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creator = Creator::findOrFail($id);
        $creator->delete();
        return response()->json(['message' => 'Registro excluído com sucesso.']);
    }

    public function search(Request $request)
    {
    $term = $request->input('term');

    $creators = Creator::where('subject', 'like', '%' . $term . '%')
    ->orWhere('id', $term)
    ->get();

    return response()->json($creators);
    }
}
