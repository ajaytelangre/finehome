<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cookie;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Models\Partner_login;
use App\Models\Lead;
use App\Models\Work;

class PartnerController extends Controller
{
    //
    public function partner_info(Request $request)
    {
        $validatedData=Validator::make($request->all(),[
            "mobile"=>"required"
        ]);
        if($validatedData->fails())
        {
            return response()->json([
                "message"=>"validation fail"
            ]);
        }
        else{
            $mobile=$request->mobile;
            $info=Partner_login::where('mobile',$mobile)->first();
            return $info;


        }
        
    }

    public function accept_lead(Request $request)
    {
        $validatedData=Validator::make($request->all(),[
            "lead_id"=>"required",
            "partner_id"=>"required"
        ]);
        if($validatedData->fails())
        {
            return response()->json([
                "message"=>"validation fail"
            ]);

        }
        else{
            $lead_id=$request->lead_id;
            $partner_id=$request->partner_id;
            $partner=Partner_login::find($partner_id);
            $lead=Lead::find($lead_id);
            $lead->partner_id=$partner_id;
            $lead->partner_name=$partner->partner_name;
            $lead->partner_mobile=$partner->mobile;
            $lead->accept_status="accepted";
            $lead->save();
            return response()->json([
                "message"=>"Lead Accepted"
            ]);

        }
    }

    public function partner_img(Request $request)
    {
      
        
        $validator = Validator::make($request->all(), [
            'mobile'=>'required|max:10|min:10',
            'img'=>'required',

        ]);
        if($validator->fails())
        {
            return response()->json([
                "message" => 'validation fail',
                ]);
        }
        else{
            $mobile=$request->mobile;
            $partner = Partner_login::where('mobile',$mobile)->first();
            if($partner->partner_img)
            {
                unlink(public_path() .  '/storage/' . $partner->partner_img );
            }

            
        
            $img=$request->file('img')->store('user_file','public');
           
           if($img)
           {
                 
                 $data = Partner_login::where('mobile', $mobile)->update([
                'partner_img' => $img,
                
            ]);
              
            return response()->json([
                "message" => 'data Updated',
                ]);
           }
           else{
            return response()->json([
                "message" => 'updation fail',
                ]);
           }
        }

    }

    public function bank_details(Request $request)
    {
      
        
        $validator = Validator::make($request->all(), [
            'mobile'=>'required|max:10|min:10',
            'name' => 'required',
            'account_num' => 'required',
            'ifsc' => 'max:500000|required',
            'passbook'=>'required',

        ]);
        if($validator->fails())
        {
            return response()->json([
                "message" => 'validation fail',
                ]);
        }
        else{
            $mobile=$request->mobile;
            $partner = Partner_login::where('mobile',$mobile)->first();
            if($partner->passbook)
            {
                unlink(public_path() .  '/storage/' . $partner->passbook );
            }

            
        
            $passbook=$request->file('passbook')->store('user_file','public');
           
           if($passbook)
           {
                 
                 $data = Partner_login::where('mobile', $mobile)->update([
                'name_on_passbook' => $request->name,
                'account_num' => $request->account_num,
                'ifsc' => $request->ifsc,
                'passbook' => $passbook,
            ]);
              
            return response()->json([
                "message" => 'data inserted',
                ]);
           }
           else{
            return response()->json([
                "message" => 'updation fail',
                ]);
           }
        }

    }







    public function upload_identity(Request $request)
    {
      
        
        $validator = Validator::make($request->all(), [
            'adhar_img' => 'max:500000|required',
            'pan_img' => 'max:500000|required',
            'address_proof' => 'max:500000|required',
            'mobile'=>'required|max:10|min:10',

        ]);
        if($validator->fails())
        {
            return response()->json([
                "message" => 'validation fail',
                ]);
        }
        else{
            $mobile=$request->mobile;
            $partner = Partner_login::where('mobile',$mobile)->first();
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
           
            
            $adhar_img=$request->file('adhar_img')->store('user_file','public');
            $pan_img=$request->file('pan_img')->store('user_file','public');
            $address_proof=$request->file('address_proof')->store('user_file','public');
           
           if($adhar_img AND $pan_img AND $address_proof)
           {
                 
                 $data = Partner_login::where('mobile', $mobile)->update([
                'adhar_img' => $adhar_img,
                'pan_img' => $pan_img,
                'address_proof' => $address_proof,
            ]);
              
            return response()->json([
                "message" => 'data inserted',
                ]);
           }
           else{
            return response()->json([
                "message" => 'updation fail',
                ]);
           }
        }

    }


