<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>
    <h1>Test Page</h1>
    
    @include('frontend.partials._header', ['showSearch' => true])
    
    <p>Content here</p>
    
    @include('frontend.partials._footer')
</body>
</html>
