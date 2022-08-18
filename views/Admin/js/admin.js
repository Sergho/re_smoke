function ShowModal(elem) {
  // Fill data
  const name = elem.querySelector(".product__title").innerHTML;
  const id = name.split("[")[1].split("]")[0];
  const data = {
    id: id
  }
  const url = "/admin/get_product_info";

  $.ajax({
    data: data,
    method: "POST",
    url: url,
    success: (callback) => {
      callback = JSON.parse(callback);
      if(callback == "error") return;

      const product_name = document.querySelector(".modal-product__title");
      const product_id = document.querySelector(".modal-product__id");
      const product_description = document.querySelector(".modal-product__description");
      const product_buy_price = document.querySelector(".modal-product__buy-price .modal-product__price");
      const product_sell_price = document.querySelector(".modal-product__sell-price .modal-product__price");
      const product_in_stock = document.querySelector(".modal-product__number");
      const product_image = document.querySelector(".modal-product__image");

      product_name.value = callback['product_name'];
      product_id.innerHTML = '[' + callback['id'] + ']';
      product_description.value = callback['product_description'];
      product_buy_price.value = callback['buy_price'];
      product_sell_price.value = callback['sell_price'];
      product_in_stock.value = callback['in_stock'];
      UpdateInputLength(product_name);
      UpdateTextAreaLength(product_description);
      UpdateInputLength(product_buy_price);
      UpdateInputLength(product_sell_price);
      UpdateProfit();
      UpdateInputLength(product_in_stock);

      let image_uri = "/media/no-image.svg";
      if(callback['product_image'] != "" && callback['product_image'] != null) {
        image_uri = callback['product_image'];
      }

      product_image.src = image_uri;
    }
  });
  // Show modal
  const modal = document.querySelector(".modal");
  modal.style.display = "block";
  setTimeout(() => {modal.style.opacity = "1";}, 50);
}

function HideModal() {
  const modal = document.querySelector(".modal");
  modal.style.opacity = "0";
  setTimeout(() => {modal.style.display = "none";}, 350);
}

function UpdateInputLength(elem) {
  const length = elem.value.length - 1;
  const font_size = elem.style.fontSize;
  if(length == 0) elem.style.width = (font_size.substring(0, font_size.length - 2) / 2) + "px";
  else if(length == -1) elem.style.width = "3px";
  else {
    elem.size = length;
    elem.style.width = "auto";
  }
}

function UpdateTextAreaLength(elem) {
  const length = elem.value.length;
  if(length > 31) elem.rows = 2;
  else elem.rows = 1;
}

function UpdateProfit() {
  const buy_price = document.querySelector(".modal-product__buy-price .modal-product__price").value;
  const sell_price = document.querySelector(".modal-product__sell-price .modal-product__price").value;
  const profit_elem = document.querySelector(".modal-product__profit .modal-product__price");
  const profit_currency_elem = document.querySelector(".modal-product__profit .modal-product__price-currency");
  const profit = sell_price - buy_price;
  if(isNaN(profit)) return;
  profit_elem.value = profit;
  if(profit > 0) {
    profit_elem.classList.add("green");
    profit_currency_elem.classList.add("green");
    profit_elem.classList.remove("red");
    profit_currency_elem.classList.remove("red");
  }
  else {
    profit_elem.classList.add("red");
    profit_currency_elem.classList.add("red");
    profit_elem.classList.remove("green");
    profit_currency_elem.classList.remove("green");
  }
  UpdateInputLength(profit_elem);
}

function IncreaseCounter(elem) {
  const root = elem.parentNode;
  const counter = root.querySelector(".modal-product__number");

  counter.value = parseInt(counter.value) + 1;
  UpdateInputLength(counter);
  UpdateData(counter, "count");
}

function DecreaseCounter(elem) {
  const root = elem.parentNode;
  const counter = root.querySelector(".modal-product__number");

  if(counter.value == "0") return;
  counter.value = parseInt(counter.value) - 1;
  UpdateInputLength(counter);
  UpdateData(counter, "count");
}

function FindProductDOM(correct_id) {
  const products = document.querySelectorAll(".product");
  let result;
  products.forEach((product) => {
    const id = product.querySelector(".product__title").innerHTML.split("[")[1].split("]")[0];
    if(id == correct_id) {
      result = product;
      return;
    }
  });
  return result;
}

function UpdateData(elem, field) {
  const value = elem.value;
  const id = document.querySelector(".modal-product__id").innerHTML.split("[")[1].split("]")[0];
  const url = "/admin/product/change";
  data = {
    id: id,
    field: field,
    value: value
  }
  $.ajax({
    data: data,
    method: "POST",
    url: url,
    success: (callback) => {
      if(callback == 'ok') {
        if(field == "name") {
          const product = FindProductDOM(id);
          const name_elem = product.querySelector(".product__title");
          name_elem.innerHTML = value + '[' + id + ']';
        }
        if(field == "count") {
          const product = FindProductDOM(id);
          const count_elem = product.querySelector(".product__count");
          count_elem.innerHTML = value;
        }
      }
    }
  });
}

function SelectImage(elem){
  const input = elem.parentNode.querySelector(".modal-product__image-upload");
  input.click();
}

function SendImage(elem) {
  let file = new FormData();
  file.append('file', elem.files[0]);
  const id = document.querySelector(".modal-product__id").innerHTML.split("[")[1].split("]")[0];
  const old = document.querySelector(".modal-product__image").src;

  let data = file
  // Set new image
  $.ajax({
    data: data,
    method: "POST",
    url: "/admin/product/create_image",
		contentType: false,
		processData: false,
    success: (callback) => {
      if(callback == "error") return;
      const image = elem.parentNode.querySelector(".modal-product__image");
      image.src = callback;
      const new_image = callback;

      data = {
        old: old
      };

      // Delete image
      $.ajax({
        data: data,
        method: "POST",
        url: "/admin/product/delete_image",
        success: (callback) => {
          console.log(callback);

          // Write image in DB
          data = {
            id: id,
            field: 'image',
            value: new_image
          }

          $.ajax({
            data: data,
            method: "POST",
            url: "/admin/product/change",
            success: (callback) => {
              console.log(callback);
            }
          });
        }
      });
    }
  });
}