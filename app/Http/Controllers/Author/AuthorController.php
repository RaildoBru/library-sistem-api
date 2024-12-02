<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Author as AuthorModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function index()
    {
        $authorQuery = AuthorModel::query()->get()->toarray();
        return response()->json($authorQuery,Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birthday_date' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), Response::HTTP_BAD_REQUEST);
        }

        $date = Carbon::parse($request->get('birthday_date'))->format('Y-m-d');
        $authorData = [
            "name" => $request->get('name'),
            "birthday_date" => $date
        ];

        $authorNew = AuthorModel::firstOrCreate($authorData);
        return response()->json($authorNew,Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $authorQuery = AuthorModel::where('id',$id)->get();
        return response()->json($authorQuery,Response::HTTP_OK);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birthday_date' => 'required|date'
        ]);

        $date = Carbon::parse($request->get('birthday_date'))->format('Y-m-d');
        $authorData = [
            "name" => $request->get('name'),
            "birthday_date" => $date
        ];

        AuthorModel::where('id', $id)->update($authorData);

        $authorQuery = AuthorModel::where("id",$id)->get();
        return response()->json($authorQuery->all(),Response::HTTP_OK);
    }

    public function destroy($id){
        $authorDel = AuthorModel::where('id', $id)->delete();
        return response()->json([],Response::HTTP_NO_CONTENT);
    }
}
