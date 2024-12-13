 @extends('templates.default')

@section('content')

<!-- Main Hero -->

<div class="mt-20 mx-auto w-[90%] ring-2 ring-white dark:ring-0 h-fit rounded-[50px] lg:rounded-[50px] lg:rounded-tr-[250px] bg-primary lg:bg-[#FFEEFE] lg:dark:bg-slate-700 lg:flex">
    <div class="lg:w-1/2 h-max lg:bg-primary rounded-xl lg:rounded-tl-[50px] lg:rounded-bl-[50px]">
        <h1 class="font-bold text-center lg:text-left text-secondary lg:ml-12 pt-8 text-3xl md:text-4xl mx-4">DELAPAN DIMENSI <br> KEPEMIMPINAN</h1>
        <h1 class="mx-4 lg:mx-12 text-center lg:text-left text-sm mt-4 text-bgcolor">
            Dalam asessment ini, Anda akan mengeksplorasi tiga area utama, yaitu :
        </h1>
        <h1 class="mx-4 lg:mx-12 text-sm mt-4 text-bgcolor">
            1. Dimensi kepemimpinan dominan<br>
            2. Pendorong psikologis, motivasi, dan "titik buta" khas gaya kepemimpinan <br>
            3. Apa yang paling penting dalam pengembangan kepemimpinan Anda saat ini dan yang akan datang
        </h1>
        <h1 class="mx-4 text-xl lg:text-2xl text-center mt-8 text-bgcolor">Mulai ekplorasi, klik tombol dibawah ini</h1>
        <div class="mt-4 pb-8" id="mulai">
            <a href="#mulai" class="block w-fit mx-auto">            
                <img src="dist/ArrowDown1.png" alt="" width="75" height="75" class="mx-auto">
            </a>
        </div>
    </div>
    <div class="max-lg:hidden lg:w-1/2 h-full">
        <img src="dist/body1image.png" alt="" width="500" height="500" class="mx-auto">
    </div>
</div>

<!-- Start Hero -->

<div class="mt-8 lg:mt-8 w-[90%] border-2 border-transparent h-fit bg-primary rounded-[50px] lg:rounded-[50px] mx-auto">
    <h1 class="text-xl lg:text-4xl text-center lg:text-left font-semibold mx-4 lg:ml-12 mt-8 lg:mt-12 text-bgcolor">
        Luangkan waktu 15 menit saja! <br>
        Yuk langsung klik tombol mulai di bawah ini!
    </h1>
    <h1 class="text-xs lg:text-lg text-center lg:text-left mx-4 lg:ml-12 mt-2 text-bgcolor italic font-light">
        *Gunakan kode akses yang sudah anda terima dari admin
    </h1>
    <div class="group w-fit mx-auto">
        <div class="hidden md:block mx-auto w-fit h-fit">
            <img src="dist/play.png" alt="" class="w-[60px] mx-auto mt-8 lg:mt-12 transition ease-in-out delay-150 duration-300 group-hover:hidden">
            <button class="hidden transition ease-in-out delay-150 duration-300 group-hover:block mx-auto text-3xl text-center rounded-full font-bold mt-8 lg:mt-12 text-primary bg-secondary py-3 px-10" onclick="kodeAkses()">
            <span onclick="kodeAkses()">Mulai</span>
            </button>
        </div>
        <button class="md:hidden mx-auto text-3xl text-center text-montserrat rounded-full font-bold mt-8 text-primary bg-secondary py-3 px-10" onclick="kodeAkses()">
            <span>Mulai</span>
        </button>
    </div>
    <h1 id="hasil" class="text-md font-light italic text-bgcolor text-center mt-8 lg:mt-12 mb-8">
        Sudah mengerjakan? Lihat hasilnya <a href="#hasil" class="underline cursor-pointer hover:text-sky-500 max-md:text-sky-400">disini!</a>
    </h1>
</div>

<!-- Dimensi Anda Hero -->

