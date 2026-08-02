<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws &amp; Found</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<?php include __DIR__ . '/includes/header.php'; ?>

<style>
body {
    background: #181818 url('/paws_and_found2/images/bg.jpg') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    position: relative;
}

.hero-banner {
    background: rgba(24,24,24,0.72); /* transparent black */
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border-radius: 30px;
    box-shadow: 0 8px 42px 0 rgba(0,0,0,0.23);
    padding: 60px 36px 40px;
    margin: 55px auto 35px auto;
    max-width: 1050px;
    text-align: center;
    position: relative;
    color: #fffbe6;
}

.hero-banner h1 {
    font-size: 2.7em;
    color: #ffc100;
    margin-bottom: 17px;
    font-weight: 800;
    letter-spacing: .5px;
    text-shadow: 0 3px 13px #232526b0;
}
.hero-banner p {
    font-size: 1.2em;
    color: #f6eecb;
    margin-bottom: 38px;
}
.hero-nav {
    display: flex;
    justify-content: center;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 36px;
}
.hero-nav a {
    font-size: 1.08em;
    font-weight: 600;
    padding: 13px 32px;
    border-radius: 11px;
    text-decoration: none;
    background: #232526bb;
    color: #ffc100;
    border: 1.5px solid #ffc100;
    box-shadow: 0 2px 12px rgba(0,0,0,0.19);
    transition: all .18s;
    letter-spacing: .5px;
}
.hero-nav a:hover {
    background: #ffc100;
    color: #232526;
}
.hero-images {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    margin-top: 32px;
    gap: 18px;
}
.hero-images img {
    width: 260px;
    height: 200px;
    object-fit: cover;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.18);
    border: 2px solid #fffbe6;
    background: #fff;
}
/* ======== VOLUNTEER SECTION STYLE ======== */
.text-image-section {
    width: 100%;
    max-width: 950px;
    margin: 60px auto;
    min-height: 350px;
    position: relative;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.15);
    display: flex;
}
.text-image-bg {
    flex: 2;
    background: url('images/volunteer-section.jpg') center center/cover no-repeat;
    position: relative;
    min-height: 350px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.text-image-bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.43);
    z-index: 2;
}
.text-overlay-content {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 48%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 60px 50px 60px 40px;
    z-index: 3;
}
.text-overlay-content h3 {
    font-size: 1.13em;
    color: #fff;
    margin-bottom: 17px;
    font-weight: 600;
    letter-spacing: 1px;
    opacity: 0.93;
}
.text-overlay-content h2 {
    color: #fff;
    font-size: 2.15em;
    line-height: 1.12;
    font-weight: 800;
    margin-bottom: 38px;
    max-width: 400px;
}
.text-overlay-content .vol-btn {
    background: #fff;
    color: #26a3b8;
    font-weight: 600;
    border-radius: 8px;
    padding: 17px 36px;
    font-size: 1.16em;
    box-shadow: 0 2px 20px rgba(0,0,0,0.12);
    border: none;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.text-overlay-content .vol-btn:hover {
    background: #e0f5f8;
    color: #16616e;
}
@media (max-width: 900px) {
    .hero-images { flex-direction: column; align-items: center; }
    .hero-images img { width: 90vw; height: auto; margin-bottom: 13px; }
    .text-image-section { flex-direction: column; min-height: 250px; }
    .text-image-bg { min-height: 250px; }
    .text-overlay-content { position: static; left:0; right:0; padding: 32px 16px; align-items: flex-start; }
}
</style>

<div class="hero-banner">
    <h1>Welcome to Paws & Found!</h1>
    <p>
        Connecting pets and people across our community.<br>
        Adopt, help lost pets, or get involved!
    </p>
    <div class="hero-nav">
      
        <a href="lost_pets.php">Report Lost Pet</a>
      
        <a href="donate.php">Get Involved</a>
    </div>
    <div class="hero-images">
        <img src="images/dog.jpg" alt="Dog">
        <img src="images/cat.jpg" alt="Cat">
    </div>
</div>

<!-- Volunteer Section with text over image -->
<div class="text-image-section">
    <div class="text-image-bg">
        <div class="text-overlay-content">
            <h3>DID YOU KNOW?</h3>
            <h2>Our volunteers include people of all ages, all skill levels, and all backgrounds.</h2>
            <a href="volunteer.php" class="vol-btn">Ways to Volunteer</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
