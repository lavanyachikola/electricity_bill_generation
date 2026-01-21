<!DOCTYPE html>
<html>
<head>
<title>Electricity Bill Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',Arial;
}
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#141e30,#243b55);
}
.card{
    background:#fff;
    width:400px;
    padding:30px;
    border-radius:16px;
    box-shadow:0 25px 60px rgba(0,0,0,.4);
}
h2{
    text-align:center;
    margin-bottom:25px;
    color:#243b55;
}
input,select{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:12px;
    background:linear-gradient(135deg,#141e30,#243b55);
    border:none;
    color:white;
    font-size:16px;
    border-radius:8px;
    cursor:pointer;
}
button:hover{
    transform:translateY(-2px);
}
</style>
</head>
<body>

<div class="card">
<h2>Electricity Bill Login</h2>

<form method="post" action="login_process.php">

<select name="role" required>
  <option value="">Select Role</option>
  <option value="Admin">Admin</option>
  <option value="Employee">Employee</option>
  <option value="User">User</option>
</select>

<input type="text" name="name" placeholder="Enter Name" required>
<input type="password" name="password" placeholder="Password" required>

<!-- ✅ MISSING BUTTON FIXED -->
<button type="submit">Login</button>

</form>
</div>

</body>
</html>
