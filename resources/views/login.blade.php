<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #667eea, #764ba2);
        }
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }
        .login-container h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .login-container .input-group {
            margin: 10px 0;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .login-container input:focus {
            border-color: #764ba2;
            outline: none;
            box-shadow: 0 0 5px rgba(118, 75, 162, 0.5);
        }
        .login-container .checkbox-group {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin: 10px 0;
        }
        .login-container .checkbox-group a {
            text-decoration: none;
            color: #667eea;
        }
        .login-container .checkbox-group a:hover {
            text-decoration: underline;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #667eea;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .login-container button:hover {
            background: #764ba2;
        }
        .login-container .register {
            font-size: 12px;
            margin-top: 15px;
        }
        .login-container .register a {
            color: #667eea;
            text-decoration: none;
        }
        .login-container .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="input-group">
                <input type="text" name="user_nama" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="user_pass" placeholder="Password" required>
            </div>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="{{ url('/password/reset') }}">Forgot Password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
