<div style="display:flex;">

<form action="/admin/users/{{$_id}}" method="GET" style="padding:2px">
        @csrf
        @method('GET')
    
        @if($status == 'enable')
            <button class="btn btn-danger">Disable</button>
        @endif

        @if($status == 'disable')
            <button class="btn btn-success">Enable</button>
        @endif
  
</form>

<form action="/admin/users/edit/{{$_id}}" method="GET" style="padding:2px">
        @csrf
        <button class="btn btn-primary">Edit</button>
</form>

</div>
