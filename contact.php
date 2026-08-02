<?php include('includes/header.php'); ?>
<style>
.contact-container {
    max-width: 550px;
    margin: 70px auto 40px auto;
    background: rgba(35,35,35,0.98);
    border-radius: 18px;
    padding: 40px 30px 26px 30px;
    box-shadow: 0 8px 36px #0007;
}
.contact-container h2 {
    color: #ffc100;
    font-size: 2.05em;
    text-align: center;
    margin-bottom: 22px;
    font-weight: 900;
}
.contact-container p {
    color: #ffe496;
    text-align: center;
    margin-bottom: 17px;
    font-size: 1.13em;
}
.contact-container .info {
    margin: 16px auto 0 auto;
    padding: 18px 15px 10px 15px;
    background: #191919e3;
    border-radius: 10px;
    box-shadow: 0 3px 12px #0002;
    color: #fffbe6;
    font-size: 1.09em;
    text-align: center;
}
.contact-container form {
    margin-top: 20px;
}
.contact-container input,
.contact-container textarea {
    width: 100%;
    padding: 11px 8px;
    border-radius: 8px;
    border: 1.2px solid #ffc10044;
    margin-bottom: 17px;
    font-size: 1.04em;
    background: #181818;
    color: #fffbe6;
    box-shadow: 0 2px 10px #0001;
    outline: none;
    transition: border .14s;
}
.contact-container input:focus,
.contact-container textarea:focus {
    border: 1.2px solid #ffc100;
}
.contact-container button {
    width: 100%;
    background: #ffc100;
    color: #181818;
    font-weight: 700;
    font-size: 1.14em;
    padding: 12px 0 10px 0;
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 16px #0001;
    transition: background .16s, color .16s;
    cursor: pointer;
}
.contact-container button:hover {
    background: #ffe496;
    color: #232323;
}
</style>
<div class="contact-container">
    <h2>Contact Us</h2>
    <p>Questions or feedback? Reach out to us and we’ll get back to you soon!</p>
    <div class="info">
        <b>Email:</b> pawsandfound@example.com<br>
        <b>Phone:</b> +880 1XXXXXXX<br>
        <b>Address:</b> Your Street, Your City, Bangladesh
    </div>
    <!-- Optional Contact Form (non-functional example) -->
    <form method="post" autocomplete="off" style="margin-top:18px;">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" rows="3" required></textarea>
        <button type="submit" disabled>Send Message</button>
        <div style="color:#ffc100;text-align:center;margin-top:8px;font-size:0.98em;">(Demo only. For real queries, use the email above.)</div>
    </form>
</div>
<?php include('includes/footer.php'); ?>
