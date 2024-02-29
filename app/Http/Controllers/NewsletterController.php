<?php

namespace App\Http\Controllers;

use App\Mail\SendNewsletter;
use App\Models\Category;
use App\Models\Mail as mailModel;
use App\Models\Newsletter;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class NewsletterController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $newsletters = Newsletter::where(function ($query) use ($search) {
            $query->where('content', 'LIKE', '%' . $search . '%');
        })
            ->orWhereHas('categories', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWherehas('mails', function ($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%');
            })->get();
        return view('newsletter.index', compact('newsletters'));
    }
    public function filter(Request $request)
    {
        $selectedCategories = $request->input('category', []);
        // $selectedCategories = $request->input('category', []);

        $newsletters = Newsletter::with('category')->whereHas('category', function ($query) use ($selectedCategories) {
            $query->whereIn('id', $selectedCategories);
        })->get();

        $categories = Category::all();

        if ($newsletters->isEmpty()) {
            return redirect()->route('newsletter.index')->with('message', 'No newsletters available with this category.');
        }

        return view('newsletter.index', compact('newsletters', 'categories'));
    }
    public function index()
    {
        $newsletters = Newsletter::with('category')->get();
        $categories = Category::all();
        return view('newsletter.index', compact('newsletters','categories'));
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
    public function email($id)
    {
        $mails = mailModel::all();
        return view('newsletter.email', compact('mails'));
    }
    public function Sendemail(Request $request, $id)
    {
        $newsletter = Newsletter::find($id);
        $EmailSubject = $request->EmailSubject;
        $EMailContent = $request->EMailContent;

        if ($request->input('emails') === 'all') {
            $emails = mailModel::all()->pluck('email');
        } elseif (!empty($request->input('emails'))) {
            $emails = mailModel::whereIn('id', $request->input('emails'))->pluck('email');
        } else {
            return redirect()->back()->withErrors('No email addresses selected.');
        }

        foreach ($emails as $email) {
            Mail::to($email)->queue(new SendNewsletter($EmailSubject, $EMailContent, $newsletter, $newsletter->image));
        }

        return redirect()->route('newsletter.index');
    }



    // public function Sendemail(Request $request, $id)
    // {
    //     $newsletter = Newsletter::find($id);
    //     $emails_id = $request->emails;
    //     $emails = mailModel::find($emails_id);
    //     $EmailSubject = $request->EmailSubject;
    //     $EMailContent = $request->EMailContent;
    //     $emails = $request->emails === 'all' ? mailModel::all() : mailModel::findMany($request->emails);

    //     foreach ($emails as $email) {
    //         Mail::to($email)->send(new SendNewsletter($EmailSubject, $EMailContent, $newsletter, $newsletter->image));
    //     }
    //     return redirect()->route('newsletter.index');
    // }


}
