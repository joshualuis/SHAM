<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Strand</title>
</head>
<body>
   
<style>
table, th, td {
  border:1px solid black;
}
</style>
   <a href="strands/create" class="btn btn-primary">Add Strand</a>
<table>
    <thead>
      <th>Strand</th>
      <th>Description</th>

      <th>Action</th> 
   </thead>
   <tbody>
    @foreach($strands as $strand)
   <tr>
      <td>{{$strand -> name}}</td>
      <td>{{$strand -> description}}</td>



         <td align="center">
         <a href="/strands/{{$strand->_id}}/edit">
         <button><i class="" style="font-size:15px; color:red" ></i>Edit</button></td></a></td>
         <td align="center">
         {!! Form::open(array('route' => array('strands.destroy', $strand->_id),'method'=>'DELETE')) !!}
         <button><i class="" style="font-size:15px; color:red" ></i>Delete</button></td></a></td>
         {!! Form::close() !!} 
   </tr>
   @endforeach
   </tbody>
</table>


</body>
</html>