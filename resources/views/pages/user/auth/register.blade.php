<!-- Modal -->
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog login-modal" role="document">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-12 mb-5">
              <h3>
                <span>Save your trip:</span>
                <span class="lead-text">Travel name</span>
              </h3>
              <p>
                If you want to proceed your trip anytime, you need to create
                a profile
              </p>
            </div>
          </div>
          <div class="row vertical-divider">
            <div class="col-lg-6">
              <div class="text-center mb-3">
                <a href="{{route('user.auth.facebook.redirect')}}" class="btn btn-linkedIn">
                  <i class="fa fa-facebook mr-2"></i> Sign up with Facebook
                </a>
                <a href="{{route('user.auth.google.redirect')}}" class="btn btn-google">
                  <i class="fa fa-google mr-2"></i> Sign up with Google
                </a>
              </div>
              <p class="border-bottom pb-3 mb-3">
                By signing up you indicate that you agree with
                <a class="lead-text">privacy policy</a>
              </p>
              <p class="mb-5 mb-lg-2">
                Already have an account <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal"
                  data-target="#login-modal">login</a>
              </p>
            </div>
            <div class="col-lg-6">
              <form method="POST" action="{{ route('user.auth.register') }}">
                @csrf
                <div class="input-wrapper">
                  <input type="email" id="email" name="email" required />
                  <label for="email">Email</label>
                </div>
                <div class="input-wrapper">
                  <input type="text" id="user" required name="first_name" />
                  <label for="user">First Name</label>
                </div>
                <div class="input-wrapper">
                  <input type="text" id="user" required name="last_name" />
                  <label for="user">Last Name</label>
                </div>
                <div class="input-wrapper">
                  <input type="text" id="user" required name="phone_no" />
                  <label for="user">Phone Number</label>
                </div>
                <div class="input-wrapper">
                  <input type="password" class="pwd" name="password" required />
                  <label for="user">Password</label>
                  <span style="cursor: pointer;" class="password-show reveal">
                    <img src="images/eye.png" alt="" />
                  </span>
                </div>
                <div class="text-center">
                  <button type="submit" class="login-btn btn-primary btn mb-lg-0 handle-register" href="#">
                    Sign up with email
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('page-script')
<script>
  $(document).ready(function(){


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $(document).on('click' ,'.handle-register' , function(e){
      e.preventDefault();
      const form = $(this).closest('form');
      $.ajax({
        type: "post",
        dataType: "json",
        url:form.attr('action'),
        data:form.serialize(),
        success:function(data){
          location.reload();
        },
        error:function({status, responseJSON}){
          form.find('span.error').remove();

          if(status===422)
          {
            $.each(responseJSON, function (i, error) {
              var el = form.find('[name="'+i+'"]');
              el.after($('<span class="error text-danger">'+error[0]+'</span>'));
            });
          }
        }
      });
    })
  });
</script>
@endpush
