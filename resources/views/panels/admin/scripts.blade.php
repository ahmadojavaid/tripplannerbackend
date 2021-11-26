{{-- Vendor Scripts --}}
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

@stack('vendor-script')
{{-- Theme Scripts --}}
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/components.js')) }}"></script>
{{-- <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script> --}}

{{-- Custom Script --}}
<script src="{{ asset(mix('js/custom/custom.js')) }}"></script>


@if($configData['blankPage'] == false)
<script src="{{ asset(mix('js/scripts/footer.js')) }}"></script>
@endif

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
@php
$user = Auth::guard('admin')->user();
$userId = $user ? $user->id:-1;

@endphp
{{-- page script --}}
{{-- <div class="hanlde-session-messages"></div> --}}
<script>
  (function(){
    // Don't go any further down the script if [data-notification] is not set.
    if ( ! document.body.dataset.notification)
        return false;

    var type = document.body.dataset.notificationType;
    switch(type){
        case 'info':
            toastr.info(JSON.parse(document.body.dataset.notificationMessage));
            break;

        case 'warning':
            toastr.warning(JSON.parse(document.body.dataset.notificationMessage));
            break;

        case 'success':
            toastr.success(JSON.parse(document.body.dataset.notificationMessage));
            break;

        case 'error':
            toastr.error(JSON.parse(document.body.dataset.notificationMessage));
            break;
    }
})();




  Pusher.logToConsole = true;

  var pusher = new Pusher('c31bb65cb1c9997462f7', {
    cluster: 'ap2',
    auth: {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }
  });
  var blogAdmin = pusher.subscribe('private-blog-admin');

  blogAdmin.bind('created', function(data) {
    toastr.info( "Blog Article Created",'Blog Article', { "closeButton": true });
  });

  blogAdmin.bind('updated', function(data) {

    toastr.info( "Blog Article Updated",'Blog Article', { "closeButton": true });
  });

  var blogUser= pusher.subscribe('private-blog-user');
  blogUser.bind('status', function(data) {

    if("{{$userId}}" == "{{$userId}}")
    {
    toastr.info( "Blog Article Updated",'Blog Article', { "closeButton": true });
    }
  });



  $(function() {
    let url = $(location).attr('href');
    const localStorage = window.localStorage;
    const activeTab = localStorage.getItem('activeTab');
    const pageUrl = localStorage.getItem('pageUrl');


    if (url.match('#')) {
      $('.nav.nav-pills a[href="#' + url.split('#')[1] + '"]').tab('show');
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
      $('.nav.nav-pills a[href="' + activeTab + '"]').trigger('click');
    }
  });
</script>
@stack('page-script')
