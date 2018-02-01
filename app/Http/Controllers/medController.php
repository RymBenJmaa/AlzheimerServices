<?php
namespace App\Http\Controllers;
use App\Meds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Time;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
class medController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMed(Request $request)
    {
           $rules = [
            'nom' => 'required',
            'heure_prise' => 'required',
            'nbr_prises' => 'required',
            'malade' => 'required',
            'photo' => 'required'
        ];
        $input = $request->only('nom', 'heure_prise','nbr_prises','malade','photo');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
  
       $destinationPath = 'meds';
      
      $request->photo->move($destinationPath, $request->photo->getClientOriginalName());
       
      $destinationPath = 'meds/'. $request->photo->getClientOriginalName();


		$id = DB::table('meds')->insertGetId(array('nom' => $request->nom, 'heure_prise' => $request->heure_prise, 'nbr_prises' => $request->nbr_prises,'malade' => $request->malade,'photo' =>  $destinationPath ));
        return response()->json(['success' => true]);
    }
        public function getmed(Request $request)
         {
       
  
            $med = DB::table('meds')->where('malade',$request->malade )->get();//->value('nom', 'heure_prise', 'nbr_prises');
            $imagess = array();

                foreach ($med as $im) {
                    

                    $imagess[] ="http://51.254.124.41:22/".$im->photo;
                     /*base64_encode(file_get_contents('C:\Users\Rym\WebServices\medicaments\\'.$im->photo));*/
                }
            if(!is_null($med)){
                return response()->json(['success' => true,'data' => $med,'photos' => $imagess  ]);
            }       
             return response()->json(['success'=> false, 'error'=> 'no patient with this email']);
        
         }  


}
