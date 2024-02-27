<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    // 
    public function index(){
        $email =  new Email();
        $emails = $email->simplePaginate();
        return view ('email' , compact('emails'));
    }
        
    
    public function insertEmail(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
        $email = new Email();
        $email->name = $request->name;
        $email->save();
        return redirect('/');
        }

    //     public function delete_Email(Request $request){
    //     $id = $request->id;
    //     $email = Email::find($id);
    //     $email->delete();
    //     return redirect('/');
    // }
}
