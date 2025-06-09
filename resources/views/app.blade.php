<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Inertia App</title>
    @vite('resources/js/app.js') 
    @inertiaHead
</head>
<body>
    @routes
    @inertia 
</body>
</html>