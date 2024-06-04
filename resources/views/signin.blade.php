<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MoneySavers | Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <main class="bg-lavender-100 flex justify-center items-center h-screen font-['DM_Sans'] flex-col gap-1">
        @if ($errors->any())
            <div class="bg-danger text-white flex flex-col justify-center items-center gap-2 w-[350px] rounded-md p-2">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif
        @if (session('success'))
            <div class="bg-success text-white flex flex-col justify-center items-center gap-2 w-[350px] rounded-md p-2">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <form method="post" action="/signin" class="border-2 border-outline bg-white flex flex-col justify-center items-center gap-2 w-[350px] rounded-md p-6">
            @csrf
            <h3 class="font-semibold text-lg py-2">MoneySavers</h3>
            <div class="flex flex-col w-full">
                <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="username">Username:</label>
                <input class="outline-none border-outline border-2 rounded-md py-2 px-3" type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="flex flex-col w-full">
                <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="password">Password:</label>
                <input class="outline-none border-outline border-2 rounded-md py-2 px-3" type="password" name="password" id="password" placeholder="••••••••">
            </div>
            <div class="flex flex-col w-full mt-2 gap-2">
                <button class="py-2 rounded-md bg-lavender-600 active:bg-lavender-700 text-lavender-100" type="submit">Sign In</button>
                <a href="/signup" class="text-center py-2 rounded-md border-lavender-600 border-2 text-lavender-600 active:border-lavender-700 active:text-lavender-700">Don't Have Account?</a>
            </div>
        </form>
    </main>
</body>
</html>