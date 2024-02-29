@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div  class="flex">
<div class="bg-gray-100 rounded-lg p-6 pt-4">
    <p class="text-lg font-semibold mb-4">Filter by Category</p>
    <form action="{{ route('newletter.filter') }}" method="GET">
        @csrf
        <div class="relative inline-flex">
            <select name="category[]" multiple id="category" class=" block w-full py-2 px-3 border bg-white rounded-md shadow-sm  ">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
           
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Filter
        </button>
    </form>
</div>



<div class="bg-gray-100 rounded-lg p-6 mt-4">
    <p class="text-lg font-semibold mb-4">Filter by Email</p>
    <form action="{{ route('newletter.filterEmail') }}" method="GET">
        @csrf
        <div class="relative inline-flex">
            <input type="text" name="email" id="email" placeholder="enter an email" class="form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <input type="submit" value="Filter" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </div>
    </form>
</div>
</div>

<div class="mt-4">
    @if (session('message'))
    <div class="alert alert-danger bg-red-500 mg-20">
        {{ session('message') }}
    </div>
@endif
    <table class="table-auto">
        <thead>
            <tr>
                <th>Content</th>
                <th>Category</th>
                <th>User</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newsletters as $newsletter)
            <tr>
                <td class="border px-4 py-2">{{ $newsletter->content }}</td>
                <td class="border px-4 py-2">{{ $newsletter->category_name }}</td>
                <td class="border px-4 py-2">{{ $newsletter->user_name }}</td>
                <td class="border px-4 py-2">{{ $newsletter->mail_email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $newsletters->links() }}
    </div>

   
</div>
@endsection