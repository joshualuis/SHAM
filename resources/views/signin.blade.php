<!DOCTYPE html>
<html>
<head>
  <style>
    .card {
      width: 400px;
      margin: auto;
      text-align: center;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    
    h2 {
      margin-bottom: 40px;
    }
    
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      font-size: 18px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    
    input[type="submit"] {
      width: 100%;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
      border: none;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  
  <div class="card">
    <h2>Login Form</h2>
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <input type="text" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
  </div>
</body>
</html>
