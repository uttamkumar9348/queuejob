<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserWelcomeMail;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function sendemail(request $request)
    {
        $email_data = $request->all();

        foreach($email_data['data'] as $email){
            $emaildata =[
                'email'=>$email['email'],
                "content"=>$email['message']
            ];
            
            dispatch(new SendEmailJob($emaildata));
        }
        $msg = '{"message":["Email Send Successfully"]}';
        return response()->json($msg);
    }
}
