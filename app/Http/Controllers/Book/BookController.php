<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Book\Book as BookModel;
use App\Models\Author\Author as AuthorModel;

class BookController extends Controller
{
    public function index()
    {
        $BookQuery = BookModel::query()->get();
        return response()->json($BookQuery->all());
    }

    public function store(Request $request)
    {
        $date = Carbon::parse($request->get('publication_date'))->format('Y-m-d');
        $bookData = [
            'title' => $request->get('title'),
            'publication_date' => $date
        ];

        $authors = $request->get('authors');
        $authorsQuery = AuthorModel::whereIn('name',$authors)->get();
        $bookNew =  BookModel::firstOrCreate($bookData);

        $bookNew->authors()->sync($authorsQuery);

        return response()->json($bookNew, 201);
    }
}
