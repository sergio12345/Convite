@props([
'title',
'links',
'scripts',

'event_name',
'description',
'url',
'image'
])

<!DOCTYPE html>
<html prefix="og: https://ogp.me/ns#">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MaisConvite | {{ $title }}</title>
  @if(isset($event_name) && isset($url))
    <meta property="og:title" content="{{ $event_name }}" />
    <meta property="og:type" content="image/jpeg" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:image" content="{{ $image }}" />
    <meta property="og:image:secure_url" content="{{ $image }}" />
  @endif
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  @if($isTouch = isset($links))
  {{ $links }}
  @endif
</head>

<body class="antialiased md:bg-primary-100">

  {{ $slot }}



  <div id="toast-holder"></div>

  <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    // Show/Hide menu components
    function menuOpen(id) {
      var element = document.querySelector(id)
      console.log(element)

      element.classList.add("left-0");
      element.classList.remove("-left-full");
    }

    function menuClose(id) {
      var element = document.querySelector(id)
      element.classList.remove("left-0");
      element.classList.add("-left-full");
    }
  </script>

  <!-- Copy to Clipboard -->
  <script>
    var toast = `<div id="copySuccess" class="z-50 pointer-events-none fixed bottom-20 right-12 flex items-center p-4 space-x-3 w-full max-w-xs text-green-500 bg-white rounded-xl shadow shadow-primary-300 role="alert">
                      <button class="bg-green-100 h-10 w-10 rounded-xl text-center">
                        <svg aria-hidden="true" class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </button>
                      <div class="pl3 text-xs font-bold text-dark-700">Copiado!</div>
                  </div>`;

    function copyToClipboard() {
      var text = document.getElementById('copyText').value;
      if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {}, (err) => {});
      } else if (window.clipboardData) {
        window.clipboardData.setData("Text", text);
      }
      document.getElementById('toast-holder').innerHTML += toast;
      setTimeout(() => {
        var elem = document.querySelector('#copySuccess');
        elem.parentNode.removeChild(elem);
      }, 2000);
    }
  </script>


  @if($isTouch = isset($scripts))
  {{ $scripts }}
  @endif

</body>

</html>