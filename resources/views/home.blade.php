<!DOCTYPE html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
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
    color: #000;
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
    background-color: #000;
    color: white;
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
.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin: 80px 0 40px;
    font-weight: 800;
    color: #000;
}

/* 1. Package Grid Styles (Showcase Only) */
.package-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 0 10%;
    margin-bottom: 100px;
}

.package-card {
    background: #fff;
    border: 1px solid #eee;
    padding: 50px 40px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.package-card h3 { font-size: 1.8rem; margin-bottom: 10px; }
.package-price { font-size: 2.2rem; font-weight: 800; color: #333; margin: 20px 0; }
.package-card ul { list-style: none; color: #666; line-height: 2; }

/* 2. Horizontal Showcase Styles */
.showcase-wrapper {
    display: flex;
    overflow-x: auto; /* Horizontal scroll */
    gap: 20px;
    padding: 20px 50px 40px;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

/* Hide scrollbar for cleaner look, but keep functionality */
.showcase-wrapper::-webkit-scrollbar { height: 6px; }
.showcase-wrapper::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }

.showcase-item {
    flex: 0 0 400px; /* Fixed width so they stay horizontal */
    height: 550px;
    border-radius: 12px;
    overflow: hidden;
    background: #eee;
}

.showcase-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.showcase-item:hover img { transform: scale(1.05); }
    </style>
</head>
<body>
<div class="hero-container">
  <video autoplay muted loop playsinline class="back-video">
    <source src="{{ asset('index_video.mp4') }}" type="video/mp4">
  </video>

  <header class="navbar">
    <div class="logo">KSStudio</div>
    <nav class="nav-links">
        <a href="#packages">Products</a>
        <a href="#works">Our Works</a>
        <a href="#story">About Us</a>
    </nav>

    <div class="auth-buttons">
        <a href="/login"><button class="login">Log In</button></a>
        <a href="/register"><button class="btn-start">Get Started</button></a>
    </div>
  </header>

  <div class="hero-content">
    <h1>Commemorate your moments</h1>
    <p>KSStudio transform your moments into memories</p>
    <button class="hero-btn">Learn More</button>
  </div>
</div>

<h2 id="packages" class="section-title">Our Packages</h2>
<div class="package-grid">
    <div class="package-card">
        <h3>Basic Session</h3>
        <div class="package-price">RM 50</div>
        <ul>
            <li>30 Minutes Session</li>
            <li>5 Edited Digital Photos</li>
            <li>Single Person</li>
        </ul>
    </div>

    <div class="package-card" style="border: 2px solid #000;">
        <h3>Premium Session</h3>
        <div class="package-price">RM 120</div>
        <ul>
            <li>1 Hour Session</li>
            <li>15 Edited Digital Photos</li>
            <li>Up to 4 Persons</li>
        </ul>
    </div>

    <div class="package-card">
        <h3>Studio Pro</h3>
        <div class="package-price">RM 250</div>
        <ul>
            <li>2 Hours Session</li>
            <li>All Raw + 30 Edited Photos</li>
            <li>Unlimited Persons</li>
        </ul>
    </div>
</div>

<h2 id="works" class="section-title">Our Works</h2>
<div class="showcase-wrapper">
    @if($showcasePhotos->isEmpty())
        <div class="showcase-item">
            <img src="https://via.placeholder.com/400x500?text=No+Work+Uploaded" alt="No Work">
        </div>
    @else
        @foreach($showcasePhotos as $photo)
            <div class="showcase-item">
                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->caption }}">
            </div>
        @endforeach
    @endif
</div>

<section id="story" class="info-section">
  <div class="company-desc">
    <h2>Our Story</h2>
    <p>
      We are dedicated to building seamless digital experiences. Our team focuses 
      on innovation, quality, and helping our clients reach their full potential 
      through cutting-edge technology and modern design.
    </p>
  </div>

  <div class="contact-info">
    <h3>Get in Touch</h3>
    <ul>
      <li><strong>Email:</strong> hello@ksstudio.com</li>
      <li><strong>Phone:</strong> +60 12-345 6789</li>
      <li><strong>Location:</strong> Selangor, Malaysia</li>
    </ul>
  </div>
</section>

<script>
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
</script>
</body>
