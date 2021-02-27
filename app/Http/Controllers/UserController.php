<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\User_login;
use App\Models\Lead;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use DB;
use Session;
use Cookie;
use Auth;
use Carbon\Carbon;
use Validator;
session_start();
class UserController extends Controller
{
    //
    public function reassign_request(Request $request)
    {
        $id=$request->id;
        $lead=DB::table('leads')
                ->join('services', 'leads.service_id', '=', 'services.id')
                ->where('leads.user_id',$id)
                ->where('leads.status','reassigned')
                ->select('leads.*','leads.id as lead_id','services.service_name')
                ->get();

               
        return $lead;

    }

    public function cancel_booking(Request $request)
    {
        $validatedData=Validator::make($request->all(),[
            "lead_id"=>"required"
        ]);
        if($validatedData->fails())
        {
                return response()->json([
                    "message"=>"validation fail"
                ]);
        }
        else{
            $lead_id=$request->lead_id;
            $lead=Lead::find($lead_id);
            $lead->delete();
            return response()->json([
                "message"=>"Order Cancel"
            ]);

        }

    }


    public function booking_complete(Request $request)
    {
        $validatedData=Validator::make($request->all(),[
            "id"=>"required"
        ]);
        if($validatedData->fails())
        {
                return response()->json([
                    "message"=>"validation fail"
                ]);
        }
        else{
            $id=$request->id;
            $users = DB::table('leads')
            ->join('services', 'leads.service_id', '=', 'services.id')
            ->where('leads.user_id','=',$id)
            ->where('leads.status','=','completed')
            ->select('leads.*','leads.id as lead_id','services.service_name')
            ->get();

            return $users;
        }
    }

    public function booking_incomplete(Request $request)
    {
        $validatedData=Validator::make($request->all(),[
            "id"=>"required"
        ]);
        if($validatedData->fails())
        {
                return response()->json([
                    "message"=>"validation fail"
                ]);
        }
        else{
            $id=$request->id;
            $users = DB::table('leads')
            ->join('services', 'leads.service_id', '=', 'services.id')
            ->where('leads.user_id','=',$id)
            ->where('leads.status','=','incomplete')
            ->select('leads.*','leads.id as lead_id','services.service_name')
            ->get();

            return $users;
        }
    }
    
