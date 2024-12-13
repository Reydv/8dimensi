 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.tailwindcss.com"></script>
     <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily:{
                        montserrat: ['Montserrat', 'sans'],
                    },
                    colors: {
                        primary: '#6001D1',
                        secondary: '#F7F1F1',
                        bgcolor: '#F7F1F1',
                        // ...
                      },
                      spacing: {
                        '25' : '25rem',
                      },
                },
            },
        }
    </script>
    <link rel="icon" href="{{ asset('dist/8DLogo.png') }}" type="image/x-icon">
    <title>8 Dimensi - Register</title>
 </head>

 <body class="bg-[#F7F1F1]">
     <h1 class="mt-10 block text-center text-6xl font-bold">
         Daftar
     </h1>
     <h1 class="mt-2 mb-5 block text-center text-xl">
         Cepat dan Mudah
     </h1>

     <form method="POST" action="{{ route('register') }}" class="max-w-sm mx-auto">
         @csrf
         <h1 class="ml-1 mb-1">Isi Data Dirimu</h1>
         <label for="name" id="">
             <input type="text" name="name" id="name" class="mb-2 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @error('name')  placeholder-shown:border-red-500 @enderror" value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus/>
             @error('name')
             <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
             @enderror
         </label>
         <h1 class="ml-1 mb-1">Tanggal Lahir</h1>
         <label for="tanggal_lahir" id="">
             <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" onfocus="this.showPicker()" class="mb-2 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm bg-white placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if($errors->has('tanggal_lahir')) border-red-500 @endif" value="{{ old('tanggal_lahir') }}" oninput="removeRedBorder(this)" />
             @error('tanggal_lahir')
             <h1 class="text-red-600 -mt-2">{{ $message }}</h1>
             @enderror
         </label>
         <h1 class="ml-1 mb-1">Jenis Kelamin</h1>
         <label for="jeniskelamin" id="" class="flex mb-5">
             <ul class="flex mt-1">
                 <li>
                     <input type="checkbox" name="jenis_kelamin" id="jenis_kelamin1" class="peer/laki hidden single-check" value="laki" @if(old('jenis_kelamin')=='laki' ) checked @endif />
                     <label for="jenis_kelamin1" class="select-none cursor-pointer rounded-lg border-2 border-sky-500 py-[6px] px-[61px] font-bold text-sky-500 transition-colors duration-200 ease-in-out peer-checked/laki:bg-sky-500 peer-checked/laki:text-[#F7F1F1] peer-checked/laki:border-[#F7F1F1] mr-1"> Laki-laki </label>
                 </li>
                 <li>
                     <input type="checkbox" name="jenis_kelamin" id="jenis_kelamin2" class="peer/perempuan hidden single-check" value="perempuan" @if(old('jenis_kelamin')=='perempuan' ) checked @endif />
                     <label for="jenis_kelamin2" class="select-none cursor-pointer rounded-lg border-2 border-pink-500 py-[6px] px-[50px] font-bold text-pink-500 transition-colors duration-200 ease-in-out peer-checked/perempuan:bg-pink-500 peer-checked/perempuan:text-[#F7F1F1] peer-checked/perempuan:border-[#F7F1F1]"> Perempuan </label>
                 </li>
             </ul>
         </label>
         @error('jenis_kelamin')
         <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
         @enderror
         <label for="email" id="">
             <input type="email" name="email" id="email" placeholder="Alamat Email" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 @error('email') placeholder-shown:border-red-500 @enderror" value="{{ old('email') }}" />
             @error('email')
             <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
             @enderror
         </label>
         <label for="notelp" id="">
             <input type="number" name="notelp" id="notelp" placeholder="Nomor Telepon" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @error('notelp') placeholder-shown:border-red-500 @enderror" value="{{ old('notelp') }}" />
             @error('notelp')
             <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
             @enderror
         </label>
         <select id="domisili" name="domisili" size="1" class="mb-3 rounded-md bg-white border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if(old('domisili') == '0') border-red-500 @endif" >
           <option value="0">-- Pilih Domisili --</option>
           @foreach($domisilis as $domisili)
           <option value="{{ $domisili }}" @if(old('domisili')==$domisili ) selected @endif>{{ $domisili }}</option>
           @endforeach
         </select>
         @error('domisili')
         <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
         @enderror
         <label for="pendidikan_terakhir" id="">
             <select name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="Pendidikan Terakhir (SMA/D3/S1/S2/dsb)" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @error('pendidikan_terakhir')  placeholder-shown:border-red-500 @enderror" value="{{ old('pendidikan_terakhir') }}" />
                 <option value="0" @if(old('pendidikan_terakhir')=='0' ) selected @endif>-- Pendidikan Terakhir --</option>
                 <option value="sd" @if(old('pendidikan_terakhir')=='sd' ) selected @endif>SD</option>
                 <option value="smp" @if(old('pendidikan_terakhir')=='smp' ) selected @endif>SMP</option>
                 <option value="sma" @if(old('pendidikan_terakhir')=='sma' ) selected @endif>SMA</option>
                 <option value="smk" @if(old('pendidikan_terakhir')=='smk' ) selected @endif>SMK</option>
                 <option value="d1" @if(old('pendidikan_terakhir')=='d1' ) selected @endif>D1</option>
                 <option value="d2" @if(old('pendidikan_terakhir')=='d2' ) selected @endif>D2</option>
                 <option value="d3" @if(old('pendidikan_terakhir')=='d3' ) selected @endif>D3</option>
                 <option value="d4" @if(old('pendidikan_terakhir')=='d4' ) selected @endif>D4</option>
                 <option value="s1" @if(old('pendidikan_terakhir')=='s1' ) selected @endif>S1</option>
                 <option value="s2" @if(old('pendidikan_terakhir')=='s2' ) selected @endif>S2</option>
                 <option value="s3" @if(old('pendidikan_terakhir')=='s3' ) selected @endif>S3</option>
             </select>
             @error('pendidikan_terakhir')
             <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
             @enderror
         </label>
         <label for="status" id="">
             <select name="status" id="status" class="mb-3 rounded-md bg-white border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" oninput="removeRedBorder(this)">
                 <option value="0" @if(old('status')=='0' ) selected @endif>-- Pilih Status --</option>
                 <option value="1" @if(old('status')=='1' ) selected @endif>Pelajar</option>
                 <option value="2" @if(old('status')=='2' ) selected @endif>Pekerja</option>
             </select>
             @error('status')
             <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
             @enderror
         </label>
         <div id="div-pelajar" class="@if(old('status') == '1') block @else hidden @endif"> 
            <!-- pelajar -->
             <label for="jurusan" id="">
                 @error('jurusan')
                 <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
                 @enderror
                 <input type="text" name="jurusan" id="jurusan" placeholder="Jurusan" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('jurusan') }}" />
             </label>
             <label for="institusi" id="">
                 @error('institusi')
                 <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
                 @enderror
                 <input type="text" name="institusi" id="institusi" placeholder="Institusi" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('institusi') }}" />
             </label>
         </div>
         <div id="div-pekerja" class="@if(old('status') == '2') block @else hidden @endif">
            <!-- pekerja -->
            <label for="perusahaan" id="">
                 @error('perusahaan')
                 <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
                 @enderror
                 <input type="text" name="perusahaan" id="perusahaan" placeholder="Perusahaan" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('perusahaan') }}" />
             </label>
             <label for="jabatan" id="">
                 @error('jabatan')
                 <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
                 @enderror
                 <select id="jabatan" name="jabatan" size="1" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @if(old('jabatan') == '0') border-red-500 @endif" >
                    <option value="0" @if(old('jabatan')=='0') selected @endif>-- Pilih Jabatan --</option>
                    <option value="Staff/Pelaksana" @if(old('jabatan')=='Staff/Pelaksana' ) selected @endif>Staff/Pelaksana</option>
                    <option value="Team Lead/Supervisor" @if(old('jabatan')=='Team Lead/Supervisor' ) selected @endif>Team Lead/Supervisor</option>
                    <option value="Assisten Manager/Muda" @if(old('jabatan')=='Assisten Manager/Muda' ) selected @endif>Assisten Manager/Muda</option>
                    <option value="Manager/Jr. Manager/Madya" @if(old('jabatan')=='Manager/Jr. Manager/Madya' ) selected @endif>Manager/Jr. Manager/Madya</option>
                    <option value="General Manager/Sr. Manager/Utama" @if(old('jabatan')=='General Manager/Sr. Manager/Utama' ) selected @endif>General Manager/Sr. Manager/Utama</option>
                    <option value="Direktur/C-Level" @if(old('jabatan')=='Direktur/C-Level' ) selected @endif>Direktur/C-Level</option>
                    <option value="Owner/Pemilik" @if(old('jabatan')=='Owner/Pemilik' ) selected @endif>Owner/Pemilik</option>
                    <option value="Lain-lain" @if(old('jabatan')=='Lain-lain' ) selected @endif>Lain-lain</option>
                  </select>
             </label>
             <label for="masa_kerja" id="">
                 @error('masa_kerja')
                 <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
                 @enderror
                 <input type="number" name="masa_kerja" id="masa_kerja" placeholder="Masa Kerja" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" value="{{ old('masa_kerja') }}" />
             </label>
         </div>
         <label for="password" id="">
             @error('password')
             <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
             @enderror
             <input type="password" name="password" id="password" placeholder="Password" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @error('password')  placeholder-shown:border-red-500 @enderror" value="{{ old('password') }}" />
         </label>
         <label for="confirmpassword" id="">
             <input type="password" name="password_confirmation" id="confirmpassword" placeholder="Konfirmasi Password" class="mb-3 rounded-md border-black ring-black mx-auto px-3 py-2 border shadow rounder w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 @error('password') placeholder-shown:border-red-500 @enderror" value="{{ old('password_confirmation') }}" />
             @error('password_confirmation')
             <h1 class="text-red-600 -mt-3 mb-1">{{ $message }}</h1>
             @enderror
            </label>
         <div class="flex mt-12 mb-36 w-full space-x-28">
             <button type="submit" class="w-32 border-solid rounded-lg border-4 bg-primary hover:border-indigo-800 hover:border-4 transition-colors duration-200 ease-in-out">
                 <h1 class="text-[#F7F1F1] text-center font-semibold italic m-1">Daftar</h1>
             </button>
             <a href="{{ route('loginPage') }}" class="underline justify-self-end m-1 hover:text-sky-500">
                 Sudah Punya Akun?
             </a>
         </div>
     </form>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
        $(document).ready(function() {
            $('.single-check').on('change', function() {
                $('.single-check').not(this).prop('checked', false);
            });
        });
        const status = document.getElementById("status");
        const hidden1 = document.getElementById("div-pelajar");
        const hidden2 = document.getElementById("div-pekerja");
        const jurusan = document.getElementById("jurusan");
        const institusi = document.getElementById("institusi");
        const perusahaan = document.getElementById('perusahaan');
        const jabatan = document.getElementById('jabatan');
        const masaKerja = document.getElementById('masa_kerja');
        status.addEventListener("change", function() {
            if (status.value == 1) {
                hidden1.classList.remove("hidden");
                hidden1.classList.add("block");
                hidden2.classList.add("hidden");
                jabatan.value = "0";
                masaKerja.value = "";
                perusahaan.value = "";
            } else if (status.value == 2) {
                hidden2.classList.remove("hidden");
                hidden2.classList.add("block");
                hidden1.classList.add("hidden");
                hidden1.classList.remove("block");
                jurusan.value = "";
                institusi.value = "";
            } else {
                hidden1.classList.add("hidden");
                hidden2.classList.add("hidden");
                jurusan.value = "";
                institusi.value = "";
                jabatan.value = "0";
                masaKerja.value = "";
                perusahaan.value = "";
            }
        });
        function removeRedBorder(input) {
        if (input.valueAsDate) {
            input.classList.remove('border-red-500');
        } else {
            input.classList.add('border-red-500');
        }
    }
     </script>
 </body>

 </html>