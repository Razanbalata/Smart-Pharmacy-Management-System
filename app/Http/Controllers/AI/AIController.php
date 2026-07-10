<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AI\AIManager;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function __construct(
        private AIManager $aiManager
    ) {}

    public function analyze(Request $request)
    {
        $module = $request->get('module');

        if (!$module) {
            return response()->json([
                'message' => 'Module is required'
            ], 422);
        }

        $result =
            $this
                ->aiManager
                ->analyze($module);

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }
}
