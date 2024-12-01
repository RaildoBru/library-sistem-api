<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Author as AuthorModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthorController extends Controller
{
    public function index()
    {
        $authorQuery = AuthorModel::query()->get();
        return response()->json($authorQuery->all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birthday_date' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $date = Carbon::parse($request->get('birthday_date'))->format('Y-m-d');
        $authorData = [
            "name" => $request->get('name'),
            "birthday_date" => $date
        ];

        $authorNew = AuthorModel::firstOrCreate($authorData);
        return response()->json($authorNew,201);
    }

    public function show($id)
    {
        $authorQuery = AuthorModel::where('id',$id)->get();
        return response()->json($authorQuery,200);
    }

    public function update($id, Request $request)
    {
        $date = Carbon::parse($request->get('birthday_date'))->format('Y-m-d');
        $authorData = [
            "name" => $request->get('name'),
            "birthday_date" => $date
        ];

        AuthorModel::where('id', $id)->update($authorData);

        $authorQuery = AuthorModel::where("id",$id)->get();
        return response()->json($authorQuery->all(),200);
    }

    public function destroy($id){
        $authorDel = AuthorModel::where('id', $id)->delete();
        return response()->json([],204);
    }
}
