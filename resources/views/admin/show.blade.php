@extends('templates.default')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-16"></div>

<div class="bg-primary w-[90%] h-fit ml-12 mb-6 rounded-full relative flex">
    <h1 class="w-full text-secondary text-2xl font-bold text-center py-4">Data Tes : {{ $event->nama }}</h1>
</div>

<img src="{{ asset('storage/' . $event->collab_logo_base64) }}" alt="">
{{ $event->collab_logo_base64 }}

<label class="ml-[49px] relative inline-flex items-center mr-5 cursor-pointer">
  <input id="holdSwitch" type="checkbox" class="sr-only peer" @if($event->is_answers_hold == true) checked @endif>
  <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#ff0033]"></div>
  <span class="ml-3 text-sm font-medium text-purple-800 dark:text-purple-300">HOLD THIS EVENT</span>
</label> 

<label class="ml-[49px] relative inline-flex items-center mr-5 cursor-pointer">
  <input id="holdSwitch2" type="checkbox" class="sr-only peer" @if($event->is_institution_hold == true) checked @endif>
  <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#ff0033]"></div>
  <span class="ml-3 text-sm font-medium text-purple-800 dark:text-purple-300">DON'T USE INSTITUTION</span>
</label> 

<div class="w-[90%] grid grid-cols-12 gap-6 ml-12 mb-12">
    <div class="bg-primary col-span-9 h-fit rounded-xl flex px-8 py-16">
        <h1 class="w-56 text-white">Total Peserta<br>Tanggal Pengerjaan<br>Kode Akses<br>Institusi<br>Deskripsi</h1>
        <h1 class="w-fit text-white ml-6">:<br>:<br>:<br>:<br>:</h1>
        <h1 class="w-fit text-white ml-6">{{ $users }}<br>{{ $timeStart }} - {{ $timeEnd }}<br>{{ $event->kode_akses }}<br>{{ $event->institusi }}<br>{{ $event->deskripsi }}</h1>
    </div>
    
    <div class="bg-primary h-full col-span-3 rounded-xl px-6 py-4">
        <h1 class="w-full text-white text-lg text-center font-bold mb-2">View</h1>
        <hr class="w-3/4 mx-auto border-white mb-6">
        <a href="#progress" class="text-white mb-2 hover:underline">- Progress</a> <br>
        <a href="#kelamin" class="text-white mb-2 hover:underline">- Jenis Kelamin</a> <br>
        <a href="#usia" class="text-white mb-2 hover:underline">- Usia & Pendidikan</a> <br>
        <a href="#domisili" class="text-white mb-2 hover:underline">- Domisili & Logo</a> <br>
        <a href="#dimensi" class="text-white mb-2 hover:underline">- Penyebaran8D</a> <br>
        <a href="#data" class="text-white mb-2 hover:underline">- Data Individual</a>
    </div>
</div>
<h1 id="progress" class="text-black dark:text-bgcolor text-3xl font-bold text-center">Progres Keseluruhan</h1>
<canvas id="progressBar" class="mx-auto mb-8" style="width:100%;max-width:600px;height:100%;max-height:100px"></canvas>
<div id="kelamin" class="w-fit h-fit mx-auto mb-12 px-24 pt-6 border-4 border-primary rounded-3xl">
  <h1 class="w-[460px] text-black dark:text-bgcolor text-2xl text-center font-bold -mb-6">Jenis Kelamin</h1>
  <canvas id="piesChart" class="mx-auto" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
</div>
<div id="usia" class="flex mx-24 mb-14">
  <canvas id="usiasChart" class="mx-auto" style="width:100%;max-width:500px;height:100%;max-height:300px;"></canvas>
  <canvas id="pendidikanChart" class="mx-auto" style="width:100%;max-width:500px;height:100%;max-height:300px;"></canvas>
