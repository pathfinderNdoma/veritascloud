<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //Validate first.
      $this->validate($request, [
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required'
            
      ]);
            $name       =   $request->name;
            $email      =   $request->email;
            $subject    =   $request->subject;
            $message    =   $request->message;
            

            $message                =       new Messages;
            $message->name          =       $request->input('name');
            $message->email         =       $request->input('email');
            $message->subject       =       $request->input('subject');
            $message->message       =       $request->input('message');

            if($message->save()){
                echo '<script>alert("Your Message has been received, we will contact you shortly")</script>';
                return redirect('index')->with('success', 'Your Message has been received, we will contact you shortly');
        }
    

        
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
