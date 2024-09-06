<?php

namespace App\Http\Controllers\SenatorExpenses;

use App\Http\Controllers\Controller;
use App\Http\Resources\SenatorExpenses\ExpenseCollection;
use App\Http\Resources\SenatorExpenses\SenatorResource;
use App\Models\SenatorExpenses\Senator;

class SenatorController extends Controller
{
    public function index()
    {
        $senatorsQuery = Senator::query();

        // filter by active
        if (request()->has('active')) {
            $senatorsQuery->where('is_active', request('active') ? 1 : 0);
        }

        // filter by UF
        if (request()->has('uf')) {
            $senatorsQuery->where('UF', request('uf'));
        }

        // filter by party
        if (request()->has('party')) {
            $senatorsQuery->where('party', request('party'));
        }

        $senators = $senatorsQuery->paginate(100);

        return SenatorResource::collection($senators);
    }

    public function show($id)
    {
        $senator = Senator::findOrFail($id);

        return new SenatorResource($senator);
    }

    public function expenses($id)
    {
        $senator = Senator::findOrFail($id);
        $expensesQuery = $senator->expenses()->with('senator');

        // filter by year
        if (request()->has('year')) {
            $expenses = $expensesQuery->where('date', 'like', request('year').'%');
        }

        // sum all expenses
        $expensesSum = $expensesQuery->sum('amount');
        $expensesCount = $expensesQuery->count();

        $expenses = $expensesQuery->paginate(100);

        // sum all expenses
        $total = $expenses->sum('amount');

        return new ExpenseCollection($expenses, [
            'meta' => [
                'expenses_sum' => number_format($expensesSum, 2, '.', ''),
                'expenses_avg' => number_format($expensesSum / $expensesCount, 2, '.', ''),
                'expenses_count' => $expensesCount,
            ],
        ]);
    }

    public function home()
    {
        return [
            'message' => 'Welcome to the Brazilian Senators Expenses. Have fun!',
            'endpoints' => [
                'senators' => [
                    'url' => '/senator-expenses/senators',
                    'description' => 'List all senators',
                    'query_parameters' => [

                    ],
                ],
            ],
        ];
    }
}
