@extends('templates.default')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-12"></div>

<div>
  <p> progress {{ var_dump($progress) }}</p>
  <p> kelamin {{ var_dump($kelamin) }}</p>
  <p>{{ var_dump($usia) }}</p>
  <p>{{ var_dump($pendidikan) }}</p>
  <p>{{ var_dump($domisili) }}</p>
  <p>{{ var_dump($penyebaran8D) }}</p>
</div>

<label class="relative inline-flex items-center mr-5 cursor-pointer">
  <input id="holdSwitch" type="checkbox" class="sr-only peer">
  <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
  <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Purple</span>
</label>

<!-- progress kelamin usia pendidikan domisili penyebaran8D -->

<!-- Penyebaran 8D -->
<canvas id="radarChart" style="width:100%;max-width:600px;height:100%;max-height:500px" class="border-2"></canvas>

<!-- Jenis Kelamin -->
<canvas id="pieChart" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>

<script>
  const holdSwitch = document.getElementById('holdSwitch');
  const holdRoute = "{{ route('update.event.on-hold', ['event' => $event]) }}";

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
        alert(data['on-hold']);
        if (data['on-hold'] == 1) {
          alert('Hasil jawaban event ini ditahan');
        } else if (data['on-hold'] == 0){
          alert('Hasil jawaban event ini dibuka');
        } else {
          throw new Error('Response tidak dikenali : ' + data);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('error:' + error);
      });
  });

  // radarChart

  var dimensionData = @json($penyebaran8D);

  new Chart("radarChart", {
    type: "radar",
    data: {
      labels: [
        'Pelopor',
        'Penggerak',
        'Afirmasi',
        'Inklusif',
        'Rendah Hati',
        'Pemikir',
        'Tegas',
        'Berwibawa',
      ],
      datasets: [{
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        data: dimensionData,
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
      scales: {
        r: {
          beginAtZero: true,
          // suggestedMax : 10
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  var xValues = ["Laki", "Perempuan"];
  var yValues = @json($kelamin);
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
</script>

@endsection