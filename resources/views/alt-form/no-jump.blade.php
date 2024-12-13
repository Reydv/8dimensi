@extends('templates.default')

@section('content')
<h1 class="mt-24 text-8xl md:text-[11rem] w-fit mx-auto mb-28">👁👄👁</h1>

<a href="{{ route('user.form.show', ['jawaban' => $jawaban, 'destination' => 'section-1-1']) }}" class="flex w-fit h-16 border-2 border-slate-300 rounded-full mx-auto mb-20">
    <h1 class="text-center text-xl ml-4 mr-3 pt-3 italic px-16">.....</h1>
</a>
@endsection