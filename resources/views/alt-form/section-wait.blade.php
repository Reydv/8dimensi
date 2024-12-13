@extends('templates.default')

@section('content')

<div class="mt-28"></div>
<div class="md:flex w-fit mx-auto mb-4 md:mb-12">
    <img src="/dist/check.png" alt="" class="md:mr-8 mt-5 max-md:mx-auto">
    <h1 class="mt-4 md:mt-12 dark:text-bgcolor text-center font-black text-4xl md:text-6xl">FORM 1 SELESAI</h1>
</div>
<h1 class="dark:text-bgcolor text-center font-medium text-lg md:text-2xl mb-24 md:mb-12">
    Jawaban anda sudah tersimpan <br> Klik “Lanjutkan” untuk mengisi form berikutnya
</h1>
<a href="{{ route('user.form.show', ['jawaban' => $jawaban, 'destination' => $nextDestination]) }}" class="flex items-center w-fit h-16 border-2 border-slate-300 rounded-full mx-auto mb-32">
    <h1 class="dark:text-bgcolor text-center text-xl ml-4 mr-3 italic">Lanjutkan</h1>
    <img src="{{ asset('/dist/lanjutkan.png') }}" alt="" class="dark:hidden w-12 h-12 mr-2">
    <img src="{{ asset('/dist/ArrowDown1.png') }}" alt="" class="hidden dark:block w-12 h-12 mr-2 -rotate-90">
</a>


@endsection