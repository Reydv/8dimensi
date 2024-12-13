<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily:{
                        montserrat: ['Montserrat', 'sans'],
                    },
                    colors: {
                        primary: '#6001D1',
                        secondary: '#F7F1F1',
                        bgcolor: '#F7F1F1',
                      },
                      spacing: {
                        '25' : '25rem',
                      },
                },
            },
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('dist/8DLogo.png') }}" type="image/x-icon">
    <title>8 Dimensi - Login</title>
</head>
<body class="bg-primary md:bg-bgcolor dark:md:bg-slate-800 h-[100vh]">
    <div class="flex space-x-0 justify-center">
        <section class="w-full flex md:w-1/2 h-[100vh] justify-center items-center">
            <div class="h-fit justify-center">
                <h1 class="md:hidden text-secondary text-center font-bold text-5xl md:text-4xl mt-12 mb-10 font-montserrat">
                    #8 Dimensi Kepemimpinan
                </h1>
                <h1 class="max-md:hidden text-primary font-montserrat text-center font-bold text-6xl md:text-4xl mb-10">
                    Masuk
                </h1>
                <form method="POST" action="{{ route('login') }}" class="max-w-lg mx-auto">
                    @csrf
                    <label for="email" id="">
                        <input id="email" type="email" name="email" placeholder="Masukkan Email" class="mb-4 md:mb-10 rounded-md md:rounded-md border-black border ring-black mx-auto px-3 py-2 w-3/4 max-md:h-10 md:w-full block text-xs md:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer max-md:placeholder:text-xs max-md:placeholder:text-slate-400 focus:placeholder:text-transparent" value="{{ old('email') }}" required
                        />
                    </label>
                    <label for="password" id="">
                        <input id="password" type="password" name="password" placeholder="Masukkan Password" class="mb-4 md:mb-10 rounded-md md:rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-3/4 md:w-full max-md:h-10 block text-xs md:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 peer max-md:placeholder:text-xs max-md:placeholder:text-slate-400 focus:placeholder:text-transparent" required
                        />
                    </label>
                    @error('email')
                    <h1 class="text-red-600 max-md:text-center mt-2 md:-mt-10 mb-2 md:mb-4">Email atau Password salah</h1>
                    @enderror
                    <a href="{{ route('password.request') }}" class="text-bgcolor text-sm md:text-base dark:md:text-slate-300 md:text-black w-max block mx-auto underline font-montserrat hover:text-blue-400 dark:hover:text-blue-400">
                        Lupa Kata Sandi?
                    </a> 
                    <br>
                    <div class="flex space-x-8 md:space-x-20 justify-center">
                        <button type="submit" class="w-24 md:w-32 border-solid rounded-2xl md:rounded-lg border-2 bg-transparent md:bg-transparent border-bgcolor md:border-primary">
                            <h1 class="text-bgcolor md:text-primary text-md md:text-base text-center font-montserrat font-semibold italic my-2 md:m-1">Masuk</h1>
                        </button>
                        <a href="{{ route('tfregister.create') }}" class="w-24 md:w-32 border-solid rounded-2xl md:rounded-lg border-2 md:bg-primary">
                            <h1 class="text-bgcolor md:text-bgcolor text-md md:text-base text-center font-montserrat font-semibold italic my-2 md:m-1">Daftar</h1>
                        </a>
                    </div>
                </form>
                <h1 class="md:hidden mt-8 font-montserrat justify-center align-middle text-center text-bgcolor italic font-light text-md mb-56">
                    PT. TRANCEFORMASI INDONESIA - 2023
                </h1>
            </div>
        </section>
        <section class="hidden md:flex w-1/2 justify-center items-center bg-primary h-[100vh]">
            <div class="">
                <img src="{{ asset('/dist/title.png') }}" alt="title" class="hidden md:block mx-auto" width="75%">
                <h1 class="font-montserrat justify-center align-middle text-center text-bgcolor italic mt-12 mb-4 text-4xl">
                    SELF ASSESMENT
                </h1>
                <img src="{{ asset('/dist/member-of.png') }}" alt="Tranceformasi Indonesia" class="mx-auto" width="32%">
                <!-- <h1 class="font-montserrat justify-center align-middle text-center text-bgcolor italic mt-12 font-light text-xs">
                    PT. TRANCEFORMASI INDONESIA - 2023
                </h1> -->
            </div>
        </section>
    </div>
    <input type="checkbox" name="" id="toggle" class="peer hidden"/>
    <label for="toggle" class="max-md:hidden items-center justify-center fixed h-14 w-14 bg-primary dark:border-black border-2 rounded-full z-10 bottom-4 right-4 p-4 transition ease-in-out hover:-translate-y-1  cursor-pointer">
        <span>
            <img src="{{ asset('/dist/moon.png') }}" alt="">
        </span>
    </label>
        <!-- <span class="block w-5 h-5 border-t-2 border-l-2 rotate-45 mt-2"></span> -->
    </input>
    @include('templates.partials.script')
</body>
</html>