 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<script>
    $(document).ready(function() {
        $('#domisili').select2();
    });
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }

</script>
<style type="">
html{
    scroll-behavior: smooth;
}

#overlay, #overlay1, #kodeAkses, #confirm-element, #buatEvent {
  position: fixed;
  display: none;
}

.navbar-fixed{
    backdrop-filter: blur(5px);
    box-shadow: inset 0 -1px 0 0 rgba(0, 0, 0, 0.1);
}

.navbar-fixed:target{
    top: 0;
    right: 4;
}

h1{
    font-family: 'Montserrat', 'sans';
    color: black;
}

.slider {
      -webkit-appearance: none;
      width: 500px;
      outline: none;
      display: flex;
      border-radius: 9999px;
}
.slider::-webkit-slider-thumb{
      -webkit-appearance: none;
      appearance: none;
      width: 30px;
      height: 30px;
      border-radius: 9999px;
      background: #8404F4;
      cursor: pointer;
      transform: translateY(-18%);
}


</style>