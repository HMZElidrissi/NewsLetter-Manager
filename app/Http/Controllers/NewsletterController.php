<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
   public function index(){
       $newsletters = Newsletter::all();
       return view('newsletter.index' , compact('newsletters'));
   }
   public function create(){
        $categories = Category::all();
       return view('newsletter.create',compact('categories'));
   }
   
}
