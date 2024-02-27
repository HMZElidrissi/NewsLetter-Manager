@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-100 rounded-lg p-6">
            <p class="text-lg font-semibold mb-4">Filter by Category</p>
            <form action="{{ route('newletter.filter') }}" method="GET">
                @csrf
                @foreach ($categories as $category)
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="category[]" id="category{{ $category->id }}" value="{{ $category->id }}" class="mr-2 rounded">
                    <label for="category{{ $category->id }}" class="text-gray-700">{{ $category->name }}</label>
                  
            </div>
            

                @endforeach
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>          
              </form>
        </div>
        <div>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">content</th>
                        <th class="px-4 py-2">category</th>
                        <th class="px-4 py-2">user</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsletters as $newsletter) 
                    <tr>
                        <td class="border px-4 py-2">{{ $newsletter->content}}</td>
                        <td class="border px-4 py-2">{{  $newsletter->category_name}}</td>
                        <td class="border px-4 py-2">{{ $newsletter->user_name}}</td>
                    
                    </tr>
                        
                    @endforeach
                </table>
                <!-- Add this section below the table -->
<div class="mt-4">
    {{ $newsletters->links() }}
</div>
              <!-- Add this section to your index.blade.php view -->
@if (session('message'))
<div class="alert alert-danger">
    {{ session('message') }}
</div>
@endif

<!-- Rest of your view content -->
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection