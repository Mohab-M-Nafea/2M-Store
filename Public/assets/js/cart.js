function increaseValue(id, max) {
  var value = parseInt(document.getElementById('product-' + id).value, 10);
    value = isNaN(value) ? 1 : value;
    value < max ? value++ : '';
  document.getElementById('product-' + id).value = value;
  total(id);
}

function decreaseValue(id) {
  var value = parseInt(document.getElementById('product-' + id).value, 10);
  value = isNaN(value) ? 1 : value;
  value < 2 ? value = 2 : '';
  value--;
  document.getElementById('product-' + id).value = value;
  total(id);
}

function total(id) {
  var price = parseFloat(document.getElementById('price-' + id).innerText, 10);
  var quantity = parseInt(document.getElementById('product-' + id).value, 10);
  document.getElementById('total-' + id).innerText = price * quantity;

  totalPrice();
}

function totalPrice() {
  var totals = document.querySelectorAll('.total');
  var sum = 0

  totals.forEach(total => {
    sum += parseInt(total.innerText)
  });

  document.getElementById('sub-total').innerText = sum;
  document.getElementById('total').innerText = sum + 10;
}

totalPrice();
