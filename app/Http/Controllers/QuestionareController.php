<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionaire;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class QuestionareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($s_1 = null , $transaction_id = null , $s_2 = null ,$s_3 = null ,$s_4 = null ,$s_5 = null)
    {
        //dd($s_1,$s_2,$s_3,$s_4,$s_5,$transaction_id);
            
            return view('pages.questionare',['s_1' => $s_1,'s_2' => $s_2 ,'s_3' => $s_3 , 's_4' => $s_4 , 's_5' => $s_5 , 'transaction_id'=>$transaction_id]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
        
        
        $validator = Validator::make($request->all(), [
            'bd_month' => 'nullable|numeric',
            'bd_day' => 'nullable|numeric',
            'bd_year' => 'nullable|numeric',
            'zip_code' => 'nullable|numeric',
            'email' => 'required|email',
            'phone' => 'string|required',
            'med_care' => 'boolean',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'string|max:255|min:7',
            's_1' => 'numeric|nullable',
            's_2' => 'numeric|nullable',
            's_3' => 'numeric|nullable',
            's_4' => 'numeric|nullable',
            's_5' => 'numeric|nullable',
            'transaction_id' => 'numeric|nullable'
        ] 
        );
        /****
         * $s_1,$s_2,$s_3,$s_4,$s_5,$transaction_id
         * $table->integer('md_id')
            $table->integer('bd_id')
            $table->integer('zp_id')
            $table->integer('em_id')
            $table->integer('usr_id')
         * 
         * 
         * 
         * 
         * 
         * 
         */
        
        $data  = $validator->validated();
        
        $data['s1_id'] = isset($data['s_1']) ? $data['s_1'] : rand(100,1000);
        $data['s2_id'] =  isset($data['s_2']) ? $data['s_2'] : rand(100,1000);
        $data['s3_id'] = isset($data['s_3']) ? $data['s_3'] : rand(100,1000);
        $data['s4_id'] = isset($data['s_4']) ? $data['s_4'] : rand(100,1000);
        $data['s5_id'] = isset($data['s_5']) ? $data['s_5'] : rand(100,1000);
        $year = $data['bd_year'];
        $month = $data['bd_month'];
        $day = $data['bd_year'];
        $dob = $year+$month+$day;
        $response = Http::post('https://rubicon.leadspediatrack.com/posting-instructions.html?c=5&type=Server',[
            "lp_campaign_id"=>"63c5b332bc6d5",
            "lp_campaign_key"=>"GjBQW24PRgprmYXJDdVM",
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "ip_response" => "json",
            "dob" => $dob,
            "address" => $data['address'],
           "phone_home" => $data['phone'],
           "zip_code" => $data['zip_code'],
           "email_address" => $data['email'],


        ]);
        if($response->successful()){
            logger($response);
            $inserted = Questionaire::create($data);
            return view('pages.thankyou');

        }
        else{
            dd($response);
        }
        /***
         * https://rubicon.leadspediatrack.com/posting-instructions.html?c=5&type=Server
         * lp_campaign_id=63c5b332bc6d5
         * lp_campaign_key=GjBQW24PRgprmYXJDdVM
         * lp_s1	No	String	Sub Affiliate 1
           lp_s2	No	String	Sub Affiliate 2
	       lp_s3	No	String	Sub Affiliate 3
	       lp_s4	No	String	Sub Affiliate 4
	       lp_s5
           first_name
           last_name
           address	
           phone_home
           zip_code
           email_address
           dob
         * 
         * 
         * 
         * 
         * 
         * 
         */
        
        











        
        
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