</div>
<div id="domisili" class="flex w-fit mx-auto justify-center mb-10">
  <div class="mr-5 w-fit h-fit mx-auto mb-0 px-8 pt-4 pb-4 border-4 border-primary rounded-3xl">
    <h1 class="text-black dark:text-bgcolor text-2xl text-center font-bold">Domisili Terbanyak</h1>
    <div class="mt-6">
      <table style="border-collapse: collapse;
      border-style: hidden;">
        @foreach($domisili as $d => $num)
          <tr>
            <td class="w-96 border border-gray-500 dark:border-bgcolor px-2 pt-2 pb-2"><h1 class="text-black dark:text-bgcolor text-center">{{ $d }}</h1></td>  
            <td class="w-32 border border-gray-500 dark:border-bgcolor px-2 pt-2 pb-2"><h1 class="text-black dark:text-bgcolor text-center">{{ $num }}</h1></td>  
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  <div class="ml-5 w-fit h-fit mx-auto mb-0 px-8 pt-4 pb-4 border-4 border-primary rounded-3xl">
    <h1 class="text-black dark:text-bgcolor text-2xl text-center font-bold">Logo Collab</h1>
    <img src="{{ asset('/collab-logo/' . $img)}}" alt="Collab Logo" class="w-[250px] h-[250px] mt-4">
  </div>
</div>
<div id="dimensi" class="w-fit h-fit mx-auto mb-12 px-6 pt-6 border-4 border-primary rounded-3xl">
    <h1 class="text-black dark:text-bgcolor text-2xl text-center font-bold">Penyebaran Dimensi Kepemimpinan</h1>
  <canvas id="8DChart" class="mx-auto" style="width:100%;max-width:400px;height:100%;max-height:300px"></canvas>
</div>

<h1 id="data" class="mb-6 text-black dark:text-bgcolor text-2xl text-center font-light italic">Data Individual Yang Selesai</h1>

<table id="selesai" class="w-10/12 mx-auto mb-8 border-2 border-black dark:border-bgcolor">
  <tr class="border-2 border-black dark:border-bgcolor">
    <th class="border-2 border-black dark:border-bgcolor text-black"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">No</h1></th>
    <th class="border-2 border-black dark:border-bgcolor text-black"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">Selesai Mengerjakan</h1></th>
    <th class="border-2 border-black dark:border-bgcolor text-black"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">Hasil</h1></th>
  </tr>
  @foreach ($finishedUserS as $u)
  <tr class="border-2 border-black dark:border-bgcolor">
    <td class="border-2 border-black dark:border-bgcolor text-black"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">{{ $loop->iteration }}</h1></td>
    <td class="border-2 border-black dark:border-bgcolor text-black"><h1 class="mx-2 my-1 text-black dark:text-bgcolor">{{ $u->user->name }}</h1></td>

    @php
      $filePath = storage_path('pdf') . DIRECTORY_SEPARATOR . $u->pdf_original_name . '.pdf';
    @endphp

    @if(file_exists($filePath))
      <td class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-center my-1"><a href="{{ route('event.pdf.download', ['jawaban' => $u->id]) }}" class="text-blue-400 hover:underline">Download PDF</a></h1></td>
    @else 
      <td class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-center my-1"><a href="{{ route('event.pdf.generate', ['jawaban' => $u->id]) }}" class="text-blue-400 hover:underline">Generate PDF</a></h1></td>
    @endif
    
  </tr>
  @endforeach
</table>


<h1 class="mb-6 text-black dark:text-bgcolor text-2xl text-center font-light italic">Data Peserta Yang Sedang Mengerjakan</h1>

