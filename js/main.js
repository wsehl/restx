var cart = {};

function loadCart() {
  if (localStorage.getItem("cart")) {
    cart = JSON.parse(localStorage.getItem("cart"));
    showCart();
    showMiniCart();
  } else {
    $(".main-cart").html("Корзина пуста!");
  }
}

function showCart() {
  if (!isEmpty(cart)) {
    $(".main-cart").html("Корзина пуста!");
  } else {
    $.getJSON("list.json", function (data) {
      var goods = data;
      var out = "";
      var price = 0;
      var final = 0;
      var discount = 0;
      var delivery = 0;
      var all = 0;
      for (var id in cart) {
        out +=
          `<button data-id="${id}" class="button is-warning is-small del-goods">X</button>` +
          "&nbsp";
        out +=
          `<span class="tag is-white is-medium">${goods[id].name}</span>` +
          "&nbsp";
        out +=
          `<button data-id="${id}" class="button is-danger is-small minus-goods">-</button>` +
          "&nbsp" +
          "&nbsp" +
          "&nbsp";
        out += `${cart[id]}` + "&nbsp" + "&nbsp" + "&nbsp";
        out +=
          `<button data-id="${id}" class="button is-success is-small plus-goods">+</button>` +
          "&nbsp" +
          "&nbsp" +
          "&nbsp";
        out += cart[id] * goods[id].cost + "&nbsp";
        out += "<br>" + "<br>";
        price += cart[id] * goods[id].cost;
      }

      for (var key in cart) {
        all += cart[key];
      }

      if (price >= 5000) {
        delivery = 0;
      } else {
        delivery = 600;
      }

      if (price >= 20000) {
        discount = price * 0.15;
        final = price - discount;
      } else {
        final = price + delivery;
      }

      out += "Всего товаров: " + all + "<br>";
      out += "На сумму: " + price + " ₸";
      out += "<br>";
      out += "Скидка: " + discount + " ₸";
      out += "<br>";
      out += "Доставка: " + delivery + " ₸";
      out += "<br>";
      out += "<strong>" + "В итоге: " + final + "₸" + "</strong>";

      out += "<br>";
      out += "<br>";

      $(".main-cart").html(out);
      $(".del-goods").on("click", delGoods);
      $(".plus-goods").on("click", plusGoods);
      $(".minus-goods").on("click", minusGoods);

      $("#checkbox_check").on("click", function () {
        if ($(this).is(":checked")) {
          var goods = data;
          var out = "";
          var price = 0;
          var final = 0;
          var discount = 0;
          var delivery = 0;
          var all = 0;
          for (var id in cart) {
            out +=
              `<button data-id="${id}" class="button is-warning is-small del-goods">X</button>` +
              "&nbsp";
            out +=
              `<span class="tag is-white is-medium">${goods[id].name}</span>` +
              "&nbsp";
            out +=
              `<button data-id="${id}" class="button is-danger is-small minus-goods">-</button>` +
              "&nbsp" +
              "&nbsp" +
              "&nbsp";
            out += `${cart[id]}` + "&nbsp" + "&nbsp" + "&nbsp";
            out +=
              `<button data-id="${id}" class="button is-success is-small plus-goods">+</button>` +
              "&nbsp" +
              "&nbsp" +
              "&nbsp";
            out += cart[id] * goods[id].cost + "&nbsp";
            out += "<br>" + "<br>";
            price += cart[id] * goods[id].cost;
          }

          for (var key in cart) {
            all += cart[key];
          }

          if (price >= 5000) {
            delivery = 0;
          } else {
            delivery = 600;
          }

          discount = price * 0.1;
          final = price - discount;

          out += "Всего товаров: " + all + "<br>";
          out += "На сумму: " + price + " ₸";
          out += "<br>";
          out += "Скидка: " + discount + " ₸";
          out += "<br>";
          out += "Доставка: " + delivery + " ₸";
          out += "<br>";
          out += "<strong>" + "В итоге: " + final + "₸" + "</strong>";

          out += "<br>";
          out += "<br>";

          $(".main-cart").html(out);
          $(".del-goods").on("click", delGoods);
          $(".plus-goods").on("click", plusGoods);
          $(".minus-goods").on("click", minusGoods);
        } else {
          var goods = data;
          var out = "";
          var price = 0;
          var final = 0;
          var discount = 0;
          var delivery = 0;
          var all = 0;
          for (var id in cart) {
            out +=
              `<button data-id="${id}" class="button is-warning is-small del-goods">X</button>` +
              "&nbsp";
            out +=
              `<span class="tag is-white is-medium">${goods[id].name}</span>` +
              "&nbsp";
            out +=
              `<button data-id="${id}" class="button is-danger is-small minus-goods">-</button>` +
              "&nbsp" +
              "&nbsp" +
              "&nbsp";
            out += `${cart[id]}` + "&nbsp" + "&nbsp" + "&nbsp";
            out +=
              `<button data-id="${id}" class="button is-success is-small plus-goods">+</button>` +
              "&nbsp" +
              "&nbsp" +
              "&nbsp";
            out += cart[id] * goods[id].cost + "&nbsp";
            out += "<br>" + "<br>";
            price += cart[id] * goods[id].cost;
          }

          for (var key in cart) {
            all += cart[key];
          }

          if (price >= 5000) {
            delivery = 0;
          } else {
            delivery = 600;
          }

          if (price >= 20000) {
            discount = price * 0.15;
            final = price - discount;
          } else {
            final = price + delivery;
          }

          out += "Всего товаров: " + all + "<br>";
          out += "На сумму: " + price + " ₸";
          out += "<br>";
          out += "Скидка: " + discount + " ₸";
          out += "<br>";
          out += "Доставка: " + delivery + " ₸";
          out += "<br>";
          out += "<strong>" + "В итоге: " + final + "₸" + "</strong>";

          out += "<br>";
          out += "<br>";

          $(".main-cart").html(out);
          $(".del-goods").on("click", delGoods);
          $(".plus-goods").on("click", plusGoods);
          $(".minus-goods").on("click", minusGoods);
        }
      });
    });
  }
}

