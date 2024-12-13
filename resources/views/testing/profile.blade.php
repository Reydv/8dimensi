@extends('templates.default')

@section('content')

<div class="mt-20"></div>

<!-- topSection -->

<img src="{{ asset('/dist/profileimg.png') }}" alt="profile picture" class="w-fit mx-auto mb-2">
<h1 class="font-black text-5xl text-center text-black dark:text-bgcolor">{{Auth::user()->name}}</h1>
<h1 class="text-center text-black dark:text-bgcolor mb-5">{{Auth::user()->email}}</h1>

<!-- End topSection -->

<!-- labelEdit -->

<h1 class="text-xl text-center text-black dark:text-bgcolor">Edit Profil</h1>
<h1 class="text-center text-black dark:text-bgcolor">Profil hanya dapat diubah 48 jam sekali </h1>
<h1 class="text-center text-black dark:text-bgcolor italic text-xs mb-8">*Beberapa informasi tidak dapat Anda ubah, silahkan hubungi admin untuk informasi lebih lanjut</h1>

<!-- End labelEdit -->

<!-- editProfile -->

<form method="POST" action="{{ route('profile.update') }}" class="max-w-sm mx-auto">
    @method('PATCH')
    @csrf
    <h1 class="ml-1 mb-1 text-black dark:text-bgcolor">Isi Data Dirimu</h1>
    <label for="name" id="">
        <input type="text" name="name" id="name" placeholder="Nama Lengkap" value="{{Auth::user()->name}}" class="text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 mb-2 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent"/>
    </label>
    <label for="tanggallahir" id="">
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{Auth::user()->tanggal_lahir}}" onfocus="this.showPicker()" class="text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 mb-2 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent cursor-pointer"/>
    </label>
    <label for="jeniskelamin" id="" class="flex mb-3">
        <input type="text" disabled name="jenis_kelamin" id="jenis_kelamin" value="{{Auth::user()->jenis_kelamin}}" class="text-slate-600 bg-slate-300 border-slate-600 mx-auto px-3 py-2 rounded-md w-full text-sm">
    </label>
    <label for="email" id="">
        <input type="email" disabled name="email" id="email" placeholder="Alamat Email" value="{{Auth::user()->email}}" class="mb-3 rounded-md border-slate-600 mx-auto px-3 py-2 border shadow w-full block text-sm bg-slate-300 text-slate-600"/>
    </label>
    <label for="telepon" id="">
        <input type="text" disabled name="notelp" id="notelp" placeholder="Nomor Telepon" value="{{Auth::user()->notelp}}" class="mb-3 rounded-md border-slate-600 mx-auto px-3 py-2 border shadow w-full block text-sm bg-slate-300 text-slate-600"/>
    </label>
    <label for="pendidikanterkahir" id="">
        <select name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="Pendidikan Terakhir (SMA/D3/S1/S2/dsb)" value="{{Auth::user()->pendidikan_terakhir}}" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent"/>
                 <option value="0" @if(Auth::user()->pendidikan_terakhir == '0') selected @endif>-- Pendidikan Terakihr --</option>
                 <option value="sd" @if(Auth::user()->pendidikan_terakhir == 'sd') selected @endif>SD</option>
                 <option value="smp" @if(Auth::user()->pendidikan_terakhir == 'smp') selected @endif>SMP</option>
                 <option value="sma" @if(Auth::user()->pendidikan_terakhir == 'sma') selected @endif>SMA</option>
                 <option value="smk" @if(Auth::user()->pendidikan_terakhir == 'smk') selected @endif>SMK</option>
                 <option value="d1" @if(Auth::user()->pendidikan_terakhir == 'd1') selected @endif>D1</option>
                 <option value="d2" @if(Auth::user()->pendidikan_terakhir == 'd2') selected @endif>D2</option>
                 <option value="d3" @if(Auth::user()->pendidikan_terakhir == 'd3') selected @endif>D3</option>
                 <option value="d4" @if(Auth::user()->pendidikan_terakhir == 'd4') selected @endif>D4</option>
                 <option value="s1" @if(Auth::user()->pendidikan_terakhir == 's1') selected @endif>S1</option>
                 <option value="s2" @if(Auth::user()->pendidikan_terakhir == 's2') selected @endif>S2</option>
                 <option value="s3" @if(Auth::user()->pendidikan_terakhir == 's3') selected @endif>S3</option>
        </select>
    </label>
    <div class="m-0 p-0 @if(Auth::user()->status == '1') block @else hidden @endif">
        <label for="Jurusan" id="">
            <input type="text" name="jurusan" id="Jurusan" placeholder="Jurusan" value="{{Auth::user()->jurusan}}" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent"/>
        </label>
        <label for="institusi" id="">
            <input type="text" name="institusi" id="institusi" placeholder="Institusi" value="{{Auth::user()->institusi}}" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent"/>
        </label>
    </div>
    <div class="m-0 p-0 @if(Auth::user()->status == '2') block @else hidden @endif">
        <label for="Perusahaan" id="">
            <input type="text" name="perusahaan" id="Perusahaan" placeholder="Perusahaan" value="{{Auth::user()->perusahaan}}" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent"/>
        </label>
        <label for="jabatan" id="">
            @error('jabatan')
            <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
            @enderror
            {{-- <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan dalam perusahaan" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('jabatan') }}" /> --}}
            <select id="jabatan" name="jabatan" size="1" class="mb-3 rounded-md text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if(old('jabatan') == '0') border-red-500 @endif" >
               <option value="0">-- Pilih Jabatan --</option>
               <option value="Staff/Pelaksana" @if(Auth::user()->jabatan =='Staff/Pelaksana' ) selected @endif>Staff/Pelaksana</option>
               <option value="Team Lead/Supervisor" @if(Auth::user()->jabatan =='Team Lead/Supervisor' ) selected @endif>Team Lead/Supervisor</option>
               <option value="Assisten Manager/Muda" @if(Auth::user()->jabatan =='Assisten Manager/Muda' ) selected @endif>Assisten Manager/Muda</option>
               <option value="Manager/Jr. Manager/Madya" @if(Auth::user()->jabatan =='Manager/Jr. Manager/Madya' ) selected @endif>Manager/Jr. Manager/Madya</option>
               <option value="General Manager/Sr. Manager/Utama" @if(Auth::user()->jabatan =='General Manager/Sr. Manager/Utama' ) selected @endif>General Manager/Sr. Manager/Utama</option>
               <option value="Direktur/C-Level" @if(Auth::user()->jabatan =='Direktur/C-Level' ) selected @endif>Direktur/C-Level</option>
               <option value="Owner/Pemilik" @if(Auth::user()->jabatan =='Owner/Pemilik' ) selected @endif>Owner/Pemilik</option>
               <option value="Lain-lain" @if(Auth::user()->jabatan =='Lain-lain' ) selected @endif>Lain-lain</option>
             </select>
        </label>
        <label for="masa_kerja" id="">
            <input type="text" name="masa_kerja" id="masa_kerja" placeholder="Masa Kerja" value="{{Auth::user()->masa_kerja}}" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm text-black dark:text-bgcolor bg-bgcolor dark:bg-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 focus:placeholder:text-transparent"/>
        </label>
    </div>
    <label for="password" id="">
        <input type="text" name="password" placeholder="Password tidak dapat dirubah" value="" class="mb-3 rounded-md border-black dark:border-bgcolor mx-auto px-3 py-2 border shadow rounder w-full block text-sm bg-slate-300" disabled/>
    </label>
    <div class="flex mt-12 mb-36 w-full">
        <button type="submit" class="w-fit border-solid rounded-lg bg-primary hover:ring-indigo-800 hover:ring-2 transition-colors duration-200 ease-in-out px-3 py-1 mx-auto">
            <h1 class="text-[#F7F1F1] text-center font-semibold italic m-1">Ubah Profile</h1>
        </button>
    </div>

</form>

<!-- End editProfile -->
@endsection