<div style="display:flex;">
  <form action="/admin/applicant/schedule/edit/{{$_id}}" method="GET" style="padding:2px">
    @csrf
    <button class="btn btn-primary">Edit</button>
  </form>

  <form id="removeForm" action="/admin/applicant/emailed/remove/{{$_id}}" method="GET" style="padding:2px">
    @csrf
    <button type="submit" class="btn btn-danger">Remove</button>
  </form>

<script>
  function confirmAndSubmitForm() {
    swal({
      title: 'Remove from Emailed Applicants',
      text: 'This action cannot be undone! You might need to schedule another interview for this applicant if you want to interview him/her.',
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
            title: 'Successfully Removed',
            text: 'This record is successfully removed!',
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