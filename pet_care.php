<?php include('includes/header.php'); ?>
<style>
.care-container {
    max-width: 950px;
    margin: 60px auto 50px auto;
    background: rgba(35,35,35,0.97);
    border-radius: 18px;
    padding: 44px 38px 28px 38px;
    box-shadow: 0 8px 32px #0007;
}
.care-container h2 {
    color: #ffc100;
    font-size: 2.25em;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 900;
    letter-spacing: 2px;
}
.care-tips-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    gap: 28px;
    padding: 0;
    margin: 0;
    list-style: none;
}
.care-tip-card {
    background: #222228;
    border-radius: 14px;
    box-shadow: 0 3px 22px #0003;
    padding: 28px 22px 20px 22px;
    color: #ffe496;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: box-shadow .2s;
    border: 1.5px solid #ffc10015;
}
.care-tip-card:hover {
    box-shadow: 0 6px 24px #ffc10033;
}
.care-tip-card .icon {
    font-size: 2em;
    margin-bottom: 10px;
    color: #ffc100cc;
}
.care-tip-card strong {
    color: #ffc100;
    font-size: 1.09em;
}
</style>
<div class="care-container">
    <h2>Pet Care Tips</h2>
    <ul class="care-tips-list">
        <li class="care-tip-card">
            <span class="icon">🩺</span>
            <strong>Regular Vet Visits</strong><br>
            Annual checkups keep your pet healthy.
        </li>
        <li class="care-tip-card">
            <span class="icon">🥗</span>
            <strong>Proper Nutrition</strong><br>
            Give a balanced, species-appropriate diet.
        </li>
        <li class="care-tip-card">
            <span class="icon">💧</span>
            <strong>Fresh Water</strong><br>
            Always provide clean, fresh water.
        </li>
        <li class="care-tip-card">
            <span class="icon">🏃</span>
            <strong>Exercise</strong><br>
            Walks and playtime keep pets fit & happy.
        </li>
        <li class="care-tip-card">
            <span class="icon">✂️</span>
            <strong>Grooming</strong><br>
            Brush fur, trim nails, and check ears.
        </li>
        <li class="care-tip-card">
            <span class="icon">❤️</span>
            <strong>Love & Attention</strong><br>
            Spend quality time to bond with your pet.
        </li>
        <li class="care-tip-card">
            <span class="icon">🔒</span>
            <strong>Safety</strong><br>
            Keep harmful foods and objects away.
        </li>
        <li class="care-tip-card">
            <span class="icon">🎓</span>
            <strong>Training</strong><br>
            Teach basic commands for better behavior.
        </li>
    </ul>
</div>
<?php include('includes/footer.php'); ?>
