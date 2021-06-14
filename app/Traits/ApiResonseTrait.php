<?php

namespace App\Traits;

Trait ApiResponseTrait
{
    public function errResponse($message,$status,$code=null)
    {
        $code = $code ?? $status;
        return response()->json(['message'=>$message,'code'=>$code],$status);
        
    }
}