<div class="modal fade" id="forgot-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
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
                <span>Please check yours register</span> <span class="lead-text">Email</span>
              </h3>
            </div>
          </div>

          <div class="alert alert-success d-none" id="reset-password-confirmation">

          </div>
          <form method="POST" action="{{ route('user.auth.forgot') }}" class="mb-5 py-5">
            @csrf
            <div class="row">
              <div class="col">
                <div class="input-wrapper">
                  <input type="email" id="email" name="email" required>
                  <label for="email">Email</label>
                </div>
                <div class=" text-center">
                  <button type="submit" class="login-btn btn-primary btn mb-lg-0 handle-forgot-password" href="#">Send
                    Email</button>
                </div>
              </div>
            </div>
          </form>
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

    $(document).on('click' ,'.handle-forgot-password' , function(e){
      e.preventDefault();
      const form = $(this).closest('form');
      $.ajax({
        type: "post",
        dataType: "json",
        url:form.attr('action'),
        data:form.serialize(),
        success:function(data){
          form.find('span.error').remove();
          if(data)
          $('#reset-password-confirmation').toggleClass('d-none').html(data.message)
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
