<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $newsletters = Newsletter::join('categories' , 'newsletters.category_id' , '=' , 'categories.id')->where(function ($query) use ($search) {
            $query->where('content', 'LIKE', '%' . $search . '%')
                  ->orwhere('name', 'like', '%' . $search . '%')
                  ->orwhere('title', 'like', '%' . $search . '%');
            })->paginate(2);
           
        return view('newsletter.index', compact('newsletters'));
    }

    
    public function index()
    {
        $newsletters = Newsletter::with('category')->paginate(2);
        sleep(1.5);
        return view('newsletter.index', compact('newsletters'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('newsletter.create', compact('categories'));
    }
    public function edit($id)
    {
        $categories = Category::all();
        $newsletter = Newsletter::find($id);
        return view('newsletter.edit', compact('categories', 'newsletter'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'subheader' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'sometimes|image', 
        ]);

        $newsletter = Newsletter::find($id);
        if (!$newsletter) {
            return redirect()->route('newsletter.index')->withErrors('Newsletter not found.');
        }

        $newsletter->title = $request->title;
        $newsletter->subheader = $request->subheader;
        $newsletter->content = $request->content;
        $newsletter->category_id = $request->category_id;

        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('images/newsletter'), $imageName); 

            
            $oldImage = public_path($newsletter->image);
            if (file_exists($oldImage)) {
                @unlink($oldImage); 
            }

            $newsletter->image = 'images/newsletter/' . $imageName;
        }

        $newsletter->save(); 
        return redirect()->route('newsletter.index')->with('success', 'Newsletter updated successfully.');
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'subheader' => 'required',
    //         'content' => 'required',
    //     ]);

    //     $newsletter = Newsletter::find($id);
    //     $newsletter->title = $request->title;
    //     $newsletter->subheader = $request->subheader;
    //     $newsletter->content = $request->content;
    //     $newsletter->category_id = $request
    //         ->category_id;
    //     $newsletter->save();
    //     return redirect()->route('newsletter.index');
    // }
    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        if (!$newsletter) {
            return redirect()->route('newsletter.index')->withErrors('Newsletter not found.');
        }

        $image = public_path($newsletter->image);
        if (file_exists($image)) {
            @unlink($image); 
        }

        $newsletter->delete();
        return redirect()->route('newsletter.index')->with('success', 'Newsletter deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subheader' => 'required',
            'content' => 'required',
            'image' => 'required|image', 
            'category_id' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); 
        $image->move(public_path('images/newsletter'), $imageName); 

        $newsletter = new Newsletter();
        $newsletter->title = $request->title;
        $newsletter->subheader = $request->subheader;
        $newsletter->content = $request->content;
        $newsletter->image = 'images/newsletter/' . $imageName; 
        $newsletter->category_id = $request->category_id;

        $newsletter->save();

        
        return redirect()->route('newsletter.index'); 
    }
    // public function email($id)
    // {
    //     $newsletter = Newsletter::find($id);
    //     return view('newsletter.email', compact('newsletter'));
    // }
    // public function Sendemail(Request $request, $id)
    // {
    //     $newsletter = Newsletter::find($id);
    //     $emails = $request->emails;
    //     $subject = $request->subject;
    //     $content = $request->content;
    //     foreach ($emails as $email) {
    //         Mail::to($email)->send(new SendNewsletter($subject, $content, $newsletter));
    //     }
    //     return redirect()->route('newsletter.index');
    // }
}
