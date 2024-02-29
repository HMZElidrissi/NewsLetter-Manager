@extends('layouts.app')

@section('title', 'Manage categories')

@section('content')
    <div>
        <main class="flex-1">
            <div class="py-6">
                <div class="space-y-6 space-x-6 px-6">
                    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Category</h3>
                                <p class="mt-1 text-sm text-gray-500">Update the category's information.</p>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form class="space-y-6" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid grid-cols-3 gap-6">

                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="title" class="block text-sm font-medium text-gray-700">
                                                EmailSubject
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input type="text" name="EmailSubject" id="title"
                                                    class="mt-1 focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="EMailContent" class="block text-sm font-medium text-gray-700">
                                                EMailContent
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input type="text" name="EMailContent" id="title"
                                                    class="mt-1 focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="emails"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select name="emails[]" id="emails"
                                                    class="focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    multiple>
                                                    <option value="">Select an email</option>
                                                    @foreach ($mails as $mail)
                                                        <option value="{{ $mail->id }}">{{ $mail->email }}</option>
                                                        {{-- {{dd($$mail->id)}} --}}
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" id="sendToAll"
                                                class="mt-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md px-4 py-2">
                                                Send to All
                                            </button>
                                        </div>




                                    </div>
                                    <div class="flex justify-end">
                                        <a type="button"
                                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500"
                                            href="">
                                            Cancel</a>
                                        <button type="submit"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('sendToAll').addEventListener('click', function() {
            document.getElementById('emails').value = 'all';
            document.getElementById('emails').style.display = 'none';
            document.getElementById('sendToAll').style.backgroundColor = 'red';
            document.getElementById('sendToAll').innerText = 'Revert';
            document.getElementById('sendToAll').addEventListener('click', function() {
                document.getElementById('emails').value = '';
                document.getElementById('emails').style.display = 'block';
                document.getElementById('sendToAll').style.backgroundColor = 'blue';
                document.getElementById('sendToAll').innerText = 'Send to All';
            });


        });
        // document.getElementById('sendToAll').addEventListener('click', function() {
        //     // Create a hidden input to store the value 'all'
        //     let hiddenInput = document.createElement('input');
        //     hiddenInput.type = 'hidden';
        //     hiddenInput.name = 'emails';
        //     hiddenInput.value = 'all';

        //     // Append the hidden input to the form
        //     let form = document.querySelector('form');
        //     form.appendChild(hiddenInput);

        //     // Submit the form
        //     form.submit();
        // });
    </script>
@endsection
