<div style="display:flex;">

<form action="{{ route('admin.showStudent',$_id) }}" method="GET" style="padding:2px"> 
  <button class="btn btn-dark btn-fab btn-icon btn-round"><i class="ti-eye" title="View"></i></button>
</form>

<!-- <form action="{{ route('teachers.destroy',$_id) }}" method="POST" style="padding:2px">
        @csrf
        @method('DELETE')
  <button class="btn btn-danger btn-fab btn-icon btn-round"><i class="ti-trash" data-toggle="tooltip" title="Delete"></i></button>
</form> -->

</div>
