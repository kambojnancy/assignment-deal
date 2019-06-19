<?php

namespace App\Http\Controllers;

use App\Deal;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailSend;
Use App\Jobs\DealMailSend;

class DealController extends Controller
{


      public function __construct() 
     {
        $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $deals = Deal::latest()->paginate(5);
  
        return view('deals.index',compact('deals'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('deals.createdeal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $request->validate([
            'title'    => 'required|max:20',
            'link'     => 'required|url',
            'image'    => 'required|image',
            'discount' => 'required|numeric',
        ]);
        $image_path = $request->file('image')->store('public/image'); // this will save image in images directory and return the path
        $data = $request->except('_token', 'image');
        $data['image'] = $image_path;
        $deal = $request->user()->deal()->create($data);  
  
        dispatch(new DealMailSend($deal));

        return redirect()->route('deals.index')->with('success','Deal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
        // $deal = Deal::latest()->paginate(5);
        return view('deals.show',compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
         $deal->delete();
  
        return redirect()->route('deals.index')
                        ->with('success','Deal deleted successfully');
    }
}
