<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
    <style>
        
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Inter', sans-serif; 
}


.hero-container {
  position: relative;
  width: 100%;
  height: 80vh; 
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.back-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
}

.navbar {
  position: fixed; 
  top: 0;
  left: 0;
  width: 100%;
  padding: 25px 50px;
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
  z-index: 1000;
  transition: all 0.4s ease; 
  background: transparent;
  color: white;
}

.navbar.scrolled {
  background: white;
  padding: 15px 50px; 
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.navbar.scrolled .logo,
.navbar.scrolled .nav-links a,
.navbar.scrolled .login {
  color: #333; 
}

.navbar.scrolled .btn-start {
  background: #000;
  color: #fff;
}


.logo {
  color: white;
  font-weight: 800;
  font-size: 1.5rem;
  justify-self: start;
}


.nav-links {
  display: flex;
  gap: 30px;
  justify-self: center;
}

.nav-links a {
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}

.nav-links a:hover {
  color: white;
}


.dropdown {
  position: relative;
}

.dropdown-content {
  display: none;
  position: absolute;
  top: 100%; 
  left: 50%;
  transform: translateX(-50%);
  background: white;
  min-width: 180px;
  padding: 10px 0;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  margin-top: 10px;
}

.dropdown-content a {
  color: #333 !important; 
  padding: 10px 20px;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}


.auth-buttons {
  justify-self: end;
  display: flex;
  align-items: center;
  gap: 20px;
}

.login {
  background: none;
  border: none;
  color: white;
  font-weight: 600;
  cursor: pointer;
}

.btn-start {
  background: white;
  color: black;
  border: none;
  padding: 10px 20px;
  border-radius: 50px;
  font-weight: 700;
  cursor: pointer;
  transition: 0.3s;
}

.btn-start:hover {
  background: #f0f0f0;
  transform: scale(1.05);
}


.hero-content {
  text-align: center;
  color: white;
  z-index: 10;
  max-width: 700px;
}

.hero-content h1 {
  font-size: 3.5rem;
  margin-bottom: 15px;
}

.hero-container {
  position: relative;
  width: 100%;
  height: 100vh; 
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

.back-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
}

.hero-btn {
  margin-top: 25px;
  padding: 15px 35px;
  background: transparent;
  border: 2px solid white;
  color: white;
  border-radius: 5px;
  font-weight: 700;
  cursor: pointer;
  transition: 0.3s;
}

.hero-btn:hover {
  background: white;
  color: black;
}

.info-section {
  background-color: #ffffff; 
  padding: 80px 10%;       
  display: flex;
  justify-content: space-between;
  gap: 50px;
  color: #333333;           
}


.company-desc {
  flex: 2;                 
}

.company-desc h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #000;
}

.company-desc p {
  line-height: 1.8;         
  font-size: 1.1rem;
  color: #555;
}


.contact-info {
  flex: 1;
  background: #f9f9f9;      
  padding: 30px;
  border-radius: 12px;
}

.contact-info h3 {
  margin-bottom: 15px;
  font-size: 1.3rem;
}

.contact-info ul {
  list-style: none;        
}

.contact-info li {
  margin-bottom: 12px;
  font-size: 1rem;
}

.contact-info strong {
  display: block;           
  color: #000;
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}

@media (max-width: 768px) {
  .info-section {
    flex-direction: column; 
    padding: 50px 5%;
  }
}

.auth-body {
    background-color: #f4f7f6;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center; 
    margin: 0;
}

.login-container {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: -10vh; 
}


.auth-logo {
    position: absolute;
    top: 30px;
    left: 50px;
    font-size: 1.5rem;
    font-weight: 800;
    text-decoration: none;
    color: #FFAC1C;
}

.login-box {
    background: white;
    padding: 60px;          
    border-radius: 16px;    
    width: 90%;             
    max-width: 500px;       
    text-align: center;
}

.login-box h2 {
    margin-bottom: 10px;
    font-size: 1.8rem;
}

.login-box p {
    color: #666;
    margin-bottom: 30px;
}


.input-group {
    text-align: left;
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.input-group input {
    width: 100%;           
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1.1rem;
    display: block;        
    box-sizing: border-box; 
}
.input-group input:focus {
    border-color: #000; 
}

.login-btn {
    width: 100%;           
    padding: 16px;
    background-color: #FFAC1C;
    color: black;
    border: none;
    border-radius: 8px;    
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    display: block;
    box-sizing: border-box; 
    transition: opacity 0.3s;
}

.login-btn:hover {
    opacity: 0.8;
}


.signup-link {
    margin-top: 20px;
    font-size: 0.9rem;
}

.signup-link a {
    color: #000;
    font-weight: 700;
    text-decoration: none;
}

.signup-link a:hover {
    text-decoration: underline;
}

form {
    width: 100%;
}
    </style>
</head>
<body>

<body class = "auth-body">
    <a href="/" class="auth-logo">KSStudio</a>
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome New Admin</h2>
            <p>KSStudio welcomes you</p>
@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="/admin/register">
    @csrf

    <div class="input-group">
                <label>Full Name</label>
                    <input type="text"name="fullname" placeholder="Full name" required>
                </div>
    <div class="input-group">
                <label>Email</label>
                    <input type="text"name="email" placeholder="Email" required>
                </div>
    <div class="input-group">
                <label>Password</label>
                    <input type="text"name="password" placeholder="Password"required>
                </div>
    <div class="input-group">
                <label>Admin Code</label>
                    <input type="text"name="admin_code" placeholder="Code" required>
                </div>


    <button class="login-btn" type="submit">Create Admin</button>
</form>

<div class="signup-link">
            Already have an account? <a href="/login">Login here</a>
        </div>
    </div>

</body>
</html>
