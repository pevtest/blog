<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\User;
use \App\Twitter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Twitter\TwitterAPIExchange;

class EntryController extends Controller
{
    var $validation= ['title' => 'required|max:180',
                      'content' => 'required'];
    var $settings = array(
            'oauth_access_token' => "448316307-TA3ogDXlpfdq8rxtsP87WNA1Iy7e0IsuNVivuW83",
            'oauth_access_token_secret' => "0P57QHVmyp34kEFSJtrDimR1oZ504W5x3H1ucLgrEJXt6",
            'consumer_key' => "BhJehtZCJMUAMsuDWdFbRMvuz",
            'consumer_secret' => "P7iqmvu2xapvKnWOD81Ov59ODPAvMr1SVUxhZg9mExFDV8ySz6"
        );
    var $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    var $requestMethod = 'GET';

    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $data['users'] = User::with('entries')->paginate(5);
        foreach ($data['users'] as $key => $user){
            $json = $this->getTwitter($user['usertwitter']);
            
            foreach ($json as $j){                
                $t = Twitter::where('datatweetid', $j->id_str)->get();
                $j->show = isset($t[0]->show) ? $t[0]->show : 1;
            }
            
            $data['json'][$user->id] = $json;
        }
//        dd($data);
        return view('entries/index', $data);
        
    }
    public function getTwitter($usertwitter){
        $getfield = '?screen_name='.$usertwitter.'&count=3';   
        $twitter = new TwitterAPIExchange($this->settings);
        $jsonTwitter =  $twitter->setGetfield($getfield)
                             ->buildOauth($this->url, $this->requestMethod)
                             ->performRequest();
        return json_decode($jsonTwitter);
    }
    public function myentries()
    {
        $user_id= Auth::id();
        $data['user']= User::where('id',$user_id)->with('entries')->firstOrFail()->toArray();
       
        $data['json'] = $this->processTweets($data['user']['usertwitter'], $user_id);
        
        return view('entries/myentries', $data);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']= $this->request->input('title');
        $data['content']= $this->request->input('content');
        return view('entries/create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id= Auth::id();
        //Validations
        $validatedData = $request->validate($this->validation);
        $entry = new Entry;

        $entry->title = $request->title;
        $entry->content = $request->content;
        $entry->user_id = $user_id;

        $entry->save();
        
        $data['user']= User::where('id',$user_id)->with('entries')->firstOrFail()->toArray();
        $data['json'] = $this->processTweets($data['user']['usertwitter'], $user_id);
        return view('entries/myentries',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry= Entry::find($id);
        if(!is_null($entry)){
          $data['entry']= $entry->toArray();
          $data['user']= User::find($data['entry']['user_id'])->toArray();
//          dd($data);
          return view('entries/show', $data);
        }else{
          return redirect('entries');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $user_entry = Entry::select('id')->where('user_id',$user_id)->get()->pluck('id')->toArray();
        if($id > 0 && in_array($id,$user_entry )){
            $data = Entry::find($id);
            return view('entries/edit', $data);
        }else{
            return redirect('myentries');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $user_id= Auth::id();
        //Validations
        $validatedData = $request->validate($this->validation);
        
        $entry = Entry::find($request->id);        
        $entry->title = $request->title;
        $entry->content = $request->content;

        $entry->save();
        
        $data['user']= User::where('id',$user_id)->with('entries')->firstOrFail()->toArray();
        $data['json'] = $this->processTweets($data['user']['usertwitter'], $user_id);
        
        return view('entries/myentries',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
    
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
   
        $twitter = Twitter::find($input['id']);
        $twitter->show = $input['hide'];
        $twitter->save();        
        
        return response()->json(['success'=>'This twitter has been hidden.']);
    }
    
    private function processTweets($usertwitter, $user_id){
        $json = $this->getTwitter($usertwitter); //$data['user']['usertwitter']
        
        for($i=0; $i<count($json); $i++){
            
            $dbt = Twitter::where('datatweetid',$json[$i]->id_str)->get()->toArray();
            
            if(empty($dbt) || !isset($dbt[0]['show'])){
                $twitter = new Twitter();

                $twitter->user_id = $user_id;
                $twitter->datatweetid = $json[$i]->id_str;
                $twitter->created_at = date("Y-m-d", strtotime($json[$i]->created_at));

                $twitter->save();
                
                $json[$i]->show = 1;
                $json[$i]->iddb = $twitter->id;
            } else {                
                $json[$i]->show = $dbt[0]['show'];
                $json[$i]->iddb = $dbt[0]['id'];
            }
            
        }
        
        return $json;
    }
}