@if(optional($jawaban)->progress == 'selesai')
    @if($jawaban->event->is_answers_hold == true)
        <div class="mt-8 lg:mt-8 w-[90%] border-2 border-transparent h-fit bg-primary rounded-[50px] text-bgcolor mx-auto">
            <h1 class="mt-8 mb-4 mx-4 text-lg md:text-2xl lg:text-2xl text-bgcolor text-center font-bold">
                TERIMA KASIH, HASIL LAPORAN ANDA SEDANG TERTAHAN
                <br>
                Tanyakan … atau WhatsApp kami <a target="_blank" href="https://wa.me/06281336336339?text=Hai%20admin%2C%20saya%20ingin%20mengonfirmasi%20mengapa%20laporan%20saya%20saat%20ini%20ditahan%20di%20website%20Delapan%20Dimensi%20Kepemimpinan.%20Apakah%20ada%20alasan%20tertentu%20atau%20prosedur%20yang%20perlu%20saya%20ketahui%20untuk%20mendapatkan%20laporan%20tersebut%3F%2C" class="max-md:text-sky-400 max-md:underline hover:text-sky-400 no-underline hover:underline">(di sini)</a>
            </h1>
            <hr class="w-3/4 mx-auto">
            <div class="w-[350px] lg:w-[450px] h-[350px] lg:h-[450px] mx-auto justify-center items-center rounded-full bg-bgcolor dark:bg-slate-800 my-4 lg:my-6">
                <img src="/dist/kosong.png" alt="" class="mx-auto py-[4.5rem] w-[200px] lg:w-[300px]">
            </div>
        </div>
    @else 
        <div class="mt-8 lg:mt-8 w-[90%] border-2 border-transparent h-fit bg-primary rounded-[50px] lg:rounded-[50px] mx-auto">
            <h1 class="text-xl lg:text-3xl text-center mx-4 mt-4 mb-2 lg:mb-4 text-bgcolor">
                Selamat! Dimensi Kepemimpinan Anda Adalah :
            </h1>
            <hr class="w-3/4 mx-auto">
            <div class="flex w-fit mx-auto mt-4 justify-center items-center">
                <h1 class="text-4xl lg:text-6xl mx-4 font-bold md:font-black text-bgcolor text-center">
                    {{ strtoupper($jawaban->dimensi_kepemimpinan) }}
                </h1>
                <img src="{{ asset('/dist/baikhati.png') }}" alt="baikhati" class="h-32 md:h-56 w-auto">
            </div>
            <h1 class="mx-4 mt-8 lg:mt-6 font-light text-xs md:text-base text-center text-bgcolor italic">
                *Untuk mengetahui detail lebih lanjut, silahkan unduh file di bawah ini
            </h1>
            <h1 class="mx-4 mt-2 lg:mt-0 lg:mb-4 font-light text-xs md:text-base text-center text-bgcolor italic">
                *Hasil tes diambil pada tanggal {{ isset($testDate)? $testDate : '[Belum Tes]' }}
            </h1>
            @error('filePdf')
                <h1 class="text-red-400 mx-4 mt-2 lg:mt-0 lg:mb-4 font-light text-xs md:text-base text-center italic">
                    {{ $message }}
                </h1>
            @enderror
            <div class="md:flex">
                <a href="{{ route('user.download.laporan', ['user' => auth()->user()->id]) }}" class="md:mr-2 mt-6 md:mt-2 mb-2 md:mb-8 w-3/4 md:w-2/12 mx-auto block border-2 rounded-full border-secondary text-center text-secondary hover:bg-secondary hover:border-transparent hover:text-primary py-3 px-2">Unduh Hasil Tes</a>
                <a href="{{ route('user.download.laporan', ['user' => auth()->user()->id, 'view' => 'view']) }}" class="md:ml-2 mt-2 mb-8 w-3/4 md:w-2/12 mx-auto block border-2 rounded-full border-secondary text-center text-secondary hover:bg-secondary hover:border-transparent hover:text-primary py-3 px-2" target="_blank">Lihat Hasil Tes</a>
            </div>
        </div>
<!-- Empty Hero -->
    @endif
@else

