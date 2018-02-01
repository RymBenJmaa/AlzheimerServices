<?php

namespace App\Http\Controllers;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class mapController extends Controller
{
     /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function position(Request $request)
    {
           $rules = [
            'latitude' => 'required',
            'longitude' => 'required',
            'email'	=> 'required',
        ];
        $input = $request->only('latitude', 'longitude', 'email');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
         $positionn = DB::table('positions')->where('email',$request->email )->first();
        if(!is_null($positionn))
       {
        DB::table('positions')
            ->where('email', $request->email)
            ->update(['latitude' => $request->latitude, 'longitude' => $request->longitude ]);
       }else
       {
        $position = new Position;
        $position->latitude =$request->latitude;
		$position->longitude =$request->longitude;
		$position->email =$request->email;
		$position->save();
		}
        return response()->json(['success' => true]);
    }
     /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getposition(Request $request)
    {
       
       	$position = DB::table('positions')->where('email',$request->email )->first();

        if(!is_null($position)){
        	return response()->json(['success' => true,'data' => [$position->latitude , $position->longitude  ]]);
        }       
		 return response()->json(['success'=> false, 'error'=> 'no patient with this email']);
        
    }  
}
