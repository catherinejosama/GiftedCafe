// $(function() {
//   //Add active class to nav links
//   $('.navlinks').click(function() {
//     $('.navlinks').toggleClass('active')
//   })
// })

function addActiveClass(idName) {
  document.getElementById(idName).classList.add('active');
}

// if you want to use jQuery:
// $(window).onload(function(){switch ~~~ })
window.addEventListener('load', function() {
  switch (location.pathname) {
    case '/cafe-menu.php':
      // if you want to use jQuery:
      // $('#nav_cafemenu').addClass('active');
      addActiveClass('nav_cafemenu');
      break;
    case '/bar-menu.php':
      addActiveClass('nav_barmenu');
      break;
    case '/photo.php':
      addActiveClass('nav_photo');
      break;
    case '/access.php':
      addActiveClass('nav_access');
      break;
    default:
      break;
  }
})

function backgroundChange1() {
  document.getElementById('top_bg').style.backgroundImage =
    "url('img/360bg.jpg')"
}

function backgroundChange2() {
  document.getElementById('top_bg').style.backgroundImage =
    "url('img/360bg.png')"
}

function backgroundChange3() {
  document.getElementById('top_bg').style.backgroundImage =
    "url('img/360bg.jpg')"
}
