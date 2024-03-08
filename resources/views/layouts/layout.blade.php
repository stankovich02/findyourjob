<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        FindYourJob | @yield('title')
    </title>
    @include("fixed.client.head")
</head>
<body>
    @include("fixed.client.header")

    @yield("content")

    @include("fixed.client.footer")
</body>
</html>

