
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Login Manajemen Kue</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="./favicon.ico">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="{{asset('vendor/bootstrap-icons/font/bootstrap-icons.css')}}">

  <!-- CSS Front Template -->

  <link rel="preload" href="{{asset('css/theme.min.css')}}" data-hs-appearance="default" as="style">
  <link rel="preload" href="{{asset('css/theme-dark.min.css')}}" data-hs-appearance="dark" as="style">

  <style data-hs-appearance-onload-styles>
    *
    {
      transition: unset !important;
    }

    body
    {
      opacity: 0;
    }
  </style>

  <script>
                       window.hs_config = {"autopath":"@@autopath","deleteLine":"hs-builder:delete","deleteLine:build":"hs-builder:build-delete","deleteLine:dist":"hs-builder:dist-delete","previewMode":false,"startPath":"/index.html","vars":{"themeFont":"https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap","version":"?v=1.0"},"layoutBuilder":{"extend":{"switcherSupport":true},"header":{"layoutMode":"default","containerMode":"container-fluid"},"sidebarLayout":"default"},"themeAppearance":{"layoutSkin":"default","sidebarSkin":"default","styles":{"colors":{"primary":"#377dff","transparent":"transparent","white":"#fff","dark":"132144","gray":{"100":"#f9fafc","900":"#1e2022"}},"font":"Inter"}},"languageDirection":{"lang":"en"},"skipFilesFromBundle":{"dist":["{{asset('js/hs.theme-appearance.js')}}","{{asset('js/hs.theme-appearance-charts.js')}}","{{asset('js/demo.js')}}"],"build":["{{asset('css/theme.css')}}","{{asset('vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js')}}","{{asset('js/demo.js')}}","{{asset('css/theme-dark.css')}}","{{asset('css/docs.css')}}","{{asset('vendor/icon-set/style.css')}}","{{asset('js/hs.theme-appearance.js')}}","{{asset('js/hs.theme-appearance-charts.js')}}","node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js')}}","{{asset('js/demo.js')}}"]},"minifyCSSFiles":["{{asset('css/theme.css')}}","{{asset('css/theme-dark.css')}}"],"copyDependencies":{"dist":{"*{{asset('js/theme-custom.js')}}":""},"build":{"*{{asset('js/theme-custom.js')}}":"","node_modules/bootstrap-icons/font/*fonts/**":"css"}},"buildFolder":"","replacePathsToCDN":{},"directoryNames":{"src":"./src","dist":"./dist","build":"./build"},"fileNames":{"dist":{"js":"theme.min.js","css":"theme.min.css"},"build":{"css":"theme.min.css","js":"theme.min.js","vendorCSS":"vendor.min.css","vendorJS":"vendor.min.js"}},"fileTypes":"jpg|png|svg|mp4|webm|ogv|json"}
 window.hs_config.gulpRGBA = (p1) => {
  const options = p1.split(',')
  const hex = options[0].toString()
  const transparent = options[1].toString()

  var c;
  if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
    c= hex.substring(1).split('');
    if(c.length== 3){
      c= [c[0], c[0], c[1], c[1], c[2], c[2]];
    }
    c= '0x'+c.join('');
    return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',' + transparent + ')';
  }
  throw new Error('Bad Hex');
}
            window.hs_config.gulpDarken = (p1) => {
  const options = p1.split(',')

  let col = options[0].toString()
  let amt = -parseInt(options[1])
  var usePound = false

  if (col[0] == "#") {
    col = col.slice(1)
    usePound = true
  }
  var num = parseInt(col, 16)
  var r = (num >> 16) + amt
  if (r > 255) {
    r = 255
  } else if (r < 0) {
    r = 0
  }
  var b = ((num >> 8) & 0x00FF) + amt
  if (b > 255) {
    b = 255
  } else if (b < 0) {
    b = 0
  }
  var g = (num & 0x0000FF) + amt
  if (g > 255) {
    g = 255
  } else if (g < 0) {
    g = 0
  }
  return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
}
            window.hs_config.gulpLighten = (p1) => {
  const options = p1.split(',')

  let col = options[0].toString()
  let amt = parseInt(options[1])
  var usePound = false

  if (col[0] == "#") {
    col = col.slice(1)
    usePound = true
  }
  var num = parseInt(col, 16)
  var r = (num >> 16) + amt
  if (r > 255) {
    r = 255
  } else if (r < 0) {
    r = 0
  }
  var b = ((num >> 8) & 0x00FF) + amt
  if (b > 255) {
    b = 255
  } else if (b < 0) {
    b = 0
  }
  var g = (num & 0x0000FF) + amt
  if (g > 255) {
    g = 255
  } else if (g < 0) {
    g = 0
  }
  return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
}
            </script>
</head>

<body>

  <script src="{{asset('js/hs.theme-appearance.js')}}"></script>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">
    <div class="position-fixed top-0 end-0 start-0 bg-img-start" style="height: 32rem; background-image: url({{asset('svg/components/card-6.svg')}});">
      <!-- Shape -->
      <div class="shape shape-bottom zi-1">
        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
          <polygon fill="#fff" points="0,273 1921,273 1921,0 " />
        </svg>
      </div>
      <!-- End Shape -->
    </div>

    <!-- Content -->
    <div class="container py-5 py-sm-7">
        <br><br><br><br><br><br>
        <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
          <div class="card-body">
            <!-- Form -->
            <form action="{{route('users.signup')}}" method="POST">
                @csrf
             <!-- Input Group -->
<div class="mb-3">
  <label for="inputGroupMergeFullName" class="form-label">Nama</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeFullNameAddOn">
      <i class="bi-person"></i>
    </div>
    <input name="name" type="text" class="form-control" id="inputGroupMergeFullName" placeholder="Masukan username" aria-label="Masukan username" aria-describedby="inputGroupMergeFullNameAddOn">
  </div>
</div>
<!-- End Input Group -->

<!-- Input Group -->
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Username (Email)</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-envelope-open"></i>
    </div>
    <input name="email" type="email" class="form-control" id="" placeholder="farhan@example.com" aria-label="farhan@example.com" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
<!-- End Input Group -->

<!-- Input Group -->
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Password</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-lock"></i>
    </div>
    <input name="password" type="password" class="form-control" id="" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">No Telepon</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-phone"></i>
    </div>
    <input type="text" name="no_telepon" class="form-control" id="" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Kode Sales</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-archive"></i>
    </div>
    <input type="text" class="form-control" id="" name="kode_gudang" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Koordinator Sales</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-archive"></i>
    </div>
    <select name="c" id="" class="form-select">
        @foreach($use as $us)
            <option value="{{$us->id}}">{{$us->name}}</option>
        @endforeach
    </select>
</div>
</div>
            <button type="submit" class="btn btn-outline-primary">Submit</button>
</form>            
            <!-- End Form -->
          </div>
        </div>
        <!-- End Card -->

        <!-- Footer -->
        </div>
        <!-- End Footer -->
      </div>
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- JS Global Compulsory  -->
  <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

  <!-- JS Implementing Plugins -->
  <script src="{{asset('vendor/hs-toggle-password/dist/js/hs-toggle-password.js')}}"></script>

  <!-- JS Front -->
  <script src="{{asset('js/theme.min.js')}}"></script>

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      window.onload = function () {
        // INITIALIZATION OF BOOTSTRAP VALIDATION
        // =======================================================
  


        // INITIALIZATION OF TOGGLE PASSWORD
        // =======================================================
        new HSTogglePassword('.js-toggle-password')
      }
    })()
  </script>
</body>
</html>