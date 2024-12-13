  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
      </h2>
    </x-slot>

    <div>
      <form action="{{ route('user.form.store', ['kode-akses' => 'ADSFFF']) }}" method="POST">
        @csrf
        <button type="submit" class="text-secondary font-montserrat text-9xl">aaaaaaa</button>
      </form>
      <button onclick="alertFunction()" class="border-2 border-black text-white bg-slate-700 ml-20">testing tombol alert</button>
    </div>

    <div class="py-12">
      <div class="max$table->foreignId('jawaban_id');-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-primary dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("You're logged in!") }}
          </div>
        </div>
      </div>
    </div>
    <div class="checkboxes">
      <form action="{{route('checkbox.store')}}" method="post">
        @csrf
        <!-- <label for="checkbox1">Checkbox 1</label>
    <input type="checkbox" id="" name="checkboxes" value="d"> -->
        <div class="row-1 inline-flex">
          <input type="checkbox" name="checkboxes" class="single-checkbox check1 peer hidden" id="choose me" value="d">
          <label for="choose me" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <br>
          <input type="checkbox" name="checkboxes" class="single-checkbox check2 peer hidden" id="choose me1" value="i">
          <label for="choose me1" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <br>
          <input type="checkbox" name="checkboxes" class="single-checkbox check3 peer hidden" id="choose me2" value="s">
          <label for="choose me2" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <br>
          <label>
            <input type="checkbox" name="checkboxes" class="single-checkbox check4 peer hidden" id="choose me3" value="c">
            </labe for="choose me3" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
            <br>
        </div>
        <div class="row-2 inline-flex">
          <input type="checkbox" name="checkboxes1" class="single-checkbox1 check1 peer hidden" id="choose me4" value="d">
          <label for="choose me4" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <br>
          <input type="checkbox" name="checkboxes1" class="single-checkbox1 check2 peer hidden" id="choose me5" value="i">
          <label for="choose me5" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <br>
          <input type="checkbox" name="checkboxes1" class="single-checkbox1 check3 peer hidden" id="choose me6" value="s">
          <label for="choose me6" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <br>
          <input type="checkbox" name="checkboxes1" class="single-checkbox1 check4 peer hidden" id="choose me7" value="c">
          <label for="choose me7" class="ml-12 p-4 border-2 border-black rounded-full peer-checked:bg-green-500 peer-checked:border-transparent">
          </label>
          <input type="checkbox" name="checkboxes1" class="single-checkbox1 check4 peer/1 hidden" id="choose m" value="c">
          <label for="choose m" class="ml-12 p-4 border-2 border-black rounded-full peer-checked/1:bg-green-500 peer-checked/1:border-transparent">
          </label>
          <br>
        </div>

        <!-- Add more checkboxes as needed -->
        <button type="submit">Submit</button>
      </form>
      <form action="{{ route('user.form.store', ['kode-akses' => '0qAt+1']) }}" method="POST">
        @csrf
        <button type="submit">Submit</button>
      </form>
    </div>
    <input type="text" list="test">
    <datalist id="test">
      @foreach($domisilis as $domisili)
      <option>{{ $domisili }}</option>
      @endforeach
    </datalist>

    <select id="sel" size="1">
      @foreach($domisilis as $domisili)
      <option value="{{ $domisili }}">{{ $domisili }}</option>
      @endforeach
    </select>



    <input type="range" min="1" max="6" value="1" step="0.1" id="myRange" list="dataList">
    <datalist id="dataList">
      <option value="1"></option>
      <option value="2"></option>
      <option value="3"></option>
      <option value="4"></option>
      <option value="5"></option>
      <option value="6"></option>
    </datalist>
    <p>Value: <span id="demo"></span></p>


    <!-- <button id="play">Play</button>

