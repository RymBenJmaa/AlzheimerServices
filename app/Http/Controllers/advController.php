<?php

namespace App\Http\Controllers;

use App\Advs;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
class advController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addadvice(Request $request)
    {
           $rules = [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|max:20',
            'conseil' => 'required|max:1000'
        ];
        $input = $request->only('nom', 'prenom','email','telephone','conseil');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        $ad = DB::table('conseils')->first();
         if(!is_null($ad))
       {
        DB::table('conseils')
            ->where('id', 1)
            ->update(['nom' => $request->nom, 'prenom' => $request->prenom, 'email' => $request->email,'telephone' => $request->telephone,'conseil' => $request->conseil ]);
            return response()->json(['success' => true]);
       }else
       {
		$id = DB::table('conseils')->insertGetId(array('nom' => $request->nom, 'prenom' => $request->prenom, 'email' => $request->email,'telephone' => $request->telephone,'conseil' => $request->conseil  ));
        return response()->json(['success' => true]);
        }
    }
     /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function getadvice(Request $request)
         {
       
            $ad = DB::table('conseils')->first();

            if(!is_null($ad)){
                return response()->json(['success' => true,'data' => $ad ]);
            }       
             return response()->json(['success'=> false, 'error'=> 'no patient with this email']);
        
         }  

}
