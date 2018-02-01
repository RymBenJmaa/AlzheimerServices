<?php
namespace App\Http\Controllers;
use App\Symptomes;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SymptomesController extends Controller
{
	 /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSymp(Request $request)
    {
           $rules = [
            'description' => 'required',
            'type' => 'required'
            
        ];
        $input = $request->only('description', 'type');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

		$id = DB::table('symptomes')->insertGetId(array('description' => $request->description, 'type' => $request->type ));
        return response()->json(['success' => true, 'id' => $id]);
    }
        public function getsymp(Request $request)
         {
       
 			 $symps = DB::table('symptomes')->select('id', 'description', 'type')->get();

            if(!is_null($symps)){
                return response()->json(['success' => true,'data' => $symps]);
            }       
             return response()->json(['success'=> false, 'error'=> 'no syptomes']);
        
         }  
          public function updatesymp(Request $request)
         {
        $rules = [
        	'id' => 'required',
            'description' => 'required',
            'type' => 'required',  
        ];
        $input = $request->only('id', 'description', 'type');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
         $symptomes = DB::table('symptomes')->where('id',$request->id )->first();
        if(!is_null($symptomes))
       {
        DB::table('symptomes')
            ->where('id', $request->id)
            ->update(['description' => $request->description, 'type' => $request->type ]);
        return response()->json(['success' => true]);
         }  

		return response()->json(['success'=> false, 'error'=> 'symptome doesn\'t exist' ]);
	}
}