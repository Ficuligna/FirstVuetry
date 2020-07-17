<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task List</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <script src="js/app.js" charset="utf-8"></script>

    </head>
    <body>
      <header>
        @include('components.header')
      </header>
      <main>
        @yield('main_section')
      </main>
      <footer>
        @include('components.footer')
      </footer>

    </body>
</html>
