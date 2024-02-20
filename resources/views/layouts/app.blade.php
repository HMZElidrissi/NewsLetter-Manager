<!doctype html>
<html class="h-full bg-gray-100" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>
<body class="h-full">
<div>
  @include('layouts._sidebar')
  <div class="md:pl-64 flex flex-col flex-1">
    @include('layouts._navbar')
    <main class="flex-1">
      <div class="py-6">
        <!-- <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8"> -->
          <!-- Replace with your content -->
          <!-- <div class="py-4">
            <div class="border-4 border-dashed border-gray-200 rounded-lg h-96"></div>
          </div> -->
          <!-- /End replace -->
          @yield('content')
        <!-- </div> -->
      </div>
    </main>
  </div>
</div>
@if (session()->has('success'))
  <div id="success-message" class="fixed bg-green-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
    {{ session('success') }}
  </div>
@endif
@if (session()->has('error'))
  <div id="error-message" class="fixed bg-red-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
    {{ session('error') }}
  </div>
@endif
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
</html>
