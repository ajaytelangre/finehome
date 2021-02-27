<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use DB;
use Session;
use Cookie;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Models\User;
use App\Models\Service;
use App\Models\Sub_service_lead;
use App\Models\Service_type;
use App\Models\Sub_service;
use App\Models\Lead;
use App\Models\Partner_login;
use App\Models\Slider;
use Storage;
use Redirect;
use Illuminate\Support\Facades\Http;
class AdminController extends Controller
{
    public function remove_slider($id)
    {


        
        $slider=Slider::find($id);
        if($slider->img)
        {
            unlink(public_path() .  '/storage/' . $slider->img );
        }
        $slider->delete();
        return Redirect::back()->with('success','Image Deleted');
       
    }

    public function upload_slider(Request $request)
    {
        $validateData=Validator::make($request->all(),[
            "tag"=>"required",
            "img"=>"required|mimes:jpeg,jpg,png,gif|required|max:300"
        ]);

        if($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData);
        }
        else{
            $btn=$request->btn;
            $img=$request->file('img')->store('slider','public');
            $slider=new Slider;
            $slider->tag=$request->tag;
            $slider->img=$img;
            if($btn=="slider"){
                $slider->type="slider";
            }
            elseif($btn=="offer"){
                $slider->type="offer";
            }
            else{
                return Redirect::back();
            }
            
            
            $slider->save();
            return Redirect::back()->with('success','Image Uploaded');
        }
        
        
    }

    public function ui_form(Request $request)
    {
        $data['slider']=Slider::where("type","slider")->get();
        $data['offer']=Slider::where("type","offer")->get();
        return view("ui_form",$data);
    }


    public function view_history(Request $request,$id=0)
    {
        
        $data['info']=Partner_login::find($id);

        $type=$request->submit;
        if($type=="search")
        {
            $c=$request->data;
            $data['partner']=DB::select( DB::raw("SELECT * FROM leads
                                             WHERE partner_id = '$id' AND (username like '%$c%' 
                                             or id like '%$c%' 
                                             or status like '%$c%') ") );
    
         
        }
        else{
            $data['partner']=Lead::where("partner_id",$id)
                             ->get();
        }
      //  return $data;
        return view('view_history',$data);
    }

    public function job_history(Request $request)
    {
       
        $type=$request->submit;
        if($type=="search")
        {
            $id=$request->id;
            $data['partner']= Partner_login::where('id','LIKE','%'.$id.'%')   	   								    								
                                -> orwhere('partner_name','LIKE','%'.$id.'%')   	   								    								
                                -> orwhere('mobile','LIKE','%'.$id.'%')   	   								    								
                                -> orwhere('email','LIKE','%'.$id.'%')  
                                -> orwhere('work_name','LIKE','%'.$id.'%')  	   								    								
                                ->get();
        }
        else{
            $data['partner']=Partner_login::all();
        }
        
        return view("job_history",$data);
    }


    public function ui()
    {
        return view('ui');
    }

    public function user_list()
    {
        return view('user_list');
    }

    public function edit_partner(Request $request)
    {
        $validateData=Validator::make($request->all(),[
            "id"=>"required",
            "name"=>"required",
            "mobile"=>"required|max:10|min:10",
            "email"=>"required|email",
            "work_name"=>"required",
            "address"=>"required",
        ]);
        
        if($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData);
        }
        else{
            $id=$request->id;
            $partner=Partner_login::find($id);
            $partner->partner_name=$request->name;
            $partner->mobile=$request->mobile;
            $partner->email=$request->email;
            $partner->work_name=$request->work_name;
            $partner->address=$request->address;
            $partner->save();
            return Redirect::back()->with('success','Data Uploaded');
            
        }
       
        
    }



    public function delete_partner($id)
    {
        $partner=Partner_login::find($id);
       // return $partner;
        if($partner->partner_img)
        {
            unlink(public_path() .  '/storage/' . $partner->partner_img );
        }

        if($partner->adhar_img)
        {
            unlink(public_path() .  '/storage/' . $partner->adhar_img );
        }

        if($partner->pan_img)
        {
            unlink(public_path() .  '/storage/' . $partner->pan_img );
        }

        if($partner->address_proof)
        {
            unlink(public_path() .  '/storage/' . $partner->address_proof );
        }

        if($partner->passbook)
        {
            unlink(public_path() .  '/storage/' . $partner->passbook );
        }

        $partner->delete();

        return Redirect::back();

    }


    public function partner_list()
    {
        $data['partner']=Partner_login::all();
        return view("partner_list",$data);
    }

    public function booking_reasigne()
    {
        $data['leads']=DB::table('leads')
        ->Join('services','leads.service_id','=','services.id')
        ->select('leads.*','services.service_name')
        ->where('status','reassigned')
        ->get();

        return view("booking_reasigne",$data);
    }

    public function booking_complete()
    {
        $data['leads']=DB::table('leads')
        ->Join('services','leads.service_id','=','services.id')
        ->select('leads.*','services.service_name')
        ->where('status','completed')
        ->get();

        return view("booking_complete",$data);
    }


    public function getmsg(Request $request)
    {

        $lead_id=$request->lead_id;
        $data=DB::table('sub_service_leads')
        ->where('lead_id',$lead_id)
        ->get();
        return response()->json($data);

    }
    
    public function booking_incomplete(Request $request)
    {
       

        $data['leads']=DB::table('leads')
                    ->Join('services','leads.service_id','=','services.id')
                    ->select('leads.*','services.service_name')
                    ->where('status','incomplete')
                    ->get();
        //return $data;
    
        return view('booking_incomplete',$data);
    }

    public function delete_service_type($id)
    {
        $service_type=Service_type::find($id);
        if($service_type->img)
        {
          unlink(public_path() .  '/storage/' . $service_type->img );
        }
        $service_type->delete();
        return Redirect::back();

        
    }

    public function update_sub_service_type(Request $request)
    {
        $validateData=Validator::make($request->all(),[
            "name"=>"required",
            "price"=>"required",
            "rating"=>"required",
            "description"=>"required"
        ]);

        if($validateData->fails())
        {
             return Redirect::back()->withErrors($validateData);
        }
        else{
            $service_type_id=$request->sub_service_type_id;
            $service_type=Service_type::find($service_type_id);
            if($request->img)
            {
                if($service_type->img)
                {
                    unlink(public_path() .  '/storage/' . $service_type->img );
                }
               
                $img=$request->file('img')->store('services','public');
                $service_type->sub_type=$request->name;
                $service_type->price=$request->price;
                $service_type->img=$img;
                $service_type->rating=$request->rating;
                $service_type->description=$request->description;
                $service_type->save();
                return Redirect::back()->with("success","Data Updated");
               
            }
            else{
               // return $request->all();
                $service_type->sub_type=$request->name;
                $service_type->price=$request->price;
                $service_type->rating=$request->rating;
                $service_type->description=$request->description;
                $service_type->save();
                return Redirect::back()->with("success","Data Updated");
            }

        }
    }

    public function delete_sub_service(Request $request)
    {
        $id=$request->id;
        DB::table('sub_services')->where('id',$id)->delete();
        DB::table('services_type')->where('service_type',$id)->delete();
        return Redirect::back()->with('success','Data Deleted');
    }

    public function update_sub_service(Request $request)
    {

       // return $request->all(); 
        $validateData=Validator::make($request->all(),[
                'sub_service_name'=>"required"
        ]);
        if($validateData->fails())
        {
            return Redirect::back()->withErrors();
        }
        else{
            $id=$request->id;
            $sub_service=Sub_service::find($id);
            $sub_service->sub_service_name=$request->sub_service_name;
            $d=$sub_service->save();
            if($d)
            {
                return Redirect::back()->with('success','Data Updated');
            }
            else{
                return Redirect::back()->with('fail','Data Updation fail');
            }
            

        }
        
    }

    public function edit_service_info(Request $request)
    {
        $validateData=Validator::make($request->all(),[
            'service_name'=>"required"
        ]);
            if($validateData->fails())
            {
                return Redirect::back()->withErrors($validateData);
            }
            else{
                $id=$request->id;
                $service=Service::find($id);

                if($request->img)
                {
                    $pimg= $request->img->getClientOriginalName();
                    unlink(public_path() .  '/storage/services/' . $service->img );
                  

                    $request->img->storeAs('services',$pimg,'public');
                    $service->service_name=$request->service_name;
                    $service->img=$pimg;
                    $d=$service->save();
                    if($d)
                    {
                        return Redirect::back()->with('success','Data Updated');
                    }
                    else{
                        return Redirect::back()->with('fail','Data Updation Fail');
                    }
                }
                else
                {
                    $service->service_name=$request->service_name;
                    $service->save();
                    return Redirect::back()->with('success','Data Updated');
                }
            }

       

    }

    public function add_sub_service_type(Request $request)
    {
        //return $request->all();
        $validateData = Validator::make($request->all(), [
            'name'=>'required',
            'service_id' => 'required',
            'sub_service_id' => 'required',
            'price' => 'required|numeric',
            'img' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'rating'=>'required|numeric',
            'description'=>'required',

        ]);
        if($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData);
        }
        else{
  
        
            $img=$request->file('img')->store('services','public');
           
           if($img)
           {
                 
            $service_type= new Service_type;
            $service_type->service_id=$request->service_id;
            $service_type->service_type=$request->sub_service_id;
            $service_type->sub_type=$request->name;
            $service_type->price=$request->price;
            $service_type->img=$img;
            $service_type->rating=$request->rating;
            $service_type->	description=$request->description;
            $service_type->save();
              
            return Redirect::back();
           }
           else{
             return Redirect::back()->with('message','Data Not inserted');
        
           }
        }
       
    }

    public function sub_service_type($id,$service_id)
    {
        
        $data["services_type"] = DB::table('services_type')
                                 ->where('service_type',$id)
                                 ->get();

        $data["services"] = DB::table('services')
                            ->select('service_name','id')
                            ->where('id',$service_id)
                            ->first();

         $data["sub_services"] = DB::table('sub_services')
                            ->select('sub_service_name','id')
                            ->where('id',$id)
                            ->first();
        return  view('sub_service_type',$data);
        
    }
    public function add_sub_service(Request $request)
    {   
       // return $request->all();
        $validateData=Validator::make($request->all(),[
            "sub_service_name"=>'required'
        ]);
        if($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData);
        }
        else{
             $sub_service=new Sub_service;
             $sub_service->service_id=$request->service_id;
             $sub_service->sub_service_name=$request->sub_service_name;
             $sub_service->save();
             return Redirect::back();
        }
       

    }

    public function sub_service($id)
    {
        $data["sub_services"] = DB::table('sub_services')
                                    ->where('service_id',$id)
                                 ->get();
         $data["services"] = DB::table('services')
                                ->select('service_name','id')
                                ->where('id',$id)
                                 ->first();
                                 
      
        return view('sub_service_list',$data);
    } 

    public function services()
    {
      
       $services = DB::table('services')
            ->select('*')
            ->get();
            return $services;
    }

    public function service_list()
    {
        $data["services"]=$this->services();
        return view('service_list',$data);
    }



    public function upload(Request $request)
    {
   
        $validator = Validator::make($request->all(), [
            'img' => 'max:500000|required',
            'service_name'=> 'required'

        ]);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        else{
            $pimg= $request->img->getClientOriginalName();
            $d=$request->img->storeAs('services',$pimg,'public');
           if($d)
           {
               $service= new Service;
               $service->service_name=$request->service_name;
               $service->img=$pimg;
               $service->save();
               Session::flash('success','Data Inserted');
               return Redirect::back();
           }
           else{
            return Redirect::back()->withErrors('fail','Image upload fail');
           }
        }

    }


    public function delete_service($id)
    {
        $service=Service::find($id);
        
        DB::table('services')->where('id',$id)->delete();
        DB::table('services_type')->where('service_id',$id)->delete();
        DB::table('sub_services')->where('service_id',$id)->delete();
        unlink(public_path() .  '/storage/services/' . $service->img );
        Session::flash('success','Data Deleted');
        return Redirect::back();

    }


    public function edit_service($id)
    {
        $data["service"]=Service::find($id);
        return view('edit_service',$data);
    }


    public function get_leads(Request $request)
    {
      
       // $sub_service=$request->sub_service;
      //  $c=count($sub_service);
        //return $c;
          //  return $request->sub_service[0];
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'user_id' => 'required',
            'username'=> 'required',
            'address'=> 'required',
            'mobile'=>'required|max:10|min:10',
            'service_id'=> 'required',
           // 'price'=> 'required',
          //  'quantity'=> 'required',

        ]);
        

        if($validator->fails())
        {
            return response()->json([
                "message"=>"Validation fail"
            ]);
        }
        else{

            $sub_service=$request->sub_service;
            $c=count($sub_service);
           //return count($sub_service);

            $lead=new Lead;
            $lead->user_id=$request->user_id;
            $lead->transaction_id=$request->transaction_id;
            $lead->username=$request->username;
            $lead->address=$request->address;
            $lead->mobile=$request->mobile;
            $lead->service_id=$request->service_id;
            $lead->accept_status="new";
            $lead->status="incomplete";
            $lead->total_price=$request->total_price;
            $lead->latitude=$request->latitude;
            $lead->longitude=$request->longitude;
            
          //  $lead->price=$request->price;
          //  $lead->quantity=$request->quantity;
            $lead->payment_status=$request->payment_status;
            $lead->save();

            
            for($a=0;$a<=$c-1;$a++)
            {
                $sub_lead=new Sub_service_lead;
                $sub_lead->lead_id=$lead->id;
                $sub_lead->sub_service=$request->sub_service[$a];
                $sub_lead->price=$request->price[$a];
                $sub_lead->quantity=$request->quantity[$a];
                $sub_lead->save();
            }

            return response()->json([
                "message"=>"Data saved"
            ]);


        }



    }






}
