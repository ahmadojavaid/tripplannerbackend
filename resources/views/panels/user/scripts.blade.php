<script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
<script src="{{asset('leaflet/leaflet.polylineDecorator.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="{{ asset('user/js/themeJs.js') }}"></script>

<script>
  $(function() {
    let url = $(location).attr('href');
    const localStorage = window.localStorage;
    const activeTab = localStorage.getItem('activeTab');
    const pageUrl = localStorage.getItem('pageUrl');


    if (url.match('#')) {
      $('.nav.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
      localStorage.setItem('pageUrl', url.split('#')[0]);
      localStorage.setItem('activeTab', '#'+url.split('#')[1]);
      window.location.href= url.split('#')[0];
    }

    $('a.nav-link').on('click', function(e) {

      if(url != pageUrl){
        localStorage.removeItem("activeTab");
        localStorage.removeItem("pageUrl");
      }
      localStorage.setItem('activeTab', $(e.target).attr('href'));
      localStorage.setItem('pageUrl', url);
    });
    if (activeTab) {

      $('.nav.nav-tabs a[href="' + activeTab + '"]').trigger('click');
    }
  });
</script>


@stack('page-script')
