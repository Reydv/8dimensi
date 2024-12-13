@extends('templates.default')

@section('content')
<div class="mt-16 md:mt-24 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-[#FFFFFF] dark:bg-slate-700 dark:border-transparent">
    <h1 class="my-2 md:my-10 text-2xl md:text-4xl font-bold md:font-black text-center text-black dark:text-bgcolor">PERSON ANALYSIS RESPONSE</h1>
</div>
<div class="mt-4 md:mt-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-[#FFFFFF] dark:bg-slate-700 dark:border-transparent">
    <h1 class="mt-4 md:mt-8 text-center text-black dark:text-bgcolor font-bold text-2xl">INSTRUKSI PENGERJAAN</h1>

    @foreach(config('form-rules.rules-section2') as $index => $rules)
    <h4 class="ml-4 mr-4 md:ml-12 md:mr-12 mt-2 text-sm md:text-md text-black dark:text-bgcolor">{!! $index . ". ". $rules !!}</h4>
    @endforeach

    <div class="mt-0 mb-8"></div>
</div>
<form id="form" method="POST" action="{{ route('user.form.update.submit', ['jawaban' => $jawaban->id]) }}">
    @method('PATCH')
    @csrf
    @foreach($questions as $index => $quest)
    <div class="mt-4 md:mt-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-white dark:bg-slate-700 dark:border-transparent">        
        <div class="flex mt-10 mb-4 mx-auto w-12 h-12 text-sm md:text-lg text-black dark:text-bgcolor justify-center items-center rounded-full border-2 border-slate-500 dark:border-white">
            {{ $index }}
        </div>
        <div class="ml-3 mr-3">
            <h1 class="w-11/12 md:w-10/12 mx-auto block text-black dark:text-bgcolor text-center text-base md:text-lg mb-2 md:mb-4">
                {{ $quest['question'] }}
            </h1>
        </div>
        <div class="flex h-fit w-fit mx-auto">
            <div class="w-8 mt-10 max-md:hidden">
                <img src="{{ asset('/dist/thumbup.png') }}" alt="a">
            </div>
            <input type="checkbox" id="{{ $index }}-1" class="hidden peer/{{ $index }}-1 single-checkbox-section2-{{ $index }}" name="range[{{ $index }}]" value="1" {{ (isset($answers[$index]) && $answers[$index] == "1") ? 'checked' : '' }} />
            <label for="{{ $index }}-1" class="mt-8 md:ml-12 sm:ml-6 select-none cursor-pointer rounded-full border-2 border-green-800 dark:border-green-800 text-black dark:text-bgcolor h-10 w-10 sm:h-12 sm:w-12 transition-colors duration-200 ease-in-out peer-checked/{{ $index }}-1:bg-green-800 peer-checked/{{ $index }}-1:border-transparent mr-1 text-center text-xs sm:text-base pt-[10px] peer-checked/{{ $index }}-1:text-white">
                1
            </label>
            <input type="checkbox" id="{{ $index }}-2" class="hidden peer/{{ $index }}-2 single-checkbox-section2-{{ $index }}" name="range[{{ $index }}]" value="2" {{ (isset($answers[$index]) && $answers[$index] == "2") ? 'checked' : '' }} />
            <label for="{{ $index }}-2" class="mt-8 ml-2 sm:ml-12 select-none cursor-pointer rounded-full border-2 border-green-700 dark:border-green-700 text-black dark:text-bgcolor h-10 w-10 sm:h-12 sm:w-12 transition-colors duration-200 ease-in-out peer-checked/{{ $index }}-1:bg-green-700 peer-checked/{{ $index }}-1:border-transparent peer-checked/{{ $index }}-2:bg-green-700 peer-checked/{{ $index }}-2:border-transparent mr-1 text-center text-xs sm:text-base pt-[10px] peer-checked/{{ $index }}-1:text-white peer-checked/{{ $index }}-2:text-white">
                2
            </label>
            <input type="checkbox" id="{{ $index }}-3" class="hidden peer/{{ $index }}-3 single-checkbox-section2-{{ $index }}" name="range[{{ $index }}]" value="3" {{ (isset($answers[$index]) && $answers[$index] == "3") ? 'checked' : '' }} />
            <label for="{{ $index }}-3" class="mt-8 ml-2 sm:ml-12 select-none cursor-pointer rounded-full border-2 border-green-500 dark:border-green-500 text-black dark:text-bgcolor h-10 w-10 sm:h-12 sm:w-12 transition-colors duration-200 ease-in-out peer-checked/{{ $index }}-1:bg-green-500 peer-checked/{{ $index }}-1:border-transparent peer-checked/{{ $index }}-2:bg-green-500 peer-checked/{{ $index }}-2:border-transparent peer-checked/{{ $index }}-3:bg-green-500 peer-checked/{{ $index }}-3:border-transparent mr-1 text-center text-xs sm:text-base pt-[10px] peer-checked/{{ $index }}-1:text-white peer-checked/{{ $index }}-2:text-white peer-checked/{{ $index }}-3:text-white">
                3
            </label>

            <input type="checkbox" id="{{ $index }}-4" class="hidden peer/{{ $index }}-4 single-checkbox-section2-{{ $index }}" name="range[{{ $index }}]" value="4" {{ (isset($answers[$index]) && $answers[$index] == "3") ? 'checked' : '' }} />
            <input type="checkbox" id="{{ $index }}-5" class="hidden peer/{{ $index }}-5 single-checkbox-section2-{{ $index }}" name="range[{{ $index }}]" value="5" {{ (isset($answers[$index]) && $answers[$index] == "4") ? 'checked' : '' }} />
            <input type="checkbox" id="{{ $index }}-6" class="hidden peer/{{ $index }}-6 single-checkbox-section2-{{ $index }}" name="range[{{ $index }}]" value="6" {{ (isset($answers[$index]) && $answers[$index] == "4") ? 'checked' : '' }} />
            <label for="{{ $index }}-4" class="mt-8 ml-2 sm:ml-12 select-none cursor-pointer rounded-full border-2 border-red-500 dark:border-red-500 text-black dark:text-bgcolor h-10 w-10 sm:h-12 sm:w-12 transition-colors duration-200 ease-in-out peer-checked/{{ $index }}-4:bg-red-500 peer-checked/{{ $index }}-4:border-transparent peer-checked/{{ $index }}-5:bg-red-500 peer-checked/{{ $index }}-5:border-transparent peer-checked/{{ $index }}-6:bg-red-500 peer-checked/{{ $index }}-6:border-transparent mr-1 text-center text-xs sm:text-base pt-[10px] peer-checked/{{ $index }}-6:text-white peer-checked/{{ $index }}-4:text-white peer-checked/{{ $index }}-5:text-white peer-checked/{{ $index }}-5:text-white">
                4
            </label>
            <label for="{{ $index }}-5" class="mt-8 ml-2 sm:ml-12 select-none cursor-pointer rounded-full border-2 border-red-700 dark:border-red-700 text-black dark:text-bgcolor h-10 w-10 sm:h-12 sm:w-12 transition-colors duration-200 ease-in-out peer-checked/{{ $index }}-5:bg-red-700 peer-checked/{{ $index }}-5:border-transparent peer-checked/{{ $index }}-6:bg-red-700 peer-checked/{{ $index }}-6:border-transparent mr-1 text-center text-xs sm:text-base pt-[10px] peer-checked/{{ $index }}-5:text-white peer-checked/{{ $index }}-6:text-white">
                5
            </label>
            <label for="{{ $index }}-6" class="mt-8 ml-2 sm:ml-12 select-none cursor-pointer rounded-full border-2 border-red-800 dark:border-red-800 text-black dark:text-bgcolor h-10 w-10 sm:h-12 sm:w-12 transition-colors duration-200 ease-in-out peer-checked/{{ $index }}-6:bg-red-800 peer-checked/{{ $index }}-6:border-transparent mr-1 text-center text-xs sm:text-base pt-[10px] peer-checked/{{ $index }}-6:text-white">
                6
            </label>
            <div class="w-8 mt-10 ml-12 max-md:hidden">
                <img src="{{ asset('/dist/thumbdown.png') }}" alt="Setuju">
            </div>
        </div>
        <div class="mb-12">

        </div>

    </div>
    @endforeach

    
    <!-- {{-- kalau error --}} -->
    <div>
        @foreach(['checkbox', 'checkbox.p', 'checkbox.t', 'range'] as $field)
        @error($field)
        <h1 class="text-red-600">{{ $message }}</h1>
        @enderror
        @endforeach
    </div>

    <!-- {{-- previous or next button --}} -->
    <div class="flex w-fit space-x-8 md:space-x-12 mx-auto">
        <button onclick="toPrevious()" class="mt-8 w-40 h-12 text-base md:text-xl border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">
            Kembali
        </button>
        
        @if($nextDestination == 'submit')
        <div id="submit-button" class="flex mt-8 w-40 h-12 text-base md:text-xl justify-center items-center border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">
            <a>
                Submit
            </a>
        </div>
        @else
        <button onclick="toNext()" class="mt-8 w-40 h-12 text-base md:text-xl border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">
            Selanjutnya
        </button>
        @endif
    </div>
    
    <!-- overlaySubmit -->
    
    <div id="confirm-element" class="top-1/4 left-3 md:left-1/4 w-[95vw] md:w-1/2 h-fit rounded-md md:rounded-3xl bg-white dark:bg-slate-800 z-30 flex">
        <div class="w-full flex bg-primary mb-5 z-40 top-0 rounded-t-md md:rounded-t-3xl items-center">
            <h1 class="py-3 text-secondary text-xl mx-auto">Delapan Dimensi Kepemimpinan</h1>
        </div>
        <h1 class="text-2xl text-black dark:text-bgcolor font-bold text-center mb-5">Apakah Anda yakin dengan jawaban anda?</h1>
        <h1 class="text-lg text-black dark:text-bgcolor text-center mb-4">Klik "Lanjutkan" untuk menyelesaikan sesi ini</h1>
        <ul class="inline-flex w-full justify-center mx-auto">
                <li>
                    <h1 id="offSubmitOverlay" class="flex w-[150px] md:w-[200px] h-8 border-2 border-slate-300 dark:border-bgcolor text-black dark:text-bgcolor rounded-full mx-auto mb-8 items-center justify-center italic mr-4 cursor-pointer">
                        Kembali
                    </h1>
                </li>
                <li>
                    <button onclick="submit()" class="flex w-[150px] md:w-[200px] h-8 border-2 border-slate-300 dark:border-bgcolor rounded-full mx-auto mb-8 items-center justify-center">
                        <h1 class="text-center text-md ml-4 mr-3 italic text-black dark:text-bgcolor">Lanjutkan</h1>
                    </button> 
                </li>
            </ul>
    </div>
    
    <!-- End overlaySubmit -->

</form>

@include('templates.partials.script-form')
@endsection