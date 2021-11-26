<div class="user-permission">
  <h5 class="mb-3">Permission List</h5>

  <ul id="tree" class="m-0 p-0 list-unstyled">
    <li>
      {{-- {{Form::fieldCheckbox('permission[]',"all",false,"All User Permissions")}} --}}

      <ul class="list-unstyled">
        @foreach ($permissionArr as $value=>$label)

        @endforeach
        <li>
          {{Form::fieldCheckbox('permissions[]',$value,null,$label)}}
        </li>
      </ul>
    </li>
  </ul>

</div>

<div class="admin-permission">
  <p class="mb-0"><em>There are no additional permissions to choose from for this role.</em></p>
</div>

@push('page-script')
<script>
  $('document').ready(function(){
      handlePermissionSection();
      function handlePermissionSection(){
          const value = $('.user-role').val();
          if(value == 1 || value == 3)
          {
            $('.admin-permission').addClass('d-block').removeClass('d-none');
            $('.user-permission').removeClass('d-block').addClass('d-none');
          }else if(value==2){
            $('.user-permission').addClass('d-block').removeClass('d-none');
            $('.admin-permission').removeClass('d-block').addClass('d-none');
          }
          else {
            $('.admin-permission, .user-permission').addClass('d-none').removeClass('d-block');
          }
      }
      $(document).on('change', '.user-role' , handlePermissionSection);
    });
</script>
@endpush
