<?php

namespace App\Http\Controllers;

use App\Schema\Schema;
use GraphQL\GraphQL;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The GraphQL endpoint
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function graphql(Request $request): JsonResponse
    {
        $schema = new Schema();
        $query = $request->get('query');
        $rootValue = ['prefix' => 'You said: '];
        $variableValues = $request->get('variables');

        try {
            $output = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues)->toArray();
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }

        return response()->json($output);
    }
}
