<nav>
<link rel="stylesheet" type="text/css" href="public/assets/css/nav_style.css">
    <div class="toggle-button">Menu</div>
    <ul>
            <li><a href="history.php">History</a></li>
            <li><a href="cancel.php">Cancel Game</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            <embed src="./public/assets/media/Easter-chosic.com_.mp3" loop="true" autostart="true" width="0" height="0">
    </ul>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
  var toggleButton = document.querySelector('.toggle-button');
  var navUl = document.querySelector('nav ul');

  toggleButton.addEventListener('click', function () {
    var isMenuVisible = navUl.style.display === 'block';
    navUl.style.display = isMenuVisible ? 'none' : 'block';
  });
});
</script>


