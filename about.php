<?php include('includes/header.php'); ?>
<style>
.about-container {
    max-width: 900px;
    margin: 60px auto 40px auto;
    background: rgba(35,35,35,0.97);
    border-radius: 18px;
    padding: 46px 38px 28px 38px;
    box-shadow: 0 8px 36px #0006;
    color: #ffe496;
}
.about-container h2 {
    color: #ffc100;
    font-size: 2.15em;
    text-align: center;
    margin-bottom: 22px;
    font-weight: 900;
    letter-spacing: 1.3px;
}
.about-container .mission {
    font-size: 1.13em;
    margin-bottom: 17px;
    line-height: 1.8;
    color: #fffbe6;
    text-align: center;
}
.why-choose-us {
    margin-top: 28px;
    padding: 22px 18px 12px 18px;
    background: #1a1916f7;
    border-radius: 12px;
    box-shadow: 0 3px 12px #0003;
}
.why-choose-us h3 {
    color: #ffc100;
    font-size: 1.23em;
    margin-bottom: 12px;
    text-align: center;
    letter-spacing: 0.7px;
}
.why-choose-list {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    justify-content: center;
    list-style: none;
    margin: 0;
    padding: 0;
}
.why-choose-list li {
    background: #232323c7;
    border-radius: 8px;
    color: #ffe496;
    padding: 15px 19px;
    font-size: 1.04em;
    min-width: 220px;
    flex: 1 1 220px;
    text-align: center;
    box-shadow: 0 1.5px 8px #0002;
}
</style>
<div class="about-container">
    <h2>About Paws &amp; Found</h2>
    <div class="mission">
        <b>Paws &amp; Found</b> is dedicated to helping pets find loving homes and reuniting lost pets with their families.  
        Our mission: support animal welfare, promote adoption, and connect our community with education and resources.
        <br><br>
        <span style="color:#ffc100;">Together, we create a better world for pets!</span>
    </div>
    <div class="why-choose-us">
        <h3>Why Choose Us?</h3>
        <ul class="why-choose-list">
            <li>🐾 Caring, passionate volunteers</li>
            <li>🔎 Lost &amp; found pet support</li>
            <li>🏡 Adoption guidance</li>
            <li>💡 Expert pet care resources</li>
            <li>📞 Responsive communication</li>
        </ul>
    </div>
</div>
<?php include('includes/footer.php'); ?>
