<!-- navBar -->

<header class="w-full grid grid-cols-4 md:grid-cols-3 bg-primary mb-10 drop-shadow-2xl absolute top-0 left-0 right-0">
    <h1 class="my-4 mx-auto text-secondary font-bold max-md:hidden">Tranceformasi</h1>
    <h1 class="w-full md:w-auto mx-auto my-4 text-bgcolor text-center col-span-3 md:col-span-1">Delapan Dimensi Kepemimpinan</h1>
    <img src="{{ asset('/dist/profile.png') }}" alt="" class="w-8 h-8 ml-12 md:ml-72 md:mx-auto my-auto cursor-pointer" onclick="onoverlay()">
</header>

<!-- overlay -->

<div id="overlay" class="bg-black top-0 left-0 w-full h-full opacity-30 z-20"></div>
<div id="overlay1" class="bg-white dark:bg-slate-800 dark:text-slate-300 top-0 right-0 w-full lg:w-3/12 h-3/12 lg:h-full z-30">
    <div class="w-full lg:w-3/12 flex bg-primary drop-shadow-2xl items-center fixed top-0 right-0">
        <img src="{{ asset('/dist/profile.png') }}" alt="" class="w-8 h-8 ml-8 my-auto cursor-pointer" onclick="offoverlay()">
        <h1 class="ml-4 pl-4 text-white my-4 border-l-2">{{ explode(" ", $user->name)[0] }}</h1>
    </div>
    <div class="block">
        <a href="/public/home">
            <input type="submit" class="hidden"/>  
            <button class="mt-[3.3rem] py-4 flex mx-auto w-full text-lg border-b-2 border-slate-500">
                <div class="w-auto mx-auto flex">
                    <img src="{{ asset('/dist/dashboardbook.png') }}" alt="" class="h-8 w-auto">
                    <h1 class="w-auto ml-5 text-slate-800 dark:text-slate-300">Dashboard</h1>
                </div>
            </button>
        </a>
        <form method="" action="{{ route('profile.edit') }}">
            <input type="submit" class="hidden"/>
            <button class="py-4 flex mx-auto w-full text-lg border-b-2 border-slate-500">
                <div class="w-auto mx-auto flex items-center">
                    <img src="{{ asset('/dist/editprofile.png') }}" alt="" class="h-9 w-auto">
                    <h1 class="font-montserrat w-auto ml-5 text-slate-800 dark:text-slate-300">Edit Profil</h1>
                </div>
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="py-4 flex mx-auto w-full text-lg border-b-2 border-slate-500">
                <div class="w-auto mx-auto flex">
                    <img src="{{ asset('/dist/logoutlogo.png') }}" alt="" class="h-8 w-auto">
                    <h1 class="w-auto ml-5 text-red-600">Log Out</h1>
                </div>
            </button>
        </form>
        <div class="flex w-full select-none">
            <input type="checkbox" name="" id="toggle" class="peer hidden"/>
            <label for="toggle" class="py-4 flex mx-auto w-full text-lg border-b-2 border-slate-500 justify-center items-center cursor-pointer">
                <img src="{{ asset('/dist/moon-dark.png') }}" alt="" class="dark:hidden w-9 h-auto">
                <img src="{{ asset('/dist/moon.png') }}" alt="" class="hidden dark:block w-9 h-auto">
                <h1 class="dark:hidden w-auto ml-5 text-slate-800">Dark Mode</h1>
                <h1 class="hidden dark:block w-auto ml-5 dark:text-slate-300">Light Mode</h1>
            </label> 
        </div>
        @if($isAdmin)
        <form action="{{ route('admin.event.index') }}">
            <button type="submit" class="py-4 flex mx-auto w-full text-lg border-b-2 border-slate-500">
                <div class="w-auto mx-auto flex">                        
                    <img src="{{ asset('/dist/admin.png') }}" alt="" class="w-9 h-auto">
                    <h1 class="w-auto ml-5 text-slate-800 dark:text-slate-300">Admin Dashboard</h1>
                </div>
            </button>
        </form>
        @endif
    </div>
</div>
