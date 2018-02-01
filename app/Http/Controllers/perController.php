<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\PersonneC;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;

class perController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPer(Request $request)
    {
           $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'lien' => 'required',
            'email' => 'required|email|max:255|unique:personnes_proches',
            'num_tel' => 'required',
            'photo' => 'required',
            'malade' => 'required'

        ];
        $input = $request->only(
         'nom',
         'prenom',
         'lien',
         'email',
     	 'num_tel',
     	 'photo',
     	 'malade'
     	  );
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

 
      
      $destinationPath = 'personnes_con';
      
      $request->photo->move($destinationPath, $request->photo->getClientOriginalName());
       
      $destinationPath = 'personnes_con/'. $request->photo->getClientOriginalName();

		$id = DB::table('personnes_proches')->insertGetId(array('nom' => $request->nom, 'prenom' => $request->prenom, 'lien' => $request->lien,'email' => $request->email,'num_tel' => $request->num_tel,'photo' => $destinationPath,'malade' => $request->malade  ));

        return response()->json(['success' => true]);
    }
public function getper(Request $request)
         {
       
            $per = DB::table('personnes_proches')->where('malade',$request->malade )->get();
            $imagess = array();

				foreach ($per as $im) {

 				$imagess[] = "http://51.254.124.41:22/".$im->photo;
				}


            if(!is_null($per)){
                return response()->json(['success' => true,'data' => $per,'photos' => $imagess ]);
            }  
                 
             return response()->json(['success'=> false, 'error'=> 'no patient with this email']);
        
         }  

}