<table class="w-10/12 mx-auto border-2 border-black dark:border-bgcolor">
  <tr class="border-2 border-black dark:border-bgcolor">
    <th class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">No</h1></th>
    <th class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">Nama</h1></th>
    <th class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">Progress</h1></th>
  </tr>
  @foreach ($unfinishedUserS as $u)
  <tr class="border-2 border-black dark:border-bgcolor">
    <td class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-center text-black dark:text-bgcolor my-1">{{ $loop->iteration }}</h1></td>
    <td class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 my-1 text-black dark:text-bgcolor">{{ $u ->user->name }}</h1></td>
    <td class="border-2 border-black dark:border-bgcolor"><h1 class="mx-2 text-black dark:text-bgcolor text-center my-1 capitalize">{{ $u->progress }}</h1></td>
  </tr>
  @endforeach
</table>

<div class="flex justify-center">
  <a href="{{ route('admin.event.index') }}" class="mt-16 w-fit h-fit border-2 border-black dark:border-white rounded-full inline-block cursor-pointer">
    <h1 class="mx-8 my-2 text-black dark:text-white">Kembali</h1>
  </a>
</div>

<!-- 
<div>
  <p> kelamin {{ var_dump($kelamin) }}</p>
  <p>{{ var_dump($usia) }}</p>
  <p>{{ var_dump($pendidikan) }}</p>
  <p>{{ var_dump($domisili) }}</p>
  <p>{{ var_dump($penyebaran8D) }}</p>
</div>
-->

@if(session('success'))
  <script>
    window.location = '#selesai';
  </script>
@endif

