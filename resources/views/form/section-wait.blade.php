@extends('templates.default')

@section('content')

<div class="mt-24"></div>
<div class="flex w-fit mx-auto mb-12`">
    <img src="{{ asset('/dist/check.png') }}" alt="" class="mr-8 mt-5">
    <h1 class="mt-12 text-center font-black text-4xl md:text-6xl">FORM 1 SELESAI</h1>
</div>
<h1 class="text-center font-medium text-2xl mb-12">
    Jawaban anda sudah tersimpan <br> Klik “Lanjutkan” untuk mengisi form berikutnya
</h1>
<button class="flex w-fit h-16 border-2 border-slate-300 rounded-full mx-auto mb-32">
    <h1 class="text-center text-xl ml-4 mr-3 pt-3 italic">Lanjutkan</h1>
    <img src="{{ asset('/dist/lanjutkan.png') }}" alt="" class="mr-2">
</button>

@endsection