@extends('templates.default')

@section('content')

<div class="mt-20"></div>

<div class="flex relative items-center w-full mb-12">
    <h1 class="ml-12 text-2xl dark:text-bgcolor font-montserrat">Selamat datang, Admin {{ $nickname }} <br><span class="text-base font-light">Berikut rekaman event yang sedang berlangsung</span></h1>
    <div class="absolute right-0 flex mr-12">
        <button id="buatEventbtn" class="bg-primary rounded-3xl w-40 h-24 mr-12">
            <h1 class="text-secondary font-bold font-montserrat">Buat Event</h1>
            <img src="{{ asset('/dist/pluswborder.png') }}" alt="" class="w-8 mx-auto">
        </button>
        <div class="bg-primary rounded-3xl w-40 h-fit mr-12">
            <div class="my-5">
                <h1 class="text-secondary font-bold text-center font-montserrat">Total Event</h1>
                <h1 class="text-white text-2xl font-bold font-montserrat text-center">{{ $latestEvents->count() + $expiredEvents->count() }}</h1>
            </div>
        </div>
        <div class="bg-primary rounded-3xl w-40 h-fit">
            <div class="my-5">
                <h1 class="text-secondary font-bold text-center font-montserrat">Total Percobaan</h1>
                <h1 class="text-white text-2xl font-bold font-montserrat text-center">{{ $totalParticipant }}</h1>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('admin.event.index') }}">
    <input type="number" name="year" placeholder="Year" value="{{ isset($year) ? $year : date('Y') }}" class="ml-12 mb-4 rounded-md bg-bgcolor dark:bg-slate-800 text-black dark:text-bgcolor border-2 border-black dark:border-bgcolor">
</form>
<h1 class="ml-12 dark:text-bgcolor font-montserrat">Event yang sedang berlangsung</h1>
<hr class="mx-12 mb-5 border-black dark:border-bgcolor">

@foreach ($latestEvents as $e)

    <!-- Data Show -->

    <div class="bg-primary w-[93%] h-14 ml-12 mb-2 rounded-full relative flex">
        <div class="bg-secondary ml-3 w-auto h-auto my-auto rounded-full">
            <h1 class="text-primary font-bold font-montserrat text-center my-2 mx-4">{{ $loop->index + 1 }}</h1>
        </div>
        <h1 class="text-secondary font-semibold font-montserrat ml-3 mt-4">{{ $e->nama }} - {{ $e->tanggal_selesai }}</h1>
        <div class="absolute right-0 mr-4 flex">
            <a href="{{ route('admin.event.show', $e) }}">
                <button class="bg-white w-fit h-fit mt-2 mr-4 rounded-full flex">
                    <img src="{{ asset('/dist/data.png') }}" alt="" class="ml-4 mt-1">
                    <h1 class="text-black font-montserrat font-semibold mx-4 my-2">Lihat Data</h1>
                </button>
            </a>
            <button id="editEventbtn{{ $loop->iteration }}" class="bg-white w-fit h-fit mt-2 rounded-full flex">
                <img src="{{ asset('/dist/editEvent.png') }}" alt="" class="ml-4 mt-1">
                <h1 class="text-black font-montserrat font-semibold mx-4 my-2">Edit Event</h1>
            </button>
        </div>
    </div>

    <!-- Overlay Edit -->

    <div id="editEvent{{ $loop->iteration }}" class="top-0 left-1/4 w-1/2 h-[90vh] mt-12 rounded-xl bg-bgcolor dark:bg-slate-800 z-40 flex overflow-y-scroll overflow-hidden">
        <div class="w-full grid grid-cols-4 bg-primary mb-5 drop-shadow-2xl z-40 top-0 rounded-tl-xl items-center absolute">
            <h1 class="col-span-3 py-3 pl-5 text-secondary text-xl">Delapan Dimensi Kepemimpinan</h1>
            <form action="{{ route('admin.event.destroy', $e->id) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="w-fit h-fit mx-auto p-2 bg-red-500 rounded-full border-2 border-red-600 text-bgcolor">Delete Event</button>
            </form>
        </div>
    
        <h1 class="text-4xl text-black dark:text-bgcolor text-center font-bold mt-20 mb-4">Edit Event {{ $e->nama }}</h1>
        <hr class="border-black dark:border-bgcolor w-3/4 mx-auto mb-4">
    
        <form action="{{ route('admin.event.update', ['event' => $e->id, 'year' => $year]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label for="nama" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Nama</label>
            <input type="text" name="nama" id="nama" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->nama }}" placeholder="Nama Event" required maxlength="60"/>
            @error('nama')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="institusi" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Institusi</label>
            <input type="text" name="institusi" id="institusi" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->institusi }}" placeholder="Institusi/Perusahaan Peserta Event" required/>
            @error('institusi')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="tanggal_mulai" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Tanggal Dimulai Event</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" placeholder="Nama Lengkap" onfocus="this.showPicker()" class="mb-4 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black mx-auto px-3 py-2 border shadow rounder w-10/12 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('tanggal_mulai')) border-red-500 @endif" value="{{ $e->tanggal_mulai }}" oninput="removeRedBorder(this)" required/>
            @error('tanggal_mulai')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="tanggal_selesai" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Tanggal Berakhir Event</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Nama Lengkap" onfocus="this.showPicker()" class="mb-4 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black mx-auto px-3 py-2 border shadow rounder w-10/12 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('selesai')) border-red-500 @endif" value="{{ $e->tanggal_selesai }}" oninput="removeRedBorder(this)" required/>
            @error('tanggal_selesai')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="deskripsi" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Deskripsi Event</label>
            <input type="text" name="deskripsi" id="deskripsi" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->deskripsi }}" placeholder="Deskripsi Event Anda" required/>
            @error('deskripsi')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <h1 class="ml-14 text-black dark:text-bgcolor text-xl">- Tujuan Event</h1>
            <select name="tujuan_tes" id="" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('tujuan_tes') }}">
                <option value="0">-- Tujuan Diadakannya Event --</option>
                <option value="Personal Development" @if( $e->tujuan_tes =='Personal Development' ) selected @endif>Personal Development</option>
                <option value="Career Development" @if( $e->tujuan_tes =='Career Development' ) selected @endif>Career Development</option>
            </select>
            @error('tujuan_tes')
            <h1 class="text-red-600 -mt-2 ml-14">{{ $message }}</h1>
            @enderror
            <label for="collab_url" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Alamat Web Perusahaan</label>
            <input type="text" name="collab_url" id="collab_url" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->collab_url }}" placeholder="example.com" maxlength="40" />
            @error('collab_url')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <h1 class="ml-14 text-black dark:text-bgcolor text-xl">- Logo Perusahaan</h1>
            <label for="collab_logo_base64" id="LogoPerusahaan{{ $loop->iteration }}" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500">Logo Perusahaan</label>
            <input type="file" id="logoFile{{ $loop->iteration }}" name="collab_logo_base64" id="collab_logo_base64" class="absolute -mt-20 ml-[3.25rem] w-10/12 h-16 opacity-0" value="{{ old('collab_logo_base64') }}" accept="image/*" />
            @error('collab_logo_base64')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="kode_akses" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Kode Akses</label>
            <input type="text" name="kode_akses" id="kode_akses" class="mx-auto mb-12 w-10/12 rounded-md text-slate-600 bg-slate-300 border-slate-600 px-3 py-2 border shadow block text-sm placeholder:text-slate-400" value="{{ $e->kode_akses }}" placeholder="Kode Akses untuk Event Anda (Harus berupa angka atau huruf sejumlah 6)" onkeyup="
            var start = this.selectionStart;
            var end = this.selectionEnd;
            this.value = this.value.toUpperCase();
            this.setSelectionRange(start, end);" pattern=".{6,6}" maxlength="6" disabled />
            @error('kode_akses')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
    
            <button type="submit" class="block w-fit h-fit px-6 py-2 mx-auto mb-12 border-2 border-black dark:border-bgcolor rounded-full text-black dark:text-bgcolor text-lg">Submit</button>
        </form>
        
        </div>
    </div>
@endforeach

<div class="mb-10"></div>

<h1 class="ml-12 font-montserrat dark:text-bgcolor">Event yang sudah berlalu</h1>
<hr class="mx-12 mb-5 border-black dark:border-bgcolor">

@foreach ($expiredEvents as $e)
    <div class="bg-primary w-[93%] h-14 ml-12 mb-2 rounded-full relative flex">
        <div class="bg-secondary ml-3 w-auto h-auto my-auto rounded-full">
            <h1 class="text-primary font-bold font-montserrat text-center my-2 mx-4">{{ $loop->index + 1 }}</h1>
        </div>
        <h1 class="text-secondary font-semibold font-montserrat ml-3 mt-4">{{ $e->nama }} - {{ $e->tanggal_selesai }}</h1>
        <div class="absolute right-0 mr-4 flex">
            <a href="{{ route('admin.event.show', $e) }}">
                <button class="bg-white w-fit h-fit mt-2 mr-4 rounded-full flex">
                    <img src="{{ asset('/dist/data.png') }}" alt="" class="ml-4 mt-1">
                    <h1 class="text-black font-montserrat font-semibold mx-4 my-2">Lihat Data</h1>
                </button>
            </a>
            <button id="editEventDonebtn{{ $loop->iteration }}" class="bg-white w-fit h-fit mt-2 rounded-full flex">
                <img src="{{ asset('/dist/editEvent.png') }}" alt="" class="ml-4 mt-1">
                <h1 class="text-black font-montserrat font-semibold mx-4 my-2">Edit Event</h1>
            </button>
        </div>
    </div>

    <!-- Overlay Edit -->

    <div id="editEventDone{{ $loop->iteration }}" class="top-0 left-1/4 w-1/2 h-[90vh] mt-12 rounded-xl bg-bgcolor dark:bg-slate-800 z-40 flex overflow-y-scroll overflow-hidden">
        <div class="w-full grid grid-cols-4 bg-primary mb-5 drop-shadow-2xl z-40 top-0 rounded-tl-xl items-center absolute">
            <h1 class="col-span-3 py-3 pl-5 text-secondary text-xl">Delapan Dimensi Kepemimpinan</h1>
            <form action="{{ route('admin.event.destroy', $e->id) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="w-fit h-fit mx-auto p-2 bg-red-500 rounded-full border-2 border-red-600 text-bgcolor">Delete Event</button>
            </form>
        </div>
    
        <h1 class="text-4xl text-black dark:text-bgcolor text-center font-bold mt-20 mb-4">Edit Event {{ $e->nama }}</h1>
        <hr class="border-black dark:border-bgcolor w-3/4 mx-auto mb-4">
    
        <form action="{{ route('admin.event.update', $e->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label for="nama" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Nama</label>
            <input type="text" name="nama" id="nama" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->nama }}" placeholder="Nama Event" required maxlength="60"/>
            @error('nama')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="institusi" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Institusi</label>
            <input type="text" name="institusi" id="institusi" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->institusi }}" placeholder="Institusi/Perusahaan Peserta Event" required/>
            @error('institusi')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="tanggal_mulai" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Tanggal Dimulai Event</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" placeholder="Nama Lengkap" onfocus="this.showPicker()" class="mb-4 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black mx-auto px-3 py-2 border shadow rounder w-10/12 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('tanggal_mulai')) border-red-500 @endif" value="{{ $e->tanggal_mulai }}" oninput="removeRedBorder(this)" required/>
            @error('tanggal_mulai')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="tanggal_selesai" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Tanggal Berakhir Event</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Nama Lengkap" onfocus="this.showPicker()" class="mb-4 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black mx-auto px-3 py-2 border shadow rounder w-10/12 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('selesai')) border-red-500 @endif" value="{{ $e->tanggal_selesai }}" oninput="removeRedBorder(this)" required/>
            @error('tanggal_selesai')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="deskripsi" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Deskripsi Event</label>
            <input type="text" name="deskripsi" id="deskripsi" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->deskripsi }}" placeholder="Deskripsi Event Anda" required/>
            @error('deskripsi')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <h1 class="ml-14 text-black dark:text-bgcolor text-xl">- Tujuan Event</h1>
            <select name="tujuan_tes" id="" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('tujuan_tes') }}">
                <option value="0">-- Tujuan Diadakannya Event --</option>
                <option value="Personal Development" @if( $e->tujuan_tes =='Personal Development' ) selected @endif>Personal Development</option>
                <option value="Career Development" @if( $e->tujuan_tes =='Career Development' ) selected @endif>Career Development</option>
            </select>
            @error('tujuan_tes')
            <h1 class="text-red-600 -mt-2 ml-14">{{ $message }}</h1>
            @enderror
            <label for="collab_url" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Alamat Web Perusahaan</label>
            <input type="text" name="collab_url" id="collab_url" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ $e->collab_url }}" placeholder="example.com" maxlength="40"/>
            @error('collab_url')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <h1 class="ml-14 text-black dark:text-bgcolor text-xl">- Logo Perusahaan</h1>
            <label for="collab_logo_base64" id="LogoPerusahaanDone{{ $loop->iteration }}" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500">Logo Perusahaan</label>
            <input type="file" id="logoFileDone{{ $loop->iteration }}" name="collab_logo_base64" id="collab_logo_base64" class="absolute -mt-20 ml-[3.25rem] w-10/12 h-16 opacity-0" value="{{ old('collab_logo_base64') }}" accept="image/*"/>
            @error('collab_logo_base64')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
            <label for="kode_akses" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Kode Akses</label>
            <input type="text" name="kode_akses" id="kode_akses" class="mx-auto mb-12 w-10/12 rounded-md text-slate-600 bg-slate-300 border-slate-600 px-3 py-2 border shadow block text-sm placeholder:text-slate-400" value="{{ $e->kode_akses }}" placeholder="Kode Akses untuk Event Anda (Harus berupa angka atau huruf sejumlah 6)" onkeyup="
            var start = this.selectionStart;
            var end = this.selectionEnd;
            this.value = this.value.toUpperCase();
            this.setSelectionRange(start, end);" pattern=".{6,6}" maxlength="6" disabled />
            @error('kode_akses')
            <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
            @enderror
    
            <button type="submit" class="block w-fit h-fit px-6 py-2 mx-auto mb-12 border-2 border-black rounded-full text-black text-lg">Submit</button>
        </form>
        
        </div>
    </div>
@endforeach

<h1 class="ml-12 font-montserrat dark:text-bgcolor">Data Keseluruhan</h1>
<hr class="mx-12 mb-5 border-black dark:border-bgcolor">

<div class="w-fit h-fit mx-auto mb-12 drop-shadow-2xl border-4 border-primary rounded-3xl">
    <h1 class="text-2xl text-black dark:text-bgcolor font-bold text-center px-56 mt-4 mb-6">Jenis Kelamin</h1>
    <canvas id="pieChart" class="mx-auto mb-6 " style="width:100%;max-width:400px;height:100%;max-height:300px"></canvas>
</div>

<div class="w-fit mx-auto flex space-x-12">
    <div class="border-4 border-primary rounded-3xl w-[500px] p-4">
        <h1 class="text-2xl text-black dark:text-bgcolor font-bold text-center mt-4 mb-6">Rata-Rata Pendidikan</h1>
        <canvas id="PendidikanChart" class="mx-auto mb-6" style="width:100%;max-width:500px;height:100%;max-height:300px"></canvas>
    </div>
    <div class="border-4 border-primary rounded-3xl w-[500px] p-4">
        <h1 class="text-2xl text-black dark:text-bgcolor font-bold text-center mt-4 mb-6">Rentang Usia</h1>
        <canvas id="rentangUsiaChart" class="mx-auto mb-6" style="width:100%;max-width:500px;height:100%;max-height:300px"></canvas>
    </div>
</div>

<div class="flex w-fit mx-auto justify-center mb-6 mt-10">
    <div class="mr-5 w-fit h-fit mx-auto mb-0 px-8 pt-4 pb-4 border-4 border-primary rounded-3xl">
      <h1 class="text-black dark:text-bgcolor text-2xl text-center font-bold">Domisili Terbanyak</h1>
      <div class="mt-6">
        <table style="border-collapse: collapse;
        border-style: hidden;">
          @foreach($domisili as $d => $numD)
            <tr>
              <td class="w-96 border border-gray-500 dark:border-bgcolor px-2 pt-2 pb-2"><h1 class="text-black dark:text-bgcolor text-center">{{ $d }}</h1></td>  
              <td class="w-32 border border-gray-500 dark:border-bgcolor px-2 pt-2 pb-2"><h1 class="text-black dark:text-bgcolor text-center">{{ $numD }}</h1></td>  
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    <div class="ml-5 w-fit h-fit mx-auto mb-0 px-8 pt-4 pb-4 border-4 border-primary rounded-3xl">
        <h1 class="text-black dark:text-bgcolor text-2xl text-center font-bold">Tujuan Tes</h1>
        <div class="mt-6">
          <table style="border-collapse: collapse;
          border-style: hidden;">
            @foreach($goal as $g => $numG)
              <tr>
                <td class="w-60 border border-gray-500 dark:border-bgcolor px-2 pt-2 pb-2"><h1 class="text-black dark:text-bgcolor text-center">{{ $g }}</h1></td>  
                <td class="w-32 border border-gray-500 dark:border-bgcolor px-2 pt-2 pb-2"><h1 class="text-black dark:text-bgcolor text-center">{{ $numG }}</h1></td>  
              </tr>
            @endforeach
          </table>
        </div>
      </div>
  </div>

<br>

<form method="POST" action="{{ route('logout') }}" class="w-fit mx-auto">
    @csrf
    <button type="submit" class="w-fit h-fit border-2 border-black dark:border-white rounded-full">
        <h1 class="mx-8 my-2 text-black dark:text-white">Log Out</h1>
    </button>
</form>

<!-- Overlay buatEvent -->

<div id="buatEvent" class="top-0 left-1/4 w-1/2 h-[90vh] mt-12 rounded-xl bg-bgcolor dark:bg-slate-800 z-30 flex overflow-y-scroll overflow-hidden">
    <div class="w-full flex bg-primary mb-5 drop-shadow-2xl z-40 top-0 rounded-tl-xl items-center absolute">
        <h1 class="py-3 pl-5 text-secondary text-xl">Delapan Dimensi Kepemimpinan</h1>
    </div>

    <h1 class="text-4xl text-black dark:text-bgcolor text-center font-bold mt-20 mb-4">Daftarkan Event Baru</h1>
    <hr class="border-black dark:border-bgcolor w-3/4 mx-auto mb-4">

    <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nama" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Nama</label>
        <input type="text" name="nama" id="nama" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('nama') }}" placeholder="Nama Event" required maxlength="60"/>
        @error('nama')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <label for="institusi" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Institusi</label>
        <input type="text" name="institusi" id="institusi" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('institusi') }}" placeholder="Institusi/Perusahaan Peserta Event" required/>
        @error('institusi')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <label for="tanggal_mulai" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Tanggal Dimulai Event</label>
        <input type="date" name="tanggal_mulai" id="tanggal_mulai" placeholder="Nama Lengkap" onfocus="this.showPicker()" class="mb-4 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black mx-auto px-3 py-2 border shadow rounder w-10/12 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('tanggal_mulai')) border-red-500 @endif" value="{{ old('tanggal_mulai') }}" oninput="removeRedBorder(this)" required/>
        @error('tanggal_mulai')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <label for="tanggal_selesai" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Tanggal Berakhir Event</label>
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Nama Lengkap" onfocus="this.showPicker()" class="mb-4 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black mx-auto px-3 py-2 border shadow rounder w-10/12 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('tanggal_selesai')) border-red-500 @endif" value="{{ old('tanggal_selesai') }}" oninput="removeRedBorder(this)" required/>
        @error('tanggal_selesai')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <label for="deskripsi" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Deskripsi Event</label>
        <input type="text" name="deskripsi" id="deskripsi" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('deskripsi') }}" placeholder="Deskripsi Event Anda" required/>
        @error('deskripsi')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <h1 class="ml-14 text-black dark:text-bgcolor text-xl">- Tujuan Event</h1>
        <select name="tujuan_tes" id="" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('tujuan_tes') }}">
            <option value="0">-- Tujuan Diadakannya Event --</option>
            <option value="Personal Development">Personal Development</option>
            <option value="Career Development">Career Development</option>
        </select>
        @error('tujuan_tes')
        <h1 class="text-red-600 -mt-2 ml-14">{{ $message }}</h1>
        @enderror
        <label for="collab_url" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Alamat Web Perusahaan</label>
        <input type="text" name="collab_url" id="collab_url" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('collab_url') }}" placeholder="example.com" maxlength="40"/>
        @error('collab_url')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <h1 class="ml-14 text-black dark:text-bgcolor text-xl">- Logo Perusahaan</h1>
        <label for="collab_logo_base64" id="LogoPerusahaanBaru" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500">Logo Perusahaan</label>
        <input type="file" id="logoFileBaru" name="collab_logo_base64" id="collab_logo_base64" class="absolute -mt-20 ml-[3.25rem] w-10/12 h-16 opacity-0 " value="{{ old('collab_logo_base64') }}" accept="image/*"/>
        @error('collab_logo_base64')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror
        <label for="kode_akses" id="" class="ml-14 mb-6 text-black dark:text-bgcolor text-xl">- Kode Akses</label>
        <input type="text" name="kode_akses" id="kode_akses" class="mx-auto mb-4 w-10/12 rounded-md text-black dark:text-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor ring-black px-3 py-2 border shadow block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('kode_akses') }}" placeholder="Kode Akses untuk Event Anda (Harus berupa angka atau huruf sejumlah 6)" onkeyup="
        var start = this.selectionStart;
        var end = this.selectionEnd;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(start, end);" pattern=".{6,6}" maxlength="6" required />
        @error('kode_akses')
        <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
        @enderror

        <button type="submit" class="block w-fit h-fit px-6 py-2 mx-auto mb-12 border-2 border-black dark:border-bgcolor rounded-full text-black dark:text-bgcolor text-lg">Submit</button>
    </form>
    
