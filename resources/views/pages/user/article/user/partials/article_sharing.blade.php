<div class="social-links social-sharing a2a_kit a2a_kit_size_32">
  <ul class=" link-list social-links inline-listing blog-social-list">
    <li>
      <a class="twitter a2a_button_twitter" href="">
        <i class="fa fa-twitter"></i>
      </a>
    </li>
    <li>
      <a class="linkedin a2a_button_linkedin" href="">
        <i class="fa fa-linkedin"></i>
      </a>
    </li>
    <li>
      <a class="facebook a2a_button_facebook" href="">
        <i class="fa fa-facebook"></i>
      </a>
    </li>
    <li>
      @php
      $icon = "fa fa-bookmark-o";
      $class ="display-login";

      if(!Auth::guest())
      {
      if($article->pinned)
      $icon = "fa fa-bookmark";
      $class = "handle-bookmark";
      }
      @endphp
      <a href="javascipt:void(0)" data-id="{{$article->id}}" class="{{$class}}">
        <i class="{{$icon}}" aria-hidden="true"></i></a>
    </li>
  </ul>
</div>
@push('page-script')
<script async src="https://static.addtoany.com/menu/page.js"></script>
<script>
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function handleBookmark(self){
      $.ajax({
        type:'POST',
        url: "{{route('user.pinned.handle')}}",
        data:{
          id : self.attr('data-id')
        },
        success:function(data){
          if(data==="pinned")
            self.find('i.fa').attr('class' , 'fa fa-bookmark');
          else
            self.find('i.fa').attr('class' , 'fa fa-bookmark-o');
        }
      });
    }

    $(document).on('click' , '.display-login',function(){
      $('#login-modal').modal('show');
    });

    $(document).on('click' , '.handle-bookmark',function(){
      handleBookmark($(this));
    });
  })
</script>
@endpush
