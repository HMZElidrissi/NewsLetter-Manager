@extends('layouts.app')

@section('title', 'Manage Newsletter')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Newsletter</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the Newsletter of products.</p>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('newsletter/create') }}"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-amber-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 sm:w-auto">+
                    Add Newsletter</a>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Newsletter Image</th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Newsletter Title</th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Newsletter SubHeader</th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Newsletter content</th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Newsletter Category</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white container">
                                @foreach ($newsletters as $Newsletter)
                                    <tr class="post">

                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div class="flex space-x-2">
                                                <img src="{{ asset($Newsletter->image) }}" alt="Newsletter image">
                                            </div>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div class="flex space-x-2">
                                                {{ $Newsletter->title }}

                                            </div>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div class="flex space-x-2">
                                                {{ $Newsletter->subheader }}

                                            </div>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div class="flex space-x-2">
                                                <div id="short_content_{{ $Newsletter->id }}" class="truncate">
                                                    {{ Str::limit($Newsletter->content, 20) }}
                                                    <button onclick="showMore({{ $Newsletter->id }})"
                                                        class="text-blue-500 hover:text-blue-700">See more</button>
                                                </div>
                                                <div id="full_content_{{ $Newsletter->id }}" class="hidden">
                                                    {{ $Newsletter->content }}
                                                    <button onclick="showLess({{ $Newsletter->id }})"
                                                        class="text-blue-500 hover:text-blue-700">Show less</button>
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div class="flex space-x-2">
                                                {{ $Newsletter->category->name }}
                                            </div>
                                        </td>
                                        <td class="flex mt-3">
                                            <a href="{{route('newsletter.email',['id' =>$Newsletter->id])}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                                </svg>

                                            </a>
                                            <a href="{{ route('newsletter.edite', ['id' => $Newsletter->id]) }}">

                                                <svg class="w-4 h-5 mx-2" viewBox="0 -0.5 21 21" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g id="Dribbble-Light-Preview"
                                                            transform="translate(-99.000000, -400.000000)" fill="#9ca3af">
                                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                                <path
                                                                    d="M61.9,258.010643 L45.1,258.010643 L45.1,242.095788 L53.5,242.095788 L53.5,240.106431 L43,240.106431 L43,260 L64,260 L64,250.053215 L61.9,250.053215 L61.9,258.010643 Z M49.3,249.949769 L59.63095,240 L64,244.114985 L53.3341,254.031929 L49.3,254.031929 L49.3,249.949769 Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                            <form action="{{ route('newsletter.delete', ['id' => $Newsletter->id]) }}"
                                                method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg class="w-5 h-5" fill="#000000" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill="#ef4444"
                                                            d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-load-status">
        <div class="" style="display: flex; justify-content: center; align-items: center;">
            <span class="loader-ellips__dot" style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; background-color: #333; margin-right: 5px; animation: dot1 1s infinite;"></span>
            <span class="loader-ellips__dot" style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; background-color: #333; margin-right: 5px; animation: dot2 1s infinite;"></span>
            <span class="loader-ellips__dot" style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; background-color: #333; margin-right: 5px; animation: dot3 1s infinite;"></span>
            <span class="loader-ellips__dot" style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; background-color: #333; margin-right: 5px; animation: dot4 1s infinite;"></span>                                                
        </div>
        <p class="infinite-scroll-last" style="display: flex; justify-content: center; align-items: center; color:darkgray; font-family: Arial, Helvetica, sans-serif; font-size:x-large">End of content</p>
        <p class="infinite-scroll-error">No more pages to load</p>
    </div>

    <script>
        function showMore(id) {
            document.getElementById('short_content_' + id).style.display = 'none';
            document.getElementById('full_content_' + id).style.display = 'block';
        }

        function showLess(id) {
            document.getElementById('short_content_' + id).style.display = 'block';
            document.getElementById('full_content_' + id).style.display = 'none';
        }
    </script>
    <script>
        new InfiniteScroll('.container', {
            path: getPenPath,
            append: '.post',
            status: '.page-load-status',
        });

   
       function getPenPath() {
         const nextPenSlugs = [];
         for(let i = 2; i<={{ $newsletters->lastPage() }}; i++){
           nextPenSlugs.push('index?page='+i);
         }
   
         return nextPenSlugs[ this.loadCount ];
       }
   
   </script>

@endsection
