<div style="display:flex;">

<form action="{{ route('teachers.show',$_id) }}" method="GET" style="padding:2px"> 
  <button class="btn btn-dark btn-fab btn-icon btn-round"><i class="ti-eye" title="View"></i></button>
</form>

<form action="{{ route('teachers.edit',$_id) }}" method="GET" style="padding:2px">
        @csrf
        @method('GET')
  <button class="btn btn-primary btn-fab btn-icon btn-round"><i class="ti-pencil-alt" data-toggle="tooltip" title="Edit"></i></button>
</form>

<form id="removeForm" action="{{ route('teachers.destroy',$_id) }}" method="POST" style="padding:2px">
        @csrf
        @method('DELETE')
  <button type="submit" class="btn btn-danger btn-fab btn-icon btn-round"><i class="ti-trash" data-toggle="tooltip" title="Delete"></i></button>
</form>


<script>
  function confirmAndSubmitForm() {
    swal({
      title: 'Remove a Teacher Record',
      text: 'Are you sure you want to remove this teacher? This action cannot be undone!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: "btn btn-danger btn-fill",
      confirmButtonText: 'Yes, remove it!',
      cancelButtonClass: "btn btn-default btn-fill",
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        document.getElementById('removeForm').submit();
        swal({
            title: 'Successfully Deleted',
            text: 'This record is successfully deleted!',
            type: 'success',
            confirmButtonClass: "btn btn-success btn-fill",
            buttonsStyling: false
            })
      }
      else {
        swal({
        title: 'Cancelled!',
        text: 'No changes made.',
        type: 'error',
        confirmButtonClass: "btn btn-danger btn-fill",
        buttonsStyling: false
        })
      }
    });
  }
</script>

</div>
