<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function __construct(
        protected SearchService $search
    ) {}

    public function __invoke(SearchRequest $request)
    {
        return view('search.index', [
            'results' => $this->search->search($request->validated('q'))
        ]);
    }

    public function suggestions(SearchRequest $request)
    {
        return response()->json(
            $this->search->suggestions($request->validated('q'))
        );
    }
}