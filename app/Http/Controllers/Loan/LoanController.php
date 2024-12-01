<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\Loan as LoanModel;
use Carbon\Carbon;
use App\Jobs\SendEmailJob;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        $LoanQuery = LoanModel::query()->get();
        return response()->json($LoanQuery->all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_date_final' => 'required|date',
            'book_id' => ['required' ,'exists:App\Models\Book\Book,id'],
            'cliente_id' => ['required' ,'exists:App\Models\Cliente,id']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $date = Carbon::parse($request->get('loan_date_final'))->format('Y-m-d');
        $loanData = [
            'loan_date' => Carbon::now()->format('Y-m-d'),
            'loan_date_final' => $date,
            'book_id' => $request->get('book_id'),
            'cliente_id' => $request->get('cliente_id')
        ];

        $cliente = Cliente::where('id', $request->get('cliente_id'))->get()->toArray();
        $LoanNew = LoanModel::create($loanData);

        $loanInfo = [
            'email' => $cliente[0]['email'],
            'name' => $cliente[0]['name'],
            'books' => $LoanNew->books()->get()->toArray(),
        ];

        SendEmailJob::dispatch($loanInfo)->onQueue('default');
        return response()->json($LoanNew,201);
    }
}