<script>

  var progress2 = document.getElementById("progressBar").getContext('2d');

    let done = {{ $finishedUser }};
    let total = {{ $totalJawaban }} ;
    let donePercent = done / total * 100;
    let totalPercent = (total - done) / total * 100;

    var myChart = new Chart(progress2, {
      type: 'bar',
      data: {
        labels: [""],
        datasets: [{
            label: 'Sudah Mengerjakan (%)',
            backgroundColor: "#8404F4",
            data: [donePercent],
            barThickness: 50,
          },
          {
            label: 'Belum Mengerjakan (%)',
            backgroundColor: "#B984FF",
            data: [totalPercent],
            barThickness: 50,
          },
        ],
      },
      options: {
        border: {
          color: "red"
        },
        indexAxis: 'y',
        scales: {
          x: {
            stacked: true,
            grid: {
              display: false
            }
          },
          y: {
            stacked: true,
            grid: {
              display: false
            }
          }
        },
        plugins: {
            legend: {
                position: 'bottom',
            }
        },
        responsive: true
      }
    });

    var JKelamin = ["Laki", "Perempuan"];
    var dataJKelamin = [
      {{ $kelamin[0] }},
      {{ $kelamin[1] }}
    ];
    var barColors = [
      "#4C32EA",
      "#CC00CC",
    ];

    new Chart("piesChart", {
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
                position: 'right',
                labels: {
                  color: 'black',
                  font: {
                      size: 24,
                      weight: 'bold',
                  }
                }
            },
        },
        responsive: true,
      }
    });

    var rentangUsia = ["<15", "15-20", "21-30", "31-40", "41-50", ">51"];
    var dataRUsia = [
      {{ $usia[0] }},
      {{ $usia[1] }},
      {{ $usia[2] }},
      {{ $usia[3] }},
      {{ $usia[4] }},
      {{ $usia[5] }},
    ];
    var barColors = "#8404F4";
    // var filteredLabels = [];
    // var filteredData = [];
    // for (var i = 0; i < dataRUsia.length; i++) {
    //     if (dataRUsia[i] !== 0) {
    //         filteredLabels.push(rentangUsia[i]);
    //         filteredData.push(dataRUsia[i]);
    //     }
    // }

    new Chart("usiasChart", {
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
                display: true,
                text: "Rentang Usia",
                color: 'black',
                font: {
                    size: 16,
                }
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
        },
        responsive: true,
      }
    });

    var pendidikann = ["SD", "SMP", "SMA", "SMK", "D1", "D2", "D3", "D4", "S1", "S2", "S3"];
    var dataPendidikan = [
        {{ $pendidikan[0] }},
        {{ $pendidikan[1] }},
        {{ $pendidikan[2] }},
        {{ $pendidikan[3] }},
        {{ $pendidikan[4] }},
        {{ $pendidikan[5] }},
        {{ $pendidikan[6] }},
        {{ $pendidikan[7] }},
        {{ $pendidikan[8] }},
        {{ $pendidikan[9] }},
        {{ $pendidikan[10] }},
    ];
    var barColors = "#8404F4";
    // var filteredLabels = [];
    // var filteredData = [];

    // for (var i = 0; i < dataPendidikan.length; i++) {
    //     if (dataPendidikan[i] !== 0) {
    //         filteredLabels.push(pendidikann[i]);
    //         filteredData.push(dataPendidikan[i]);
    //     }
    // }

    new Chart("pendidikanChart", {
      type: "bar",
      data: {
        labels: pendidikann,
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
                display: true,
                text: "Rata - Rata Pendidikan",
                color: 'black',
                font: {
                    size: 16,
                }
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
        },
        responsive: true,
      }
    });

    var d8D = ["Pelopor", "Penggerak", "Afirmasi", "Inklusif", "Rendah Hati", "Pemikir", "Tegas", "Berwibawa"];
    var data8D = [
      {{ $penyebaran8D[0] }},
      {{ $penyebaran8D[1] }},
      {{ $penyebaran8D[2] }},
      {{ $penyebaran8D[3] }},
      {{ $penyebaran8D[4] }},
      {{ $penyebaran8D[5] }},
      {{ $penyebaran8D[6] }},
      {{ $penyebaran8D[7] }},
    ];
    var barColors = [
      "#E8FD1F",
      "#FF2121",
      "#8BC7D5",
      "#5B9BD5",
      "#00B02E",
      "#264478",
      "#FFC000",
      "#9E480E",
    ];

    new Chart("8DChart", {
      type: "pie",
      data: {
        labels: d8D,
        datasets: [{
          backgroundColor: barColors,
          data: data8D
        }]
      },
      options: {
        title: {
          display: true,
          text: "Jenis Kelamin"
        },
        plugins: {
            legend: {
                position: 'left',
                labels: {
                  color: 'black',
                  font: {
                      size: 16,
                  }
                }
            }
        },
        responsive: true,
      }
    });

    const holdSwitch = document.getElementById('holdSwitch');
    const holdRoute = "{{ route('update.event.on-hold', ['event' => $event]) }}";
    
    const holdSwitch2 = document.getElementById('holdSwitch2');
    const holdRoute2 = "{{ route('update.event.institution', ['event' => $event]) }}";

  holdSwitch.addEventListener('click', () => {
    const value = holdSwitch.checked ? 1 : 0;
    const extendedUrl = `${holdRoute}?value=${encodeURIComponent(value)}`;

    fetch(extendedUrl)
      .then(response => {
        if (!response.ok) {
          throw new Error('Response tidak diterima dari server');
        }
        return response.json();
      })
      .then(data => {
        if (data['on-hold'] == 1) {
          // kalau mau alert
        } else if (data['on-hold'] == 0){
          // kalau mau alert
        } else {
          throw new Error('Response tidak dikenali : ' + data);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('error:' + error);
      });
  });
  
  holdSwitch2.addEventListener('click', () => {
    const value = holdSwitch2.checked ? 1 : 0;
    const extendedUrl = `${holdRoute2}?value=${encodeURIComponent(value)}`;

    fetch(extendedUrl)
      .then(response => {
        if (!response.ok) {
          throw new Error('Response tidak diterima dari server');
        }
        return response.json();
      })
      .then(data => {
        if (data['on-hold'] == 1) {
          // kalau mau alert
        } else if (data['on-hold'] == 0){
          // kalau mau alert
        } else {
          throw new Error('Response tidak dikenali : ' + data);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('error:' + error);
      });
  });

</script>

@endsection