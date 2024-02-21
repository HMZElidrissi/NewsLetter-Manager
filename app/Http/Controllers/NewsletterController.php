<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
   public function search(Request $request){
        $search = $request->search ;
        $newsletters = Newsletter::where(function($query) use ($search){
            $query->where('content','LIKE','%'.$search.'%');
        })
        ->orWhereHas('categories' , function($query) use ($search){
            $query->where('name','like','%'.$search.'%');
        })
        ->orWherehas('mails' , function($query) use ($search){
            $query->where('email','like','%'.$search.'%');
        })->get();
        return view('newsletter.index' , compact('newsletters'));
   }
}
