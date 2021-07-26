<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    /**
     * @param CalculateRequest $request
     * @return JsonResponse
     */
   public function calculate(CalculateRequest $request): JsonResponse
   {
       return response()->json(['result' => $request['firstNumber'] + $request['secondNumber']], 200);
   }
}
