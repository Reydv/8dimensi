@extends('templates.default')

@section('content')

<div class="mt-24 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 dark:border-bgcolor rounded-[15px] lg:rounded-[50px] bg-white dark:bg-slate-700 ">
    <h1 class="my-4 md:my-10 text-2xl md:text-4xl text-black dark:text-bgcolor font-bold md:font-black text-center">PERSON ANALYSIS RESPONSE</h1>
</div>
<div class="mt-8 lg:mt-12 mb-8 lg:mb-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 dark:border-bgcolor rounded-[15px] lg:rounded-[50px] bg-white dark:bg-slate-700">
    <h1 class="mt-16 text-center font-bold text-2xl text-black dark:text-bgcolor">Terimakasih Atas Jawaban Anda</h1>
    <h1 class="ml-12 mr-12 mb-16 text-lg mt-4 text-center text-black dark:text-bgcolor">Untuk melihat hasil silahkan unduh hasil di halaman dashboard. Jika tidak muncul, harap hubungi admin untuk penyelesaian</h1>
</div>
<a href="{{ route('user.dashboard') }}" class="block mx-auto w-fit h-fit text-center text-lg text-black dark:text-bgcolor font-light italic py-2 px-5 border-2 border-slate-300 dark:border-bgcolor rounded-full bg-white dark:bg-slate-700 transition hover:bg-primary hover:border-transparent hover:text-white ease-in-out">
    Kembali ke Dashboard
</a>

@endsection