<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendVerifyCode;

class ApiController extends Controller
{
    public function sendVerifyCode(Request $request)
    {
        $this->validate($request, ['phone' => 'required|size:11|exists:users']);

        dispatch(new SendVerifyCode($request->phone));

        return ['success' => true];
    }
}