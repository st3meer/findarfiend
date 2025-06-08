<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Inertia App</title>
    @vite('resources/js/app.js') {{-- Loads your Vue code --}}
    @inertiaHead
</head>
<body>
    @routes
    @inertia {{-- Renders Vue pages --}}
</body>
</html>