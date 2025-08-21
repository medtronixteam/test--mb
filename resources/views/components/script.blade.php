  <!-- General JS Scripts -->
  <script src="{{ url('assets/modules/jquery.min.js')}}"></script>
  <script src="{{ url('assets/modules/popper.js')}}"></script>
  <script src="{{ url('assets/modules/tooltip.js')}}"></script>
  <script src="{{ url('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ url('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ url('assets/modules/moment.min.js')}}"></script>
  <script src="{{ url('assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{ url('assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{ url('assets/modules/chart.min.js')}}"></script>
  <script src="{{ url('assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{ url('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{ url('assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{ url('assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
  <script src="{{ url('assets/modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ url('assets/modules/izitoast/js/iziToast.min.js')}}"></script>

  <!-- Page Specific JS File -->
 @if (request()->routeIs('dashboard'))
     <script src="{{ url('assets/js/page/index-0.js')}}"></script>
 @endif

  <!-- Template JS File -->
  <script src="{{ url('assets/js/scripts.js')}}"></script>
  <script src="{{ url('assets/js/custom.js')}}"></script>


