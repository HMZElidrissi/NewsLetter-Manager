@extends('layouts.app')

@section('title', 'Manage categories')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Emails</h1>
      <p class="mt-2 text-sm text-gray-700">A list of all Emails.</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
      <a href="/emailAddPage" class="inline-flex items-center justify-center rounded-md border border-transparent bg-amber-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 sm:w-auto">+ Add Email</a>
    </div>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Email</th>

                <th></th>
                <th></th>
                <th></th>
                <th></th>
                
                
                
                <th scope="col"  class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Action</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
              {{-- @foreach ($categories as $category) --}}

              @forelse ($emails as $email)
                  
              
              <tr>
                <td class="whitespace-nowrap pl-4 pr-3 py-4 text-sm text-gray-500">
                   {{$email->email}}
                </td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>

             
                <td>
                      <a href="/deleteEmail?id={{$email->id}}" class="text-red-600" >Supprimer</a> 
                      <a href="/pageUpdateMail?id={{$email->id}}" class="text-sky-500">Modifier</a> 
                </td>
               
              </tr>

              @empty
                  
              @endforelse
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
