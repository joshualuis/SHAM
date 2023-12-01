<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Announcement</title>
</head>
<body>
   
<style>
table, th, td {
  border:1px solid black;
}
</style>
   <a href="announcements/create" class="btn btn-primary">Add Announcement</a>
<table>
    <thead>
      <th>Announcement</th>
      <th>Date</th>

      <th>Action</th> 
   </thead>
   <tbody>
    @foreach($announcements as $announcement)
   <tr>
        <td>{{$announcement -> announcement}}</td>
        <td>{{$announcement -> date}}</td>

         <td align="center">
         <a href="/api/announcements/{{$announcement->_id}}/edit">
         <button><i class="" style="font-size:15px; color:red" ></i>Edit</button></td></a></td>
         <td align="center">
         {!! Form::open(array('route' => array('announcements.destroy', $announcement->_id),'method'=>'DELETE')) !!}
         <button><i class="" style="font-size:15px; color:red" ></i>Delete</button></td></a></td>
         {!! Form::close() !!} 
   </tr>
   @endforeach
   </tbody>
</table>


</body>
</html>