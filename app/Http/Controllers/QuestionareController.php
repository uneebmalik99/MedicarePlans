<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionaire;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use App\Models\QuestionnaireV1;
use Carbon\Carbon;

class QuestionareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($s_1,$s_2,$s_3,$s_4,$s_5,$transaction_id);
             //   dd($request);
             $s1 = $request->query('sub1');

             // returns "Bar"
             $s2 = $request->query('sub2');
             $s3 = $request->query('sub3');

             // returns "Bar"
             $s4 = $request->query('sub4');
             $s5 = $request->query('sub5');

             // returns "Bar"
             $transaction_id = $request->query('transaction_id');
             $aff_id = $request->query('affid');
             $off_id = $request->query('offid');
            return view('pages.questionare1',['s_1' => $s1,'s_2' => $s2,'s_3' => $s3 ,'s_4' => $s4,'s_5' => $s5,'transaction_id' => $transaction_id, 'aff_id' => $aff_id,'off_id' => $off_id ]);
       
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
        
        // dd($request->all());
        //
        $dataReq = $request->all();
        if(preg_match('/\s/',$dataReq['first_name'])){
            $name = explode(' ',$dataReq['first_name']);
            $first_name = $name[0];
            $last_name = $name[1];
            //$request->merge(['last_name' => $last_name]);
            $dataReq['first_name'] = $first_name;
            $dataReq['last_name'] = $last_name;
        }
         
        $validator = Validator::make($dataReq, [
            'bd_month' => 'nullable|numeric',
            'bd_day' => 'nullable|numeric',
            'bd_year' => 'nullable|numeric',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'string|required',
            'med_care' => 'boolean',
            'first_name' => 'required|string',
            'last_name' => 'string|nullable',
            'address' => 'string|max:255|min:7',
            's1_id' => 'nullable',
            's2_id' => 'nullable',
            's3_id' => 'nullable',
            's4_id' => 'nullable',
            's5_id' => 'nullable',
            'transaction_id' => 'nullable',
            'aff_id' => 'nullable',
            'off_id' => 'nullable'
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
        //dd($data);
        $data['s1_id'] = isset($data['s1_id']) ? $data['s1_id'] : null;
        $data['s2_id'] =  isset($data['s2_id']) ? $data['s2_id'] : null;
        $data['s3_id'] = isset($data['s3_id']) ? $data['s3_id'] : null;
        $data['s4_id'] = isset($data['s4_id']) ? $data['s4_id'] : null;
        $data['s5_id'] = isset($data['s5_id']) ? $data['s5_id'] : null;
        $year = $data['bd_year'];
        $month = $data['bd_month'];
        $day = $data['bd_day'];
        
        $dob = strval($year).'-'.strval($month).'-'.strval($day);
        $age = Carbon::parse($dob)->age;
        
		if(isset($data['med_care']) && $data['med_care'] == 1){
			$currently_enrolled = 'Yes';
		}
		else{
			$currently_enrolled = 'No';
		}
        $response = Http::asForm()->post('https://rubicon.leadspediatrack.com/post.do',[
            "lp_campaign_id"=>"63c5b3da19919",
            "lp_campaign_key"=>"xKfk6XnCW8v3rwhRqmPT",
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'] ?? null,
            "Ip_response" => "JSON",
			"lp_s1" => $data['s1_id'],
            "lp_s2" => $data['s2_id'],
            "lp_s3" => $data['s3_id'],
            "lp_s4" => $data['s4_id'],
            "lp_s5" => $data['s5_id'],
            "transaction_id" => $data['transaction_id'],
            "affiliate_id" => $data['aff_id'],
            "dob" => $dob,
            "address" => $data['address'],
            "phone_home" => $data['phone'],
            "zip_code" => $data['zip_code'],
            "country" => $data['country'],
            "state" => $data['state'],
            "city" => $data['city'],
            "email_address" => $data['email'],
			"currently_enrolled" => $currently_enrolled ,
            

        ]);
        if($response->successful()){
            logger($response);
            $query=['transaction_id'=>$data['transaction_id'],'sub1'=>$data['s1_id'], 'sub2'=>$data['s2_id'] , 'sub3' => $data['s3_id'],'sub4' => $data['s4_id'],'sub5' => $data['s5_id'],'affid'=>$data['aff_id'],'offid' => $data['off_id'],'age' => $age,'zip_code' => $data['zip_code']];
            $inserted = Questionaire::create($data);
            return redirect()->route('thankyou',$query);

        }
        else{
            $query=['sub1'=>$data['s1_id'], 'sub2'=>$data['s2_id'] , 'sub3' => $data['s3_id'],'sub4' => $data['s4_id'],'sub5' => $data['s5_id'],'age' => $age,'transaction_id'=>$data['transaction_id'],'offid' => $data['off_id'],'affid'=>$data['aff_id'],'zip_code' => $data['zip_code']];

            return redirect()->route('thankyou',$query);
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
    public function page_view(Request $request){
        $s1 = $request->query('s1');

        // returns "Bar"
        $s2 = $request->query('s2');
        $s3 = $request->query('s3');

        // returns "Bar"
        $s4 = $request->query('s4');
        $s5 = $request->query('s5');

        // returns "Bar"
        $transaction_id = $request->query('transaction_id');
        $aff_id = $request->query('aff_id');
        $off_id = $request->query('offid');

        $age = $request->query('age');
        return view('pages.thankyou',['s_1' => $s1,'s_2' => $s2,'s_3' => $s3 ,'s_4' => $s4,'s_5' => $s5,'transaction_id' => $transaction_id, 'affid' => $aff_id,'offid' => $off_id,'age' => $age]);
    }

    public function v1_index(Request $request){
        return view('pages.v1.index');
    }
    public function v1_store(Request $request){
        
        
        $dataReq = $request->all();
        
        if(preg_match('/\s/',$dataReq['name'])){
            $name = explode(' ',$dataReq['name']);
            $first_name = $name[0];
            $last_name = $name[1];
            //$request->merge(['last_name' => $last_name]);
            $dataReq['name'] = $first_name;
            $dataReq['last_name'] = $last_name;
        }
        
        
        $validator = Validator::make($dataReq , [
            'bd_class' => 'nullable|string',
            'last_name' => 'nullable|string',
            'med_care' => 'nullable|boolean',
            'name' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable',
            's1_id' => 'nullable',
            's2_id' => 'nullable',
            's3_id' => 'nullable',
            's4_id' => 'nullable',
            's5_id' => 'nullable',
            'transaction_id' => 'nullable',
            'aff_id' => 'nullable',
            'off_id' => 'nullable'
            
        ]); 
        $data = $validator->validated();
        
        if(isset($data['med_care']) && $data['med_care'] == 1){
			$currently_enrolled = 'Yes';
		}
		else{
			$currently_enrolled = 'No';
		}
        $response = Http::asForm()->post('https://rubicon.leadspediatrack.com/post.do',[
            "lp_campaign_id"=>"63c5b3da19919",
            "lp_campaign_key"=>"xKfk6XnCW8v3rwhRqmPT",
            "first_name" => $dataReq['name'],
            "last_name" => $dataReq['last_name'] ?? null,
            "Ip_response" => "JSON",
			"lp_s1" => $data['s1_id'],
            "lp_s2" => $data['s2_id'],
            "lp_s3" => $data['s3_id'],
            "lp_s4" => $data['s4_id'],
            "lp_s5" => $data['s5_id'],
            "transaction_id" => $data['transaction_id'],
            "affiliate_id" => $data['aff_id'],
            "phone_home" => $data['phone'],
            "email_address" => $data['email'],
			"currently_enrolled" => $currently_enrolled ,
            

        ]);
        if($response->successful()){
            
            $query=['transaction_id'=>$data['transaction_id'],'sub1'=>$data['s1_id'], 'sub2'=>$data['s2_id'] , 'sub3' => $data['s3_id'] ,'sub4' => $data['s4_id'],'sub5' => $data['s5_id'],'affid'=> $data['aff_id'],'offid' => $data['off_id']];
            
            $inserted = QuestionnaireV1::create($data);
            return redirect()->route('thankyou',$query);
        }

        
    
    }

    public function v2_index(Request $request){
        $s1 = $request->query('sub1');

        
        $s2 = $request->query('sub2');
        $s3 = $request->query('sub3');

       
        $s4 = $request->query('sub4');
        $s5 = $request->query('sub5');

        
        $transaction_id = $request->query('transaction_id');
        $aff_id = $request->query('affid');
        $off_id = $request->query('offid');

       
        return view('pages.questionare',['s_1' => $s1,'s_2' => $s2,'s_3' => $s3 ,'s_4' => $s4,'s_5' => $s5,'transaction_id' => $transaction_id, 'aff_id' => $aff_id ,'off_id' => $off_id]);
    }
}
