var cart = {};

function init() {
  $.getJSON("list.json", column);
}

function column(data) {
  console.log(data);
  var out = "";
  for (var key in data) {
    out += '<div class="column is-one-quarter">';
    out += '<div class="card">';
    out += '<header class="card-header">';
    out +=
      '<p class="card-header-title title is-5">' + data[key].cost + "₸</p>";
    out += "</header>";
    out += '<div class="card-image">';
    out += '<figure class="image is-4by3">';
    out += `<img src="${data[key].img}">`;
    out += "</figure>";
    out += "</div>";
    out += '<div class="card-content">';
    out += '<div class="media">';
    out += '<div class="media-content">';
    out += `<p class="title is-4">${data[key].name}</p>`;
    out += `<p class="subtitle is-6">${data[key].description}</p>`;
    out += "</div>";
    out += "</div>";
    out += "</div>";
    out += `<footer class="card-footer"><p class="card-footer-item"><button data-id="${key}" class="button is-success add-to-cart">В корзину</button></p></footer>`;
    out += "</div>";
    out += "</div>";
  }
  $(".columns").html(out);
  $(".add-to-cart").on("click", addToCart);
}

function addToCart() {
  var id = $(this).attr("data-id");
  if (cart[id] == undefined) {
    cart[id] = 1;
  } else {
    cart[id]++;
  }
  showMiniCart();
  saveCart();
}

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function loadCart() {
  if (localStorage.getItem("cart")) {
    cart = JSON.parse(localStorage.getItem("cart"));
    showMiniCart();
  }
}

$(document).ready(function () {
  init();
  loadCart();
});