</div>

<!-- 
@if ($errors->any())
    <script>
        document.getElementById("overlay").style.display = "block";
        document.getElementById("buatEvent").style.display = "block";
    </script>
@endif -->

<!-- end Overlay buatEvent -->



<script>

    document.getElementById("logoFileBaru").onchange = function(){
        document.getElementById("LogoPerusahaanBaru").textContent = this.files[0].name;
    }

    document.getElementById("buatEventbtn").addEventListener("click", function() {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("buatEvent").style.display = "block";
    });

    document.getElementById("overlay").addEventListener("click", function() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("buatEvent").style.display = "none";
    });

    for(let i = 1; i <= {{ $latestEvents->count() }}; i++) {
        document.getElementById("editEvent" + i).style.display = "none";
        document.getElementById("editEvent" + i).style.position = "fixed";
        document.getElementById("editEventbtn" + i).addEventListener("click", function() {
            document.getElementById("overlay").style.display = "block";
            document.getElementById("editEvent" + i).style.display = "block";
        });
        document.getElementById("overlay").addEventListener("click", function() {
            document.getElementById("overlay").style.display = "none";
            document.getElementById("editEvent" + i).style.display = "none";
        });

        document.getElementById("logoFile" + i).onchange = function(){
            document.getElementById("LogoPerusahaan" + i).textContent = this.files[0].name;
        }
    }
    
    for(let i = 1; i <= {{ $expiredEvents->count() }}; i++) {
        document.getElementById("editEventDone" + i).style.display = "none";
        document.getElementById("editEventDone" + i).style.position = "fixed";
        document.getElementById("editEventDonebtn" + i).addEventListener("click", function() {
            document.getElementById("overlay").style.display = "block";
            document.getElementById("editEventDone" + i).style.display = "block";
        });
        document.getElementById("overlay").addEventListener("click", function() {
            document.getElementById("overlay").style.display = "none";
            document.getElementById("editEventDone" + i).style.display = "none";
        });

        document.getElementById("logoFileDone" + i).onchange = function(){
            document.getElementById("LogoPerusahaanDone" + i).textContent = this.files[0].name;
        }
    }

    // if(localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    //     var titleColor = "#FFFFFF",
    // } else {
    //     var titleColor = "#000000",
    // }
    
    if(document.querySelector('html').classList.contains("dark")) {
        var titleColor = [
            "#FFFFFF",
        ]
    } else {
        var titleColor = [
            "#000000",
        ]
    }

    var JKelamin = ["Laki", "Perempuan"];
    var dataJKelamin = {!! json_encode($gender) !!};
    var barColors = [
      "#4C32EA",
      "#CC00CC",
    ];

    new Chart("pieChart", {
      type: "pie",
      data: {
        labels: JKelamin,
        datasets: [{
          backgroundColor: barColors,
          data: dataJKelamin
        }]
      },
      options: {
        title: {
          display: true,
          text: "Jenis Kelamin"
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: titleColor,
                    font: {
                        size: 16
                    }
                }
            }
        }
      }
    });

    // rentangUsiaChart rentangUsia

    
    var rentangUsia = ["<15", "15-20", "21-30", "31-40", "41-50", ">50"];
    var dataRUsia = {!! json_encode($age) !!};
    var barColors = "#8404F4";

    new Chart("rentangUsiaChart", {
      type: "bar",
      data: {
        labels: rentangUsia,
        datasets: [{
          backgroundColor: barColors,
          data: dataRUsia,
          barThickness: 20,
          clip: {
            left: 5,
            top: 0,
            right: 10,
            bottom: 2,
          },
        }]
      },
      options: {
        plugins: {
            legend: {
              display: false
            },
            title: {
                display: false,
            },
        },
        scales: {
            x: {
                grid:{
                    display: false
                }
            },
            y: {
              suggestedMin: 0,
              suggestedMax: 10,
            }
        }
      }
    });

    // PendidikanChart PendidikanChart

    
    var pendidikan = ["SD", "SMP", "SMA/K", "D1", "D2", "D3", "D4", "S1", "S2", "S3"];
    var dataPendidikan = [
        {{$education[0]}},
        {{$education[1]}},
        {{$education[2] + $education[3]}},
        {{$education[4]}},
        {{$education[5]}},
        {{$education[6]}},
        {{$education[7]}},
        {{$education[8]}},
        {{$education[9]}},
        {{$education[10]}},
    ];
    var barColors = "#8404F4";

    new Chart("PendidikanChart", {
      type: "bar",
      data: {
        labels: pendidikan,
        datasets: [{
          backgroundColor: barColors,
          data: dataPendidikan,
          barThickness: 20,
          clip: {
            left: 5,
            top: 0,
            right: 10,
            bottom: 2,
          },
        }]
      },
      options: {
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: false,
            },
        },
        scales: {
            x: {
                grid:{
                    display: false
                }
            },
            y: {
                suggestedMin: 0,
                suggestedMax: 10,
            }
        }
      }
    });

    const cityRoute = "{{ route('update.city-api') }}";
    const cityNotification = document.getElementById('city-notification')
    const errorNotification = document.getElementById('error-notification')

    document.getElementById('fetchButton').addEventListener('click', () => {
        fetch(cityRoute)
            .then(response => {
                console.log('Response status code:', response.status);
                if (!response.ok) {
                    throw new Error('Response tidak diterima dari server');
                }
                return response.json();
            })
            .then(data => {
                if (data['city-update'] == 'success') {
                    cityNotification.removeAttribute('hidden');
                } else {
                    throw new Error('Response tidak dikenali : ' + data)
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorNotification.textContent = error;
                errorNotification.removeAttribute('hidden');
            });
    });

    function fetchCityData(route) {
        fetch(route)
            .then(response => {
                console.log('Response status code:', response.status);
                if (!response.ok) {
                    throw new Error('Response tidak diterima dari server');
                }
                return response.json();
            })
            .then(data => {
                if (data['city-update'] == 'success') {
                    cityNotification.removeAttribute('hidden');
                } else {
                    throw new Error('Response tidak dikenali : ' + data)
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorNotification.textContent = error;
                errorNotification.removeAttribute('hidden');
            });
    }

</script>

@endsection