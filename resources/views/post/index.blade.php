<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
</head>
<body>
<table>
    <thead>
      <th>Company</th>
      <th>Contact</th>
      <th>Slug</th>
   </thead>
   <tbody>
   <tr>
      <td>{{$post -> title}}</td>
      <td>{{$post -> body}}</td>
      <td>{{$post -> slug}}</td>
   </tr>
   </tbody>
</table>
   
</body>
</html>