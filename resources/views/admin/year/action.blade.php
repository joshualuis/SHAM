<div style="display:flex;">

<form action="{{ route('years.edit',$_id) }}" method="GET" style="padding:2px">
        @csrf
        @method('GET')
  <button class="btn btn-primary btn-fab btn-icon btn-round"><i class="ti-pencil-alt" data-toggle="tooltip" title="Edit"></i></button>
</form>

<!-- <form action="{{ route('teachers.destroy',$_id) }}" method="POST" style="padding:2px">
        @csrf
        @method('DELETE')
  <button class="btn btn-danger btn-fab btn-icon btn-round"><i class="ti-trash" data-toggle="tooltip" title="Delete"></i></button>
</form> -->

</div>
