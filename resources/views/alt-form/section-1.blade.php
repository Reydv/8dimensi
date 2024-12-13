  @extends('templates.default')

  @section('content')
  <div class="mt-16 md:mt-24 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-[#FFFFFF] dark:bg-slate-700 dark:border-transparent">
      <h1 class="my-2 md:my-10 text-2xl md:text-4xl font-bold md:font-black text-center text-black dark:text-bgcolor">PERSON ANALYSIS RESPONSE</h1>
  </div>
  <div class="mt-4 md:mt-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-[#FFFFFF] dark:bg-slate-700 dark:border-transparent">
      <h1 class="mt-4 md:mt-8 text-center text-black dark:text-bgcolor font-bold text-2xl">INSTRUKSI PENGERJAAN</h1>

      @foreach(config('form-rules.rules-section1') as $index => $rules)
      <h1 class="ml-4 mr-4 md:ml-12 md:mr-12 mt-2 text-sm md:text-md text-black dark:text-bgcolor">{!! $index . ". ". $rules !!}</h4>
      @endforeach

      <div class="mt-0 mb-4 md:mb-8"></div>
  </div>
  @if($contoh == true)
        <div class="mt-4 md:mt-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-white dark:bg-slate-700 dark:border-transparent">
          <div class="flex">
              <h1 class="ml-8 md:ml-12 lg:ml-20 mt-12 text-2xl dark:text-bgcolor">P</h1>
              <div class="flex mt-10 mx-auto w-60 h-12 text-sm md:text-lg text-black dark:text-bgcolor justify-center items-center rounded-full border-2 border-slate-500 dark:border-white">
                  Contoh Pengerjaan
              </div>
              <h1 class="mr-8 md:mr-12 lg:mr-20 mt-12 text-2xl dark:text-bgcolor">T</h1>
          </div>
          <ul>
                <li class="flex h-auto">
                    <label class="mt-8 ml-4 md:ml-8 lg:ml-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 dark:border-white"></label>
                    <div class="flex mt-8 text-center mx-auto h-auto w-[60%] justify-center items-center border-2 border-slate-500 dark:border-white rounded-full">
                    <h1 class="mx-1 text-xs md:text-base dark:text-bgcolor">Berkaki dua</h1>
                    </div>
                    <label class="mt-8 mr-4 md:mr-8 lg:mr-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 dark:border-white"></label>
                </li>
                <li class="flex h-auto">
                    <label class="mt-8 ml-4 md:ml-8 lg:ml-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 bg-green-500 border-transparent dark:border-white"></label>
                    <div class="flex mt-8 text-center mx-auto h-auto w-[60%] justify-center items-center border-2 border-slate-500 dark:border-white rounded-full">
                    <h1 class="mx-1 text-xs md:text-base dark:text-bgcolor">Manusia</h1>
                    </div>
                    <label class="mt-8 mr-4 md:mr-8 lg:mr-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 dark:border-white"></label>
                </li>
                <li class="flex h-auto">
                    <label class="mt-8 ml-4 md:ml-8 lg:ml-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 dark:border-white"></label>
                    <div class="flex mt-8 text-center mx-auto h-auto w-[60%] justify-center items-center border-2 border-slate-500 dark:border-white rounded-full">
                    <h1 class="mx-1 text-xs md:text-base dark:text-bgcolor">Penguin</h1>
                    </div>
                    <label class="mt-8 mr-4 md:mr-8 lg:mr-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 bg-green-500 border-transparent dark:border-white"></label>
                </li>
                <li class="flex h-auto">
                    <label class="mt-8 ml-4 md:ml-8 lg:ml-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 dark:border-white"></label>
                    <div class="flex mt-8 text-center mx-auto h-auto w-[60%] justify-center items-center border-2 border-slate-500 dark:border-white rounded-full">
                    <h1 class="mx-1 text-xs md:text-base dark:text-bgcolor">Mamalia</h1>
                    </div>
                    <label class="mt-8 mr-4 md:mr-8 lg:mr-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 dark:border-white"></label>
                </li>
          </ul>
          <div class="mt-0 mb-12"></div>
      </div>
    @endif
  <!-- {{-- action="{{ route('user.form.update', ['jawaban' => $jawaban->id, 'destination' => $nextDestination]) }}" --}} -->
  <form id="form" method="POST" action="{{ route('user.form.update', ['jawaban' => $jawaban->id, 'destination' => $nextDestination]) }}">
      @method('PATCH')
      @csrf
      @foreach( $questions as $index => $quest)
      <div class="mt-4 md:mt-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[30px] lg:rounded-[50px] bg-white dark:bg-slate-700 dark:border-transparent">
          <div class="flex">
              <h1 class="ml-8 md:ml-12 lg:ml-20 mt-12 text-2xl dark:text-bgcolor">P</h1>
              <div class="flex mt-10 mx-auto w-20 h-12 text-sm md:text-lg text-black dark:text-bgcolor justify-center items-center rounded-full border-2 border-slate-500 dark:border-white">
                  {{ $index }}
              </div>
              <h1 class="mr-8 md:mr-12 lg:mr-20 mt-12 text-2xl dark:text-bgcolor">T</h1>
          </div>
          <ul>
              @for ($i = 1; $i <= 4; $i++) <li class="flex h-auto">
                  <input type="checkbox" id="{{ $index . '-1-' . $i }}" class="hidden peer/{{ $index . '-1-' . $i }} single-checkbox{{ $index }}1 check{{ $index . $i }}" name="checkbox[p][{{ $index }}]" value="{{ $quest['value-p'][($i - 1)] }}" {{ (isset($answers['p'][$index]) && $answers['p'][$index] == $quest['value-p'][$i - 1] || (isset(old('checkbox')['p'][$index]) ? old('checkbox')['p'][$index] : '') == $quest['value-p'][$i - 1]) ? 'checked' : ''}} />
                  <label for="{{ $index . '-1-' . $i }}" id="{{ $index . '-1-' . $i . 'l' }}" class="mt-8 ml-4 md:ml-8 lg:ml-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 transition-colors duration-200 ease-in-out peer-checked/{{ ($index) . '-1-' . $i }}:bg-green-500 peer-checked/{{ ($index) . '-1-' . $i }}:border-transparent dark:peer-checked/{{ ($index) . '-1-' . $i }}:border-white"></label>
                  <div class="flex mt-8 text-center mx-auto h-auto w-[60%] justify-center items-center border-2 border-slate-500 dark:border-white rounded-full">
                      <h1 class="mx-1 text-xs md:text-base dark:text-bgcolor">{{ $quest['question'][($i - 1)] }}</h1>
                  </div>
                  
                  <input type="checkbox" id="{{ $index . '-2-' . $i }}" class="hidden peer/{{ $index . '-2-' . $i }} single-checkbox{{ $index }}2 check{{ $index . $i }}" name="checkbox[t][{{ $index }}]" value="{{ $quest['value-t'][($i - 1)] }}" {{ (isset($answers['t'][$index]) && $answers['t'][$index] == $quest['value-t'][$i - 1] || (isset(old('checkbox')['t'][$index]) ? old('checkbox')['t'][$index] : '') == $quest['value-t'][$i - 1]) ? 'checked' : ''}} />
                  <label for="{{ $index . '-2-' . $i }}" id="{{ $index . '-2-' . $i . 'r' }}" class="mt-8 mr-4 md:mr-8 lg:mr-[4rem] select-none cursor-pointer rounded-full border-2 border-slate-500 dark:border-white h-10 w-10 transition-colors duration-200 ease-in-out peer-checked/{{ ($index) . '-2-' . $i }}:bg-green-500 peer-checked/{{ ($index) . '-2-' . $i }}:border-transparent dark:peer-checked/{{ ($index) . '-2-' . $i }}:border-white"></label>
                  </li>
              @endfor
          </ul>
          <div class="mt-0 mb-12"></div>
      </div>
      @endforeach

      {{-- kalau error --}}
      <div>
          @foreach(['checkbox', 'checkbox.p', 'checkbox.t', 'range'] as $field)
          @error($field)
          <h1 class="text-red-600 text-center mt-12">Anda harus menjawab semua soal yang diberikan</h1>
          @break
          @enderror
          @endforeach
      </div>

      <div class="flex mx-auto w-fit space-x-8 md:space-x-16">
          @if($previousDestination == 'go-dashboard')
          <a href="{{ route('user.dashboard') }}" class="flex mt-8 w-40 h-12 text-base md:text-xl justify-center items-center border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">          
                  Kembali
          </a>
          @else
          <button onclick="toPrevious()" class="mt-8 w-40 h-12 text-base md:text-xl border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">
              Kembali
          </button>
          @endif

          {{-- @if($nextDestination == 'section-wait')
            <div class="flex mt-8 w-40 h-12 text-base md:text-xl justify-center items-center border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">
                <a href="{{ route('user.form.show', ['jawaban' => $jawaban, 'destination' => $nextDestination]) }}" >
                    Selanjutnya
                </a>
            </div>
          @else --}}
          <button onclick="toNext()" class="mt-8 w-40 h-12 text-base md:text-xl border-2 rounded-full bg-white dark:bg-slate-700 border-slate-500 text-black dark:text-bgcolor text-center">
              Selanjutnya
          </button>
          {{-- @endif --}}
      </div>

  </form>

  @include('templates.partials.script-form')
  @endsection