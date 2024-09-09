<?php

namespace App\Http\Controllers\SenatorExpenses;

use App\Http\Controllers\Controller;
use App\Http\Resources\SenatorExpenses\ExpenseCollection;
use App\Http\Resources\SenatorExpenses\ExpenseResource;
use App\Models\SenatorExpenses\Expense;
use App\Models\SenatorExpenses\Party;
use App\Models\SenatorExpenses\Summary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('senator')->paginate(100);

        return ExpenseResource::collection($expenses);
    }

    public function partyExpenses(Request $request, string $id)
    {
        //if party not found, return 404
        $party = Party::findOrFail($id);

        $expensesQuery = Expense::query()
            ->with('senator')
            ->whereHas('senator', function (Builder $query) use ($party) {
                $query->where('party', $party->id);
            });

        // filter by year
        if ($request->filled('year')) {
            $expensesQuery->whereYear('date', $request->input('year'));
        }

        $expensesStats = (clone $expensesQuery)->selectRaw('COUNT(*) as count, SUM(amount) as sum')->first();

        // número de senadores
        $senatorCount = $expensesQuery->get()->pluck('senator_id')->unique()->count();
        $totalPerSenator = $senatorCount > 0 ? $expensesStats['sum'] / $senatorCount : 0;

        //ordenar e paginar
        $expenses = $expensesQuery
            ->orderByDesc('date')
            ->paginate(100, ['*'], 'page', null, $expensesStats['count']);

        return new ExpenseCollection($expenses, [
            'meta' => [
                'expenses_sum' => number_format($expensesStats['sum'], 2, '.', ''),
                'expenses_avg' => $expensesStats['count'] > 0 ? number_format($expensesStats['sum'] / $expensesStats['count'], 2, '.', '') : 0,
                'expenses_count' => $expensesStats['count'],
                'senators_count' => $senatorCount,
                'total_per_senator' => number_format($totalPerSenator, 2, '.', ''),
            ],
        ]);
    }

    public function UFExpenses(Request $request, $UF)
    {

        $expensesQuery = Expense::with(['senator' => function ($query) use ($UF) {
            $query->where('UF', $UF);
        }])->whereHas('senator', function ($query) use ($UF) {
            $query->where('UF', $UF);
        });

        // if UF not found, return 404
        if ($expensesQuery->count() == 0) {
            return response()->json(['message' => 'UF expense not found'], 404);
        }

        // filter by year
        if (request()->has('year')) {
            $expensesQuery->where('date', 'like', request('year').'%');
        }

        $expensesStats = (clone $expensesQuery)->selectRaw('COUNT(*) as count, SUM(amount) as sum')->first();

        //ordenar
        $expensesQuery->orderBy('date', 'desc');
        $expenses = $expensesQuery->paginate(100, ['*'], 'page', null, $expensesStats['count']);

        // sum all expenses

        return new ExpenseCollection($expenses, [
            'meta' => [
                'expenses_sum' => number_format($expensesStats['sum'], 2, '.', ''),
                'expenses_avg' => number_format($expensesStats['sum'] / $expensesStats['count'], 2, '.', ''),
                'expenses_count' => $expensesStats['count'],
            ],
        ]);
    }

    public function summaryByParty()
    {

        $summary = Summary::where('type', 'party')->get();

        $summary = $summary->map(function ($item) {

            $newItem = [
                'year' => $item['year'],
                'data' => $item['summary'],
            ];

            return $newItem;
        });

        return response()->json($summary);
    }

    public function summaryByUF()
    {

        $summary = Summary::where('type', 'uf')->get();

        $summary = $summary->map(function ($item) {

            $newItem = [
                'year' => $item['year'],
                'data' => $item['summary'],
            ];

            return $newItem;
        });

        return response()->json($summary);
    }
}