    public function partner_login(Request $request)
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
            $user = Partner_login::where('mobile',$mobile)->first();
            if(!$user)
            {
                $data=new Partner_login;
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


    public function partner_detail(Request $request)
    {
     
        $validatedData = Validator::make($request->all(), [
            'mobile'=>'required|max:10|min:10',
            'work_name'=>'required',
            'partner_name'=>'required',
            'email'=>'required',
            'age'=>'required',
            'address'=>'required',
            'city'=>'required',
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $mobile=$request->mobile;
            $work_name=$request->work_name;
            $partner_name=$request->partner_name;
            $email=$request->email;
            $age=$request->age;
            $address=$request->address;
            $city=$request->city;

            $user = Partner_login::where('mobile', $mobile)->update([
                'work_name' => $work_name,
                'partner_name'=>$partner_name,
                'email'=>$email,
                'age'=>$age,
                'address'=>$address,
                'city'=>$city

            ]);
            if($user)
            {
                return response()->json([
                    "message" => 'Data Updated',
                ]);
            }
            else{
                return response()->json([
                    "message" => 'Data Updation Fail'
                ]);
            }
            

        }

    }

    public function partner_lead(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'service_id'=>'required|numeric',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $service_id=$request->service_id;
            $data=DB::table('works')
            ->rightJoin('leads', 'works.service_id', '=', 'leads.service_id')
            ->select('works.work_name','leads.*')
            ->where('works.service_id',$service_id)
            ->where('leads.status','incomplete')
            ->where('leads.accept_status','new')
            ->get();
            return $data;
        }
    }

    public function partner_lead_accepted(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'service_id'=>'required|numeric',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $service_id=$request->service_id;
            $partner_id=$request->partner_id;
            $data=DB::table('works')
            ->rightJoin('leads', 'works.service_id', '=', 'leads.service_id')
            ->select('works.work_name','leads.*')
            ->where('works.service_id',$service_id)
            ->where('leads.status','incomplete')
            ->where('leads.accept_status','accepted')
            ->where('leads.partner_id',$partner_id)
            ->get();
            return $data;
        }
    }

    public function partner_lead_update(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'lead_id'=>'required|numeric',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $lead_id=$request->lead_id;
            $lead=Lead::find($lead_id);
            $lead->status="completed";
            $lead->save();
            return response()->json([
                    "message"=>"updated"
            ]);
        }
    }

    
    public function partner_lead_reassign(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'lead_id'=>'required|numeric',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $lead_id=$request->lead_id;
            $lead=Lead::find($lead_id);
            $lead->status="reassigned";
            $lead->save();
            return response()->json([
                    "message"=>"updated"
            ]);
        }
    }

    public function reaasign_lead(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'service_id'=>'required',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $service_id=$request->service_id;
            $data=DB::table('works')
            ->rightJoin('leads', 'works.service_id', '=', 'leads.service_id')
            ->select('works.work_name','leads.*')
            ->where('works.service_id',$service_id)
            ->where('leads.status','reassigned')
            ->get();
            return $data;
        }
    }

    public function partner_lead_complete(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'service_id'=>'required|numeric',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $service_id=$request->service_id;
            $data=DB::table('works')
            ->rightJoin('leads', 'works.service_id', '=', 'leads.service_id')
            ->select('works.work_name','leads.*')
            ->where('works.service_id',$service_id)
            ->where('leads.status','completed')
            ->get();
            return $data;
        }
    }
    
    public function partner_lead_details(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            
            'lead_id'=>'required|numeric',
           
        ]);

        if($validatedData->fails())
        {
            return response()->json([
                "message" => 'Data Validation Fail',
                ]);
        }
        else{
            $lead_id=$request->lead_id;
            $data=DB::table('sub_service_leads')
            ->where('lead_id',$lead_id)
            ->get();
            return $data;
        }
    }


    public function work_list()
    {
        $data = DB::table('works')->get();
        return $data;
    }


}
