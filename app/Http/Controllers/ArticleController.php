<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $articles = Article::with('scategorie')->get(); // Include related category
            return response()->json($articles, 200);
        } catch (\Exception $e) {
            return response()->json("Sélection impossible: {$e->getMessage()}", 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $article = new Article([
                "designation" => $request->input('designation'),
                "marque" => $request->input('marque'),
                "reference" => $request->input('reference'),
                "qtestock" => $request->input('qtestock'),
                "prix" => $request->input('prix'),
                "imageart" => $request->input('imageart'),
                "scategorieID" => $request->input('scategorieID'),
            ]);
            $article->save();
            return response()->json($article, 201);
        } catch (\Exception $e) {
            return response()->json("Insertion impossible: {$e->getMessage()}", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);
            return response()->json($article, 200);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données: {$e->getMessage()}", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->update($request->all());
            return response()->json($article, 200);
        } catch (\Exception $e) {
            return response()->json("Problème de modification: {$e->getMessage()}", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json("Article supprimé avec succès", 200);
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de l'article: {$e->getMessage()}", 500);
        }
    }
    public function articlesPaginate()
    {
    try {
    $perPage = request()->input('pageSize', 2);
    // Récupère la valeur dynamique pour la pagination
    $articles = Article::with('scategorie')->paginate($perPage);
    // Retourne le résultat en format JSON API
    return response()->json([
    'products' => $articles->items(), // Les articles paginés
    'totalPages' => $articles->lastPage(), // Le nombre de pages
    ]);
    } catch (\Exception $e) {
    return response()->json("Selection impossible {$e->getMessage()}");
    }
    }

}
