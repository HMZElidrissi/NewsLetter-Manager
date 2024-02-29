<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>{{ $subject }}</h1>
    <div>{!! $content !!}</div>
    <div>
        <h2>{{ $newsletter->title }}</h2>
        <h3>{{ $newsletter->subheader }}</h3>
        <div>{!! $newsletter->content !!}</div>
        <!-- Embed the image -->
        <img src="{{ $message->embed($imagePath) }}" alt="Newsletter Image">
    </div>
</body>
</html>
