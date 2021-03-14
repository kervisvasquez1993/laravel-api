<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait ApiResponse
{
    private function successResponse($data, $code)
    {
        return response()->json($data,$code);
    }

    private function errorResponse($messeger, $code)
    {
        return response()->json(['error' => $messeger, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse(['data' => $collection], $code);
    }
    protected function showOne(Model $instace, $code = 200)
    {
        return $this->successResponse(['data' => $instace], $code);
    }
}