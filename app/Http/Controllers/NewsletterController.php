<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Mail;
use App\Models\Newsletter;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $newsletters = Newsletter::where('content', 'LIKE', '%' . $search . '%')
            ->orWhereHas('categories', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('mails', function ($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%');
            })
            ->get();

        return view('newsletter.index', compact('newsletters'));
    }


    public function index()
    {
        $newsletters = Newsletter::join('categories', 'newsletters.category_id', '=', 'categories.id')
            ->join('users', 'newsletters.user_id', '=', 'users.id')
            ->select('newsletters.*', 'categories.name as category_name', 'users.name as user_name')
            ->paginate(5); // Number of newsletters per page (you can adjust this number)

        $categories = Category::all();

        return view('newsletter.index', compact('newsletters', 'categories'));
    }

    public function filter(Request $request)
    {
        $selectedCategories = $request->input('category', []);

        $newsletters = Newsletter::join('categories', 'newsletters.category_id', '=', 'categories.id')
            ->join('users', 'newsletters.user_id', '=', 'users.id')
            ->whereIn('categories.id', $selectedCategories)
            ->select('newsletters.*', 'categories.name as category_name', 'users.name as user_name')
            ->paginate(5);

        $categories = Category::all();

        if ($newsletters->isEmpty()) {
            return redirect()->route('newsletter.index')->with('message', 'No newsletters available with this category.');
        }

        return view('newsletter.index', compact('newsletters', 'categories'));
    }
}
