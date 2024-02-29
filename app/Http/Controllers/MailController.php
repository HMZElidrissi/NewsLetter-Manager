<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail;

class MailController extends Controller
{
    // 
    public function showemail(){
        $email =  new Mail;
        $emails = $email->simplePaginate();
        return view ('email.index' , compact('emails'));
    }

    public function emailAddPage(Request $request){
        return view ('email.creat');
}


    public function addemail(Request $request){
    $request->validate([
        'email' => 'required',
    ]);
    $email = new Mail();
    $email->email = $request->email;
    $email->save();
    return redirect('emailpage');

    }

    public function deleteEmail(Request $request){
        $id = $request->id;
        $email =  new Mail;
        $email->find($id)->delete();
        return redirect('emailpage')->with('msg' , "Email est supprimer avec succes");
        }   
        
        
        public function pageUpdateMail(Request $request){
            $id= $request->id;
            $getemails = new Mail();
            $email = $getemails->find($id);
            // dd($email);
            return view ('email.edit' , compact('email'));
        }

        public function updateEmail(Request $request){
            $id= $request->id;
            $mail = $request->email;
            $getemails = new Mail();
            $email = $getemails->find($id);
            $email->email = $mail;
            $email->update();
            return redirect('/emailpage');    
        }

     }
