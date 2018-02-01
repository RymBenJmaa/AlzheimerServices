<?php
namespace App\Http\Controllers;
use App\BestPractices;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BestPracticesController extends Controller
{
	  /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addBP(Request $request)
    {
           $rules = [
            'title' => 'required',
            'description' => 'required'
            
        ];
        $input = $request->only('title', 'description');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        $id = DB::table('best_practices')->insertGetId(array('title' => $request->title, 'description' => $request->description ));
        return response()->json(['success' => true, 'id' => $id]);
    }
        public function getBP(Request $request)
         {
       
             $bp = DB::table('best_practices')->select('id', 'title', 'description')->get();

            if(!is_null($bp)){
                return response()->json(['success' => true,'data' => $bp]);
            }       
             return response()->json(['success'=> false, 'error'=> 'no best practices']);
        
         }  
          public function updateBP(Request $request)
         {
        $rules = [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',  
        ];
        $input = $request->only('id', 'title', 'description');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
         $bp = DB::table('best_practices')->where('id',$request->id )->first();
        if(!is_null($bp))
       {
        DB::table('best_practices')
            ->where('id', $request->id)
            ->update(['title' => $request->title, 'description' => $request->description ]);
        return response()->json(['success' => true]);
         }  

        return response()->json(['success'=> false, 'error'=> 'best practice doesn\'t exist' ]);
    }

}