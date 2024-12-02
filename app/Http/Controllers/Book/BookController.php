<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Book\Book as BookModel;
use App\Models\Author\Author as AuthorModel;

class BookController extends Controller
{
    public function index()
    {
        $BookQuery = BookModel::query()->get();
        return response()->json($BookQuery->all(),Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'authors' => 'array'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $date = Carbon::parse($request->get('publication_date'))->format('Y-m-d');
        $bookData = [
            'title' => $request->get('title'),
            'publication_date' => $date
        ];

        $authors = $request->get('authors');
        $authorsQuery = AuthorModel::whereIn('name',$authors)->get();
        $bookNew =  BookModel::firstOrCreate($bookData);

        $bookNew->authors()->sync($authorsQuery);

        return response()->json($bookNew, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $bookQuery = BookModel::where('id',$id)->get();
        return response()->json($bookQuery,Response::HTTP_OK);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $date = Carbon::parse($request->get('publication_date'))->format('Y-m-d');
        $bookData = [
            "title" => $request->get('title'),
            "publication_date" => $date
        ];
        BookModel::where('id', $id)->update($bookData);

        $bookQuery = BookModel::where("id",$id)->get();
        return response()->json($bookQuery->all(),Response::HTTP_OK);

    }

    public function destroy($id){
        $Bookdel = BookModel::where('id', $id)->delete();
        return response()->json([],Response::HTTP_NO_CONTENT);
    }
}