<div class="mt-8 lg:mt-8 w-[90%] border-2 border-transparent h-fit bg-primary rounded-[50px] text-bgcolor mx-auto">
    <h1 class="mt-8 mb-4 mx-4 text-lg md:text-2xl lg:text-2xl text-bgcolor text-center font-bold">
        WAH, TERNYATA KAMU BELUM MENGISI FORMNYA
        <br>
        Klik <span class="font-bold hover:text-sky-400 underline cursor-pointer"><a href="#mulai">DISINI</a></span> untuk segera mengisi
    </h1>
    <hr class="w-3/4 mx-auto">
    <div class="w-[350px] lg:w-[450px] h-[350px] lg:h-[450px] mx-auto justify-center items-center rounded-full bg-bgcolor dark:bg-slate-800 my-4 lg:my-6">
        <img src="{{ asset('/dist/kosong.png') }}" alt="" class="mx-auto py-[4.5rem] w-[200px] lg:w-[300px]">
    </div>
</div>

@endif

<!-- overlayKodeAkses -->

<div id="kodeAkses" class="top-1/4 left-1 md:left-1/4 w-[98vw] md:w-1/2 h-fit rounded-xl md:rounded-3xl bg-white dark:bg-slate-800 dark:border-2 dark:border-white z-30 flex">
    <div class="w-full flex bg-primary mb-5 drop-shadow-2xl z-40 top-0 rounded-t-xl md:rounded-t-3xl items-center">
        <h1 class="py-3 pl-5 text-secondary text-xl">Delapan Dimensi Kepemimpinan</h1>
    </div>
    <h1 class="text-black dark:text-bgcolor text-2xl ml-12 mb-3 z-40 font-black">Masukkan Kode Akses</h1>
    <form action="{{ route('user.form.store') }}" method="POST">
        @csrf
        <label for="">
            <input name="kode-akses" type="text" placeholder="Masukan Kode Akses (6 Huruf/Angka)" class="mb-2 pl-2 rounded-sm border-2 border-slate-400 ring-slate-400 ml-12 w-3/4 text-black focus:placeholder:text-transparent" onkeyup="
            var start = this.selectionStart;
            var end = this.selectionEnd;
            this.value = this.value.toUpperCase();
            this.setSelectionRange(start, end);" pattern=".{6,6}" maxlength="6" required>
        </label>
        <h1 class="ml-12 italic text-slate-500 dark:text-bgcolor text-sm mb-6">*Hubungi admin jika terdapat masalah dengan kode akses <a target="_blank" href="https://wa.me/06281336336339?text=Hai%20admin%2C%20saya%20ingin%20menanyakan%20apakah%20ada%20kode%20akses%20yang%20diperlukan%20untuk%20mengikuti%20tes%20Delapan%20Dimensi%20Kepemimpinan%3F.%20Jika%20ada%2C%20mungkin%20Anda%20bisa%20memberikan%20saya%20informasi%20lebih%20lanjut%20atau%20panduan%20tentang%20cara%20mendapatkannya%3F" class="max-md:text-sky-400 max-md:underline hover:text-sky-400 no-underline hover:underline">(disini)</a></h1>
        @error('kode-akses')
            <h6 class="mb-4 text-red-600 ml-12 text-xs italic">{{ $message }}</h1>
        @enderror
        <button class="flex w-fit h-8 border-2 border-slate-300 rounded-full mx-auto mb-8 items-center justify-center">
            <h1 class="dark:text-bgcolor text-center text-md ml-4 mr-3 italic">Lanjutkan</h1>
            <img src="{{ asset('/dist/lanjutkan.png') }}" alt="" class="dark:hidden mr-2 h-5 w-5">
            <img src="{{ asset('/dist/ArrowDown1.png') }}" alt="" class="hidden dark:block -rotate-90 mr-2 h-5 w-5">
        </button> 
    </form>
</div>

@error('kode-akses')
    <script>
        document.getElementById("overlay").style.display = "block";
        document.getElementById("kodeAkses").style.display = "block";
        window.location = '#mulai';
    </script>
@enderror

@error('filePdf')
    <script>
        window.location = '#hasil';
    </script>
@enderror

@endsection
