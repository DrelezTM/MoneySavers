<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MoneySavers | Update Data</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <main class="bg-lavender-100 flex justify-center items-center flex-col font-['DM_Sans'] gap-6 pb-10 pt-20 h-screen">
        <nav class="fixed shadow-sm top-0 bg-white w-full flex justify-center items-center py-4">
            <div class="flex justify-between items-center w-[90%]">
                <a href="/" class="text-lg font-semibold">MoneySavers</a>
                <form method="post" action="/signout">
                    @csrf
                    <button type="submit" class="text-danger">Sign Out</button>
                </form>
            </div>
        </nav>

        @if ($errors->any())
            <div class="bg-danger text-white flex flex-col justify-center items-center gap-2 w-[90%] rounded-md p-2">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif
        <form class="border-2 border-outline bg-white flex flex-col justify-center items-center gap-2 w-[90%] rounded-md p-6" action="/data/update" method="post">
            <div class="flex flex-col w-full">
                <input class="outline-none border-outline border-2 rounded-md py-2 px-3 bg-white w-full" type="noteid" name="noteid" id="noteid" placeholder="Note ID" value="{{ $note->id }}" hidden>
            </div>
            <div class="flex flex-col w-full">
                @csrf
                <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="type">Type:</label>
                <select class="outline-none border-outline border-2 rounded-md py-2 px-3 bg-white w-full" id="type" name="type">
                    <option value="income" {{ $note->type == "income" ? 'selected' : '' }}>Income</option>
                    <option value="spending" {{ $note->type == "spending" ? 'selected' : '' }}>Spending</option>
                </select>
            </div>
            <div class="flex md:flex-row flex-col w-full gap-2">
                <div class="flex flex-col w-full">
                    <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="date">Date:</label>
                    <input class="outline-none border-outline border-2 rounded-md py-2 px-3 bg-white w-full" type="date" name="date" id="date" placeholder="MM/DD/YYYY" value="{{ $note->date }}">
                </div>
                <div class="flex flex-col w-full">
                    <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="amount">Amount:</label>
                    <input class="outline-none border-outline border-2 rounded-md py-2 px-3" type="number" name="amount" id="amount" placeholder="Your Amount.." value="{{ $note->amount }}">
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="note">Note:</label>
                <textarea class="outline-none border-outline border-2 rounded-md py-2 px-3" type="text" name="note" id="note" placeholder="Your Note..">{{ $note->note }}</textarea>
            </div>
            <div class="flex flex-col w-full mt-2 gap-2">
                <button class="py-2 rounded-md bg-lavender-600 active:bg-lavender-700 text-lavender-100" type="submit">Add</button>
            </div>
        </form>
    </main>
</body>
</html>