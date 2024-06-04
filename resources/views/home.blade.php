<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MoneySavers | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <div id="modalSection"></div>

    <main class="bg-lavender-100 flex justify-center items-center flex-col font-['DM_Sans'] gap-6 pb-10 pt-20">
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
        @if (session('success'))
            <div class="bg-success text-white flex flex-col justify-center items-center gap-2 w-[90%] rounded-md p-2">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <div class="flex flex-col justify-center items-center gap-2 w-[90%] rounded-md">
            <div class="flex md:flex-row flex-col w-full gap-2">
                <div class="bg-gradient-to-br from-lavender-500 to-lavender-700 w-full text-lavender-100 flex flex-col justify-center items-center p-4 rounded-md">
                    <p>Income</p>
                    <h3 class="text-xl font-semibold">Rp. {{ number_format($income, 2) }}</h3>
                </div>
                <div class="bg-gradient-to-br from-lavender-500 to-lavender-700 w-full text-lavender-100 flex flex-col justify-center items-center p-4 rounded-md">
                    <p>Spending</p>
                    <h3 class="text-xl font-semibold">Rp. {{ number_format($spending, 2) }}</h3>
                </div>
            </div>
            <div class="bg-gradient-to-br from-lavender-500 to-lavender-700 w-full text-lavender-100 flex flex-col justify-center items-center p-4 rounded-md">
                <p>Amount</p>
                <h3 class="text-xl font-semibold">Rp. {{ number_format($amount, 2) }}</h3>
            </div>
        </div>
        <div class="border-2 border-outline bg-white flex flex-col justify-center items-center gap-2 w-[90%] rounded-md p-6">
            <div class="overflow-x-auto w-full text-left">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="p-2">No</th>
                            <th class="p-2">Date</th>
                            <th class="p-2">Note</th>
                            <th class="p-2">Amount</th>
                            <th class="p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes->all() as $note)
                            <tr>
                                <td class="p-2">{{ $loop->iteration }}.</td>
                                <td class="p-2">{{ date('d/m/Y', strtotime($note->date)) }}</td>
                                <td class="p-2">{{ $note->note }}</td>
                                @if ($note->type == 'spending')
                                    <td class="p-2 text-danger">
                                        -{{ number_format($note->amount, 2) }}
                                    </td>
                                @else
                                    <td class="p-2 text-success">
                                        +{{ number_format($note->amount, 2) }}
                                    </td>
                                @endif
                                <td class="p-2 flex gap-1">
                                    <a class="text-white bg-primary p-2 rounded-md text-sm" href="/update?id={{ $note->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                    <button class="text-white bg-danger p-2 rounded-md text-sm" type="button" onclick="openAlertDelete({{ $note->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <form class="border-2 border-outline bg-white flex flex-col justify-center items-center gap-2 w-[90%] rounded-md p-6" action="/data/create" method="post">
            <div class="flex flex-col w-full">
                @csrf
                <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="type">Type:</label>
                <select class="outline-none border-outline border-2 rounded-md py-2 px-3 bg-white w-full" id="type" name="type">
                    <option selected disabled>Select Type</option>
                    <option value="income">Income</option>
                    <option value="spending">Spending</option>
                </select>
            </div>
            <div class="flex md:flex-row flex-col w-full gap-2">
                <div class="flex flex-col w-full">
                    <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="date">Date:</label>
                    <input class="outline-none border-outline border-2 rounded-md py-2 px-3 bg-white w-full" type="date" name="date" id="date" placeholder="MM/DD/YYYY">
                </div>
                <div class="flex flex-col w-full">
                    <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="amount">Amount:</label>
                    <input class="outline-none border-outline border-2 rounded-md py-2 px-3" type="number" name="amount" id="amount" placeholder="Your Amount..">
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-md flex gap-1 after:content-['*'] after:text-danger" for="note">Note:</label>
                <textarea class="outline-none border-outline border-2 rounded-md py-2 px-3" type="text" name="note" id="note" placeholder="Your Note.."></textarea>
            </div>
            <div class="flex flex-col w-full mt-2 gap-2">
                <button class="py-2 rounded-md bg-lavender-600 active:bg-lavender-700 text-lavender-100" type="submit">Add</button>
            </div>
        </form>
    </main>
    <script>
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        const todayFormatted = `${year}-${month}-${day}`;

        dateInput.value = todayFormatted;
    </script>
    <script>
        const modalSection = document.getElementById('modalSection');

        function openAlertDelete(id) {
            modalSection.innerHTML = `
            <div class="fixed z-10 w-full h-screen flex justify-center items-center backdrop-blur-sm">
                <div class="border-2 border-outline bg-white flex flex-col justify-center items-center gap-2 w-[350px] rounded-md p-6 gap-6">
                    <p>Are you sure you want to delete?</p>
                    <div class="flex gap-1 md:flex-row flex-col w-full">
                        <form class="w-full flex flex-col" action="/data/delete" method="post">
                            @csrf
                            <input type="number" name="id" value="${id}" hidden>
                            <button class="py-2 rounded-md bg-lavender-600 active:bg-lavender-700 text-lavender-100" type="submit">Yes</button>
                        </form>
                        <button class="w-full text-center py-2 rounded-md border-lavender-600 border-2 text-lavender-600 active:border-lavender-700 active:text-lavender-700" onclick="closeAlertDelete()">No</button>
                    </div>
                </div>
            </div>
            `;
        }

        function closeAlertDelete() {
            modalSection.innerHTML = "";
        }
    </script>
</body>