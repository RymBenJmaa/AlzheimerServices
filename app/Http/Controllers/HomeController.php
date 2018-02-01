<?php

namespace App\Http\Controllers;
use App\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class HomeController extends Controller
{
     /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertHome(Request $request)
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
         $home = DB::table('home')->where('email',$request->email )->first();
        if(!is_null($home))
       {
        
        DB::table('home')
            ->where('email', $request->email)
            ->update(['latitude' => $request->latitude, 'longitude' => $request->longitude ]);
       }else
       {
      /*  $home = new Home;
        $home->latitude =$request->latitude;
		$home->longitude =$request->longitude;
		$home->email =$request->email;
		$home->save();*/

        $id = DB::table('home')->insertGetId(
         array('latitude' => $request->latitude, 'longitude' => $request->longitude,'email' => $request->email)
             );
		}
        return response()->json(['success' => true]);
    }
     /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHome(Request $request)
    {
       
       	$home = DB::table('home')->where('email',$request->email )->first();

        if(!is_null($home)){
        	return response()->json(['success' => true,'data' => [$home->latitude , $home->longitude  ]]);
        }       
		 return response()->json(['success'=> false, 'error'=> 'no patient with this email']);
        
    }  
}