<input id="yearslider" class="" type="range" min="1" value="1" max="6" step="0.01" list="ticks">
<datalist id="ticks">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
</datalist>
<output id="rangevalue"></output> -->
    <!-- <canvas id="barChart" style="width:100%;max-width:500px;height:100%;max-height:500px"></canvas> -->
    <canvas id="pieChart" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
    <canvas id="radarChart" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
    <canvas id="horizontalBarChart" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
    <canvas id="myChart4" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
    <canvas id="progressBar" style="width:100%;max-width:600px;height:100%;max-height:100px"></canvas>
    <canvas id="progressBar1" style="width:100%;max-width:600px;height:100%;max-height:100px"></canvas>

    <progress id="bar" value="10" max="100" class="ml-2"></progress>

    <input type="radio" name="radio1 2" id="">
    <input type="radio" name="radio1 2" id="">
    <input type="radio" name="2" id="">

<div class="question">
    <div class="left-group">
        <input type="checkbox" name="left1" value="1">
        <input type="checkbox" name="left2" value="2">
        <input type="checkbox" name="left3" value="3">
        <input type="checkbox" name="left4" value="4">
    </div>
    <div class="right-group">
        <input type="checkbox" name="right1" value="1">
        <input type="checkbox" name="right2" value="2">
        <input type="checkbox" name="right3" value="3">
        <input type="checkbox" name="right4" value="4">
    </div>
</div>
  </x-app-layout>

  <div class="mt-8 md:mt-12 mx-auto w-[90%] md:w-[80%] lg:w-[60%] h-fit border-2 rounded-[15px] lg:rounded-[50px] bg-[#FFFFFF]">
    <h1 class="mt-10 mb-6 w-max block mx-auto text-center rounded-full border-2 border-slate-500 py-3 px-5">
      1
    </h1>
    <div class="ml-3 mr-3">
      <h1 class="w-fit mx-auto block text-center text-lg sm:text-xl mb-2 md:mb-4">
        pertanyaan
      </h1>
    </div>
    <div class="flex w-fit mx-auto">
      <i class="fa fa-frown-o" style="font-size:48px;color:red"></i>
      <div class="container relative w-fit h-fit my-auto mx-8">
        <input id="yearslider" class="h-fit my-auto bg-gradient-to-r from-red-500 to-green-500 jarak" type="range" min="1" value="1" max="6" step="0.001" list="ticks">
        <datalist id="ticks">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
        </datalist>
        <output id="rangevalue" class="bubble hidden"></output>
      </div>
      <i class="fa fa-smile-o" style="font-size:48px;color:green"></i>
    </div>


    <div class="container flex w-fit mx-auto">
      <h1 id="labelSlider1" class="mt-2 mb-6 w-fit block mx-5 text-center rounded-full border-2 border-slate-500 text-slate-500 py-3 px-5">
        1
      </h1>
      <h1 id="labelSlider2" class="mt-2 mb-6 w-fit block mx-5 text-center rounded-full border-2 border-slate-500 text-slate-500 py-3 px-5">
        2
      </h1>
      <h1 id="labelSlider3" class="mt-2 mb-6 w-fit block mx-5 text-center rounded-full border-2 border-slate-500 text-slate-500 py-3 px-5">
        3
      </h1>
      <h1 id="labelSlider4" class="mt-2 mb-6 w-fit block mx-5 text-center rounded-full border-2 border-slate-500 text-slate-500 py-3 px-5">
        4
      </h1>
      <h1 id="labelSlider5" class="mt-2 mb-6 w-fit block mx-5 text-center rounded-full border-2 border-slate-500 text-slate-500 py-3 px-5">
        5
      </h1>
      <h1 id="labelSlider6" class="mt-2 mb-6 w-fit block mx-5 text-center rounded-full border-2 border-slate-500 text-slate-500 py-3 px-5">
        6
      </h1>
    </div>

    <div class="mb-12">

    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    
    // barChart rentangUsia
    // var xValues = ["<15", "15-20", "21-30", "31-40", "41-50", ">51"];
    // var yValues = [12, 49, 90, 51, 14, 20];
    // var barColors = "#8404F4";

    // new Chart("barChart", {
    //   type: "bar",
    //   data: {
    //     labels: xValues,
    //     datasets: [{
    //       backgroundColor: barColors,
    //       data: yValues,
    //       barThickness: 20,
    //       clip: {
    //         left: 5,
    //         top: 0,
    //         right: 10,
    //         bottom: 2,
    //       },
    //     }]
    //   },
    //   options: {
    //     legend: {
    //       display: false
    //     },
    //     title: {
    //       display: true,
    //       text: "Rentang Usia"
    //     },
    //     scales: {
    //       y: {
    //         suggestedMin: 0,
    //         suggestedMax: 100,
    //       }
    //     }
    //   }
    // });

    // pieChart

    var xValues = ["Laki", "Perempuan"];
    var yValues = [
      {{ $jeniskelaminData['laki'] }},
      {{ $jeniskelaminData['perempuan'] }}
    ];
    var barColors = [
      "#4C32EA",
      "#CC00CC",
    ];

    new Chart("pieChart", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
          text: "Jenis Kelamin"
        }
      }
    });

    // // radarChart
    // var inklusif = {
    //   {
    //     $penyebaranData['inklusif']
    //   }
    // };
    // var pelopor = {
    //   {
    //     $penyebaranData['pelopor']
    //   }
    // };
    // var tegas = {
    //   {
    //     $penyebaranData['tegas']
    //   }
    // };
    // var pemikir = {
    //   {
    //     $penyebaranData['pemikir']
    //   }
    // };
    // var rendahHati = {
    //   {
    //     $penyebaranData['rendahHati']
    //   }
    // };
    // var afirmasi = {
    //   {
    //     $penyebaranData['afirmasi']
    //   }
    // };
    // var penggerak = {
    //   {
    //     $penyebaranData['penggerak']
    //   }
    // };
    // var berwibawa = {
    //   {
    //     $penyebaranData['berwibawa']
    //   }
    // };

    // new Chart("radarChart", {
    //   type: "radar",
    //   data: {
    //     labels: [
    //       'Pelopor',
    //       'Tegas',
    //       'Pemikir',
    //       'Inklusif',
    //       'Rendah Hati',
    //       'Afirmasi',
    //       'Penggerak',
    //       'Berwibawa',
    //     ],
    //     datasets: [{
    //       backgroundColor: 'rgba(255, 99, 132, 0.2)',
    //       data: [pelopor, tegas, pemikir, inklusif, rendahHati, afirmasi, penggerak, berwibawa],
    //       barThickness: 20,
    //       clip: {
    //         left: 5,
    //         top: 0,
    //         right: 10,
    //         bottom: 2,
    //       },
    //     }]
    //   },
    //   options: {
    //     scales: {
    //       r: {
    //         beginAtZero: true,
    //         suggestedMax: 10
    //       }
    //     },
    //     plugins: {
    //       legend: {
    //         display: false
    //       }
    //     }
    //   }
    // });

    // // horizontalBarChart 
    // var myContext = document.getElementById("horizontalBarChart").getContext('2d');
    // var myChart = new Chart(myContext, {
    //   type: 'bar',
    //   data: {
    //     labels: ["bike", "car", "scooter", "truck"],
    //     datasets: [{
    //       label: 'worst',
    //       backgroundColor: "blue",
    //       data: [17, 16, 4, 1],
    //     }, {
    //       label: 'Okay',
    //       backgroundColor: "green",
    //       data: [4, 2, 10, 6],
    //     }, {
    //       label: 'bad',
    //       backgroundColor: "red",
    //       data: [2, 21, 3, 24],
    //     }],
    //   },
    //   options: {
    //     indexAxis: 'y',
    //     scales: {
    //       x: {
    //         stacked: true,
    //       },
    //       y: {
    //         stacked: true
    //       }
    //     },
    //     responsive: true
    //   }
    // });

    // //myChart4
    // var ctx = document.getElementById("myChart4").getContext('2d');
    // var myChart = new Chart(ctx, {
    //   type: 'bar',
    //   data: {
    //     labels: ["<  1", "1 - 2", "3 - 4", "5 - 9", "10 - 14", "15 - 19", "20 - 24", "25 - 29", "> - 29"],
    //     datasets: [{
    //       label: 'Employee',
    //       backgroundColor: "#caf270",
    //       data: [12, 59, 5, 56, 58, 12, 59, 87, 45],
    //     }, {
    //       label: 'Engineer',
    //       backgroundColor: "#45c490",
    //       data: [12, 59, 5, 56, 58, 12, 59, 85, 23],
    //     }, {
    //       label: 'Government',
    //       backgroundColor: "#008d93",
    //       data: [12, 59, 5, 56, 58, 12, 59, 65, 51],
    //     }, {
    //       label: 'Political parties',
    //       backgroundColor: "#2e5468",
    //       data: [12, 59, 5, 56, 58, 12, 59, 12, 74],
    //     }],
    //   },
    //   options: {
    //     scales: {
    //       x: {
    //         stacked: true,
    //         grid: {
    //           display: false
    //         }
    //       },
    //       y: {
    //         stacked: true,
    //         ticks: {
    //           beginAtZero: true,
    //         },
    //         grid: {
    //           display: false
    //         },
    //         type: 'linear',
    //       },
    //     },
    //     responsive: true,
    //     maintainAspectRatio: false,
    //     legend: {
    //       position: 'bottom'
    //     },
    //   }
    // });

    //progress Bar
    var progress2 = document.getElementById("progressBar").getContext('2d');
    let done = 26;
    let total = 234;
    let donePercent = done / total * 100;
    let totalPercent = (total - done) / total * 100;

    var myChart = new Chart(progress2, {
      type: 'bar',
      data: {
        labels: ["Progress"],
        datasets: [{
            label: 'Sudah Mengerjakan',
            backgroundColor: "blue",
            data: [donePercent],
          },
          {
            label: 'Belum Mengerjakan',
            backgroundColor: "green",
            data: [totalPercent],
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
        responsive: true
      }
    });

    // var progress1 = document.getElementById("progressBar1").getContext('2d');

    // var myChart = new Chart(progress1, {
    //   type: 'bar',
    //   data: {
    //     labels: ["Progress"],
    //     datasets: [{
    //         label: 'Sudah Mengerjakan',
    //         backgroundColor: "blue",
    //         data: [done],
    //       },
    //       {
    //         label: 'Belum Mengerjakan',
    //         backgroundColor: "green",
    //         data: [total],
    //       },
    //     ],
    //   },
    //   options: {
    //     border: {
    //       color: "red"
    //     },
    //     indexAxis: 'y',
    //     scales: {
    //       x: {
    //         stacked: true,
    //         grid: {
    //           display: false
    //         }
    //       },
    //       y: {
    //         stacked: true,
    //         grid: {
    //           display: false
    //         }
    //       }
    //     },
    //     responsive: true
    //   }
    // });


    var slider = document.getElementById("yearslider");
    var output = document.getElementById("rangevalue");
    output.innerHTML = slider.value;

    slider.oninput = function() {
      output.innerHTML = this.value;
      output.innerHTML = Math.round(output.innerHTML);

      const satu = document.getElementById("labelSlider1")
      const dua = document.getElementById("labelSlider2")
      const tiga = document.getElementById("labelSlider3")
      const empat = document.getElementById("labelSlider4")
      const lima = document.getElementById("labelSlider5")
      const enam = document.getElementById("labelSlider6")
      if (output.innerHTML == 1) {
        satu.classList.add('bg-red-600', 'border-slate-300', 'text-slate-300');
        satu.classList.remove('border-slate-500', 'text-slate-500');
      } else {
        satu.classList.remove('bg-red-600', 'border-slate-300', 'text-slate-300');
        satu.classList.add('border-slate-500', 'text-slate-500');
      }
      if (output.innerHTML == 2) {
        dua.classList.add('bg-red-600', 'border-slate-300', 'text-slate-300');
        dua.classList.remove('border-slate-500', 'text-slate-500');
      } else {
        dua.classList.remove('bg-red-600', 'border-slate-300', 'text-slate-300');
        dua.classList.add('border-slate-500', 'text-slate-500');
      }
      if (output.innerHTML == 3) {
        tiga.classList.add('bg-red-600', 'border-slate-300', 'text-slate-300');
        tiga.classList.remove('border-slate-500', 'text-slate-500');
      } else {
        tiga.classList.remove('bg-red-600', 'border-slate-300', 'text-slate-300');
        tiga.classList.add('border-slate-500', 'text-slate-500');
      }
      if (output.innerHTML == 4) {
        empat.classList.add('bg-green-600', 'border-slate-300', 'text-slate-300');
        empat.classList.remove('border-slate-500', 'text-slate-500');
      } else {
        empat.classList.remove('bg-green-600', 'border-slate-300', 'text-slate-300');
        empat.classList.add('border-slate-500', 'text-slate-500');
      }
      if (output.innerHTML == 5) {
        lima.classList.add('bg-green-600', 'border-slate-300', 'text-slate-300');
        lima.classList.remove('border-slate-500', 'text-slate-500');
      } else {
        lima.classList.remove('bg-green-600', 'border-slate-300', 'text-slate-300');
        lima.classList.add('border-slate-500', 'text-slate-500');
      }
      if (output.innerHTML == 6) {
        enam.classList.add('bg-green-600', 'border-slate-300', 'text-slate-300');
        enam.classList.remove('border-slate-500', 'text-slate-500');
      } else {
        enam.classList.remove('bg-green-600', 'border-slate-300', 'text-slate-300');
        enam.classList.add('border-slate-500', 'text-slate-500');
      }
    }


    // snapping position
    let years = [1, 2, 3, 4, 5, 6];

    function getClosest(arr, val) {
      return arr.reduce(function(prev, curr) {
        return (Math.abs(curr - val) < Math.abs(prev - val) ? curr : prev);
      });
    }

    document.querySelector("#yearslider").addEventListener("change", function() {
      let closest = getClosest(years, this.value);
      this.value = document.querySelector("#rangevalue").value = closest;
    });

    // const range = document.querySelector(".jarak");
    // const bubble = document.querySelector(".bubble");
    // range.addEventListener("input", () => {
    //   setBubble(range, bubble);
    // });
    // setBubble(range, bubble);

    // function setBubble(range, bubble) {
    //   const val = range.value;
    //   const min = range.min ? range.min : 0;
    //   const max = range.max ? range.max : 100;
    //   const newVal = Number(((val - min) * 100) / (max - min));
    //   bubble.innerHTML = Math.round(val);

    //   // Sorta magic numbers based on size of the native UI thumb
    //   bubble.style.left = `calc(${newVal}% + (${8 - newVal * 0.15}px))`;
    // }



    $(document).ready(function() {
      $('.single-checkbox').on('change', function() {
        $('.single-checkbox').not(this).prop('checked', false);
      });
    });

    $(document).ready(function() {
      $('.single-checkbox1').on('change', function() {
        $('.single-checkbox1').not(this).prop('checked', false);
      });
    });

    $(document).ready(function() {
      $('.check1').on('change', function() {
        $('.check1').not(this).prop('checked', false);
      });
    });
    $(document).ready(function() {
      $('.check2').on('change', function() {
        $('.check2').not(this).prop('checked', false);
      });
    });
    $(document).ready(function() {
      $('.check3').on('change', function() {
        $('.check3').not(this).prop('checked', false);
      });
    });
    $(document).ready(function() {
      $('.check4').on('change', function() {
        $('.check4').not(this).prop('checked', false);
      });
    });
    $(document).ready(function() {
      $('.check5').on('change', function() {
        $('.check5').not(this).prop('checked', false);
      });
    });

    // document.getElementById('sel').addEventListener('click', onClickHandler);
    // document.getElementById('sel').addEventListener('mousedown', onMouseDownHandler);

    // function onMouseDownHandler(e) {
    //   var el = e.currentTarget;

    //   if (el.hasAttribute('size') && el.getAttribute('size') == '1') {
    //     e.preventDefault();
    //   }
    // }

    // function onClickHandler(e) {
    //   var el = e.currentTarget;

    //   if (el.getAttribute('size') == '1') {
    //     el.className += " selectOpen";
    //     el.setAttribute('size', '3');
    //   } else {
    //     el.className = '';
    //     el.setAttribute('size', '1');
    //   }
    // }
  </script>