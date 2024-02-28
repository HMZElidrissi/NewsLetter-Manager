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
    public function index()
    {
        $newsletters = Newsletter::with('category')->get();
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
            'image' => 'sometimes|image', // 'sometimes' rule makes it optional but must be an image when provided
        ]);

        $newsletter = Newsletter::find($id);
        if (!$newsletter) {
            return redirect()->route('newsletter.index')->withErrors('Newsletter not found.');
        }

        $newsletter->title = $request->title;
        $newsletter->subheader = $request->subheader;
        $newsletter->content = $request->content;
        $newsletter->category_id = $request->category_id;

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Creating a unique name for the image
            $image->move(public_path('images/newsletter'), $imageName); // Moving the image to the public directory

            // Optional: Delete the old image from the filesystem
            $oldImage = public_path($newsletter->image);
            if (file_exists($oldImage)) {
                @unlink($oldImage); // Use @ to suppress error if file doesn't exist
            }

            $newsletter->image = 'images/newsletter/' . $imageName; // Updating the image path to the new file
        }

        $newsletter->save(); // Save the updated newsletter
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

        // Optional: Delete the image from the filesystem
        $image = public_path($newsletter->image);
        if (file_exists($image)) {
            @unlink($image); // Use @ to suppress error if file doesn't exist
        }

        $newsletter->delete(); // Delete the newsletter
        return redirect()->route('newsletter.index')->with('success', 'Newsletter deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subheader' => 'required',
            'content' => 'required',
            'image' => 'required|image', // Ensure the uploaded file is an image
            'category_id' => 'required',
        ]);

        // Store the image directly in the 'public/images/newsletter' directory
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Naming the image file
        $image->move(public_path('images/newsletter'), $imageName); // Moving the file to the public directory

        // Create a new newsletter instance and set its properties
        $newsletter = new Newsletter();
        $newsletter->title = $request->title;
        $newsletter->subheader = $request->subheader;
        $newsletter->content = $request->content;
        $newsletter->image = 'images/newsletter/' . $imageName; // Storing the path relative to the public directory
        $newsletter->category_id = $request->category_id;

        // Save the newsletter
        $newsletter->save();

        // Redirect to the index page of the newsletter
        return redirect()->route('newsletter.index'); // Note the dot notation here
    }
}