    function login(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'mobile'=>'required|max:10|min:10',
        
        ]);
        if($validatedData->fails())
        {
            return response()->json([
                'hasError'=>1,
                'message' => 'Please Enter Valid Mobile Number',
                
                ]);
        }
        else{

        
        $user= User_login::where('mobile', (string)$request->mobile)->first();

        $authKey = "35819AU38NdjKKcZ5eda05e7P30";   //fast smsindia

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $request->mobile;

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "102234";
        $value=rand(1000,9999);
        Cookie::make('otp',$value);
        $_SESSION['otp']=$value;
        Session::put('mobile', $mobileNumber);
        Session::put('otp', $value);
        $_SESSION['mobile']=$mobileNumber;
        
        $otp=Session::get('otp');
        //Your message to send, Add URL encoding here.
        $message = urlencode("Your Otp is: ".$value);

        //Define route 
        $route = "default";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );

        //API URL
        $url="http://sms.fastsmsindia.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
          //  echo 'error:' . curl_error($ch);
             return response([
                "message"=>curl_error($ch)
            ]);
            curl_close($ch);
        }
        else{

            curl_close($ch);

        

            if(!$user)
            {
                Session::put('not_found','user not found');
                $_SESSION['not_found']="user not found'";
            // return redirect('/otp');
            return response()->json([
                'hasError'=>0,
                'message' => 'Otp send succesfully',
                'otp'=> $_SESSION['otp']
                ]);
                return view('otp')->with('message',"Otp send succesfully");
            
            }
            else{
            
                //Your authentication key
                     unset($_SESSION['not_found']);
                 
                    return response()->json([
                        'hasError'=>0,
                        'message' => 'Otp send succesfully',
                        'otp'=> $_SESSION['otp']
                        ]);
                    return view('otp')->with('message',"Otp send succesfully");

            }
        }
    }

       


        //  return $user;
        //     if (!$user || !Hash::check($request->password, $user->password)) {
        //         return response([
        //             'message' => ['These credentials do not match our records.']
        //         ], 404);
        //     }
        
        //      $token = $user->createToken('my-app-token')->plainTextToken;
        
        //     $response = [
        //         'user' => $user,
        //         'token' => $token
        //     ];
        
        //      return response($response, 201);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function otp(Request $request)
    {
  
       
        $validatedData = Validator::make($request->all(), [
            'otp'=>'required|max:4|min:4',
        
        ]);
        if( $validatedData->fails())
        {
            return response()->json([
                "hasError"=>1,
                "id"=>0,
                 "mobile"=>0,
                "message"=>'Please enter valid otp'
            ]);
        }
        else{

        
       $session_otp= $_SESSION['otp'];
       
        //$session_otp=5612;

        $otp=$request->otp;
    
        if($session_otp==$otp)
        {
           $m= $_SESSION['mobile'];
          // return response()->json([
           //  "value"=>"done",
           //  "mobile"=>$m
           //  ]);
           // exit();
           $mobile=(string)$m;
          //  $mobile=7777777777;
           // return $mobile;
            if(isset($_SESSION['not_found']))
            {
                 $created_at=Carbon::now();
               $data= DB::insert('insert into user_logins (mobile,created_at) values(?,?)',[$mobile,$created_at]);
               // $user = new User_login;
               // $user->mobile =$_SESSION['mobile'];
              //  $user->created_at=Carbon::now();
              //  $data=$user->save();
                if($data)
                {
                    
                    //$mobile=(string)$request->session()->get('mobile');
                    $user = User_login::where('mobile', $mobile)->first();
                  return response()->json([
                      "hasError"=>0,
                    "id"=>$user->id,
                    "mobile"=>$user->mobile,
                     "message"=>'User Created succesfully'
                     
                 ]);
                }
            }
            else{
                $user = User_login::where('mobile',$mobile)->first();
                    return response()->json([
                        "hasError"=>0,
                        "id"=>$user->id,
                        "mobile"=>$user->mobile,
                        "message"=>'Login Successful'
                      
                    ]);
            }
      
          
        

        }
        else{
            return response()->json([
                "hasError"=>1,
                "id"=>0,
                "mobile"=>0,
                "message" => 'Please Enter Correct Otp',
                
                ]);
            
        }

        }
    }

      public function test(Request $request)
    {
        $otp=$request->otp;
        //$token=csrf_token();
        $session_mobile= $_SESSION['mobile'];
         return response()->json([
                
                "otp"=>$otp,
               "mobile"=>$session_mobile
                
                ]);
    }
    
       public function service_type(Request $request)
    {
        
        if($id=$request->id)
        {
           /* $results = DB::select( DB::raw("SELECT *
            FROM services
            RIGHT JOIN sub_services
            ON services.id = sub_services.service_id RIGHT JOIN services_type
            ON services_type.service_type =sub_services.id where services.id='$id' ") );  */
            
          $data = DB::table('sub_services')
             ->select(DB::raw('*'))
            ->where('service_id', $id)
            ->get();
           return $data; 
            
            return response()->json($data);
        }
      /*  else{
            return response()->json([
                "error"=>"Please Enter valid id"
            ]);
        } */
       

    }
    
    
    
    public function sub_service_data(Request $request)
    {
        
        if($id=$request->id)
        {
            $results = DB::select( DB::raw("SELECT *
             FROM services
             RIGHT JOIN sub_services
            ON services.id = sub_services.service_id RIGHT JOIN services_type
            ON services_type.service_type =sub_services.id  where services.id='$id' ") );

          return $results;

            // $results = DB::select( DB::raw("SELECT *
            // FROM services
            // RIGHT JOIN sub_services
            // ON services.id = sub_services.service_id RIGHT JOIN services_type
            // ON services_type.service_type =sub_services.id") );

        //  return $results;
            $d=[];
           // $a=json_decode($results);
            // foreach($results as $r)
            // {
            //     array_push($d,$r->sub_service_name);
            // }
            // return $d;
            foreach($results as $r){
                array_push($d,$r->sub_service_name);
            }
            $service_data=array_unique($d);
            $s=array_values($service_data);
            $da['sub_service_name']=[];
           // $da['sub_service_name']['sub_type']=[];
          
           // print_r($s);
          // exit();
          //return $d;
            foreach($s as $sa)
            {
               // array_push($da['sub_service_name'],$sa);
                $da['sub_service_name'][$sa]=[];
               // echo $sa."\n";
              // echo $re->sub_sevice_name."\n";
                foreach($results as $re)
                {
                   
                    $da['service_name']=$re->service_name;
                    $da['service_id']=$re->service_id;
                   // $da['sub_service_name'][$sa]['service_type']=$re->service_type;
                   // $da['sub_service_name'][$sa];
                  
                    if($re->sub_service_name==$sa)
                    {
                      $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['service_type']=$re->service_type;
                        $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['id']=$re->id;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['price']=$re->price;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['img']=$re->img;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['rating']=$re->rating;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['description']=$re->description;
//array_push($da['sub_service_name'][$sa],$re->sub_type);
                       // echo $re->sub_type."\n";
                    }
                }
            }
         //   exit();
            $data['sercices']=$s;
            $data['result']=$results;
           


            
            return $da;
            
            $data = DB::table('sub_services')
            ->select(DB::raw('*'))
            ->where('service_id', $id)
            ->get();
         //  return $data;

             return response()->json($data);
        }
        else{
            return response()->json([
                "error"=>"Please Enter valid id"
            ]);
        }
        
        
        
        
       

    }
    
    



    

    public function testing_sub_service(Request $request)
    {
        
       
        if($id=$request->id)
        {
            $results = DB::select( DB::raw("SELECT *
             FROM services
             RIGHT JOIN sub_services
            ON services.id = sub_services.service_id RIGHT JOIN services_type
            ON services_type.service_type =sub_services.id  where services.id='$id' ") );

           

          
        // return $results;
            $d=[];
            $sub_t=[];
           // $a=json_decode($results);
            // foreach($results as $r)
            // {
            //     array_push($d,$r->sub_service_name);
            // }
            // return $d;
            foreach($results as $r){
                array_push($d,$r->sub_service_name);
                array_push($sub_t,$r->sub_type);
            }
            $service_data=array_unique($d);
            $s=array_values($service_data);
            $sub_type=array_values($sub_t);
           

           // return "done";
           // $da['sub_service_name']=[];
          //  return $sub_type;
           // $da['sub_service_name']['sub_type']=[];
          
           // print_r($s);
          // exit();
          $data2=[];
          $data2['sub_service_name']=[];
       //   $data2['sub_service_name']['sub_type']=[];
        //   foreach($s as $su)
        //   {
        //      // $data2['sub_service_name']=$su;
        //       echo $su."<br>";
        //       $a=0;
        //       foreach($results as $res)
        //       {
        //           if($su==$res->sub_service_name)
        //           {
        //            // $data2['sub_service_name'][$a]['sub_type']=$res->sub_type;
        //               echo $res->sub_type."<br>";
        //             $a++;
        //           }
        //       }
        //   }
        //  exit();
        // return $data2;

          //exit();
          //return $d;
          $b=1;
          $da=[];
          $a=1;
          $d=1;
           foreach($s as $sa)
           {
               // array_push($da['sub_service_name'],$sa);
                //$da['sub_service_name'][$sa]=[];
               // echo $sa."\n";
              // echo $re->sub_sevice_name."\n";
             // echo $sa."\n";
              //$da['sub_service_name'][$b]=$sa;
            //  $da=[];
            //$da['sub_service_name'][$sa]['name']=$sa;
            // $da['sub_service_name'][$sa]['service_type']=[];
            // $da['sub_service_name'][$sa]['service_id']=[];
            // $da['sub_service_name'][$sa]['id']=[];
            // $da['sub_service_name'][$sa]['price']=[];
            // $da['sub_service_name'][$sa]['img']=[];
            // $da['sub_service_name'][$sa]['rating']=[];
            // $da['sub_service_name'][$sa]['description']=[];
            
               $c=1;
                foreach($results as $re)
                {
                    
                   
                    $da['service_name']=$re->service_name;
                    $da['service_id']=$re->service_id;
                   // $da['sub_service_name'][$a]['name']=$re->sub_service_name;
                   // $da['sub_service_name'][$sa]['service_type']=$re->service_type;
                   // $da['sub_service_name'][$sa];
                   
                  if($re->sub_service_name== $sa)
                 {
                        $da['sub_service_name'][$sa]["data".$c]['service_type']=$re->sub_type;
                        $da['sub_service_name'][$sa]["data".$c]['service_id']=$re->service_type;
                        $da['sub_service_name'][$sa]["data".$c]['id']=$re->id;
                        $da['sub_service_name'][$sa]["data".$c]['price']=$re->price;
                        $da['sub_service_name'][$sa]["data".$c]['img']=$re->img;
                        $da['sub_service_name'][$sa]["data".$c]['rating']=$re->rating;
                        $da['sub_service_name'][$sa]["data".$c]['description']=$re->description;
                       // $da['sub_service_name'][$sa]["sub_type"]=$re->sub_type;

                        
                      /*  $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['service_type']=$re->service_type;
                        $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['id']=$re->id;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['price']=$re->price;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['img']=$re->img;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['rating']=$re->rating;
                       $da['sub_service_name'][$sa]["sub_type"][$re->sub_type]['description']=$re->description;

                        */
//array_push($da['sub_service_name'][$sa],$re->sub_type);
                       // echo $re->sub_type."\n";
                    }
                    $a++;
                    $c++;
                }
                $b++;
                $d++;
         }
         //   exit();
            $data['sercices']=$s;
            $data['result']=$results;
           

          // var_dump($da);
           //exit();
            return response()->json($da);
            return $da;
            
            $data = DB::table('sub_services')
            ->select(DB::raw('*'))
            ->where('service_id', $id)
            ->get();
         //  return $data;

             return response()->json($data);
        }
        else{
            return response()->json([
                "error"=>"Please Enter valid id"
            ]);
        }
    }
        





    public function new_login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'mobile'=>'required|max:10|min:10',
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Please Enter correct Mobile Number',
                ]);
        }
        else{
            $mobile=(string)$request->mobile;
            $user = User_login::where('mobile',$mobile)->first();
            if(!$user)
            {
                $data=new User_login;
                $data->mobile=$mobile;
                $data->save();
                return response()->json([
                    "message" => 'Registration Successful',
                    "user_id"=> $data->id
                    ]);
              //  return $data->id;
                
            }else{
                return response()->json([
                    "message" => 'Login Successful',
                    "user_id"=> $user->id
                    ]);
            }
        }
    }
    
    
    
    

 


}