function resetGoods() {
  cart = {};
  saveCart();
  showCart();
}

function showMiniCart() {
  var all = 0;
  for (var key in cart) {
    all += cart[key];
  }
  document.getElementById("all").innerHTML = all;
}

function delGoods() {
  var id = $(this).attr("data-id");
  delete cart[id];
  saveCart();
  showCart();
}

function plusGoods() {
  var id = $(this).attr("data-id");
  cart[id]++;
  saveCart();
  showCart();
}

function minusGoods() {
  var id = $(this).attr("data-id");
  if (cart[id] == 1) {
    delete cart[id];
  } else {
    cart[id]--;
  }
  saveCart();
  showCart();
}

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart)); //корзину в строку
}

function isEmpty(object) {
  for (var key in object) if (object.hasOwnProperty(key)) return true;
  return false;
}

function reloadPage() {
  location.reload(true);
}

function sendEmail() {
  var ename = $("#ename").val();
  var email = $("#email").val();
  var ephone = $("#ephone").val();
  var eaddr = $("#eaddr").val();
  if (ename != "" && email != "" && ephone != "" && eaddr != "") {
    if (isEmpty(cart)) {
      $.post(
        "core/mail.php",
        {
          ename: ename,
          email: email,
          ephone: ephone,
          eaddr: eaddr,
          cart: cart,
        },
        function (data) {
          if (data == 1) {
            alert("alert");
            reloadPage();
          } else {
            resetGoods();
            swal({
              title: "Спасибо за заказ, " + ename,
              text: "Ожидайте звонка!",
              type: "success",
              confirmButtonText: "Хорошо!",
            }).then((result) => {
              if (result.value) {
                reloadPage();
                location.replace("index.php");
              }
            });
          }
        }
      );
    } else {
      alert("Корзина пуста");
    }
  } else {
    alert("Заполните поля");
    reloadPage();
  }
}

$(document).ready(function () {
  loadCart();
  $(".send-email").on("click", sendEmail);
});

document.addEventListener("DOMContentLoaded", () => {
  const $navbarBurgers = Array.prototype.slice.call(
    document.querySelectorAll(".navbar-burger"),
    0
  );
  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach((el) => {
      el.addEventListener("click", () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);
        el.classList.toggle("is-active");
        $target.classList.toggle("is-active");
      });
    });
  }
});
function validateNum(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(key);
  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}
function validateText(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(key);
  var regex = /[0-9]|\./;
  if (regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}
