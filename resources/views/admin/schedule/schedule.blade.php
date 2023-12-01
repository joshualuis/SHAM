<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SECTION</title>
</head>
<body>
   
<style>
table, th, td {
  border:1px solid black;
}
</style>
   <a href="sections/create" class="btn btn-primary">Add Section</a>
<table>
    <thead>
      <th>Section Name</th>
      <th>Room</th>
      <th>Strand</th>
      <th>Advisor</th>
      <th>Action</th> 
   </thead>
   <tbody>
    @foreach($sections as $section)
   <tr>
      <td>{{$section -> name}}</td>
      <td>{{$section -> room}}</td>
      @if(empty($section->strand))
         <td>TBD</td>
      @else
         <td>{{$section -> strand -> name}}</td>
      @endif
      
      @if(empty($section->teacher))
         <td>TBD</td>
      @else
         <td>{{$section -> teacher -> lname}}</td>
      @endif

      <td align="center">
         <a href="/subject/{{$section->_id}}/edit">
         <button><i class="" style="font-size:15px; color:red" ></i>Sched</button></a>


         <a href="/sections/{{$section->_id}}/edit">
         <button><i class="" style="font-size:15px; color:red" ></i>Edit</button></a>

         {!! Form::open(array('route' => array('sections.destroy', $section->_id),'method'=>'DELETE')) !!}
         <button><i class="" style="font-size:15px; color:red" ></i>Delete</button></a>
         {!! Form::close() !!} 
      </td>
   </tr>
   @endforeach
   </tbody>
</table>


</body>
</html>