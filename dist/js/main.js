//ShowPassword
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
//End show password


//print
$(document).ready(function (e) {

  $(".print").click(function () {
      var printContents = document.getElementById("page-detail").innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
  });

});
//end print

//print delivery
$(document).ready(function (e) {

  $(".print-delivery").click(function () {
      var printContents = document.getElementById("page-detail-delivery").innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
  });

});
//end print

// add more import details
let productApi = 'http://localhost:3000/importDetails';

function start(){
  getProducts(renderProducts);

  handleCreateForm();
}


start();


// Functions

function getProducts(callback){
  fetch(productApi)
    .then(function(response){
      return response.json();
    })
    .then(callback);
}

function renderProducts(products){
  let listProductBlock = document.querySelector('#list-products');
  let htmls = products.map(function(product){
    return `
    <tr class="product-item-${product.id}">
      <td>${product.product_id}</td>
      <td>${product.quantity}</td>
      <td><button type="button" class="btn-delete btn btn-danger" onclick="handleDeleteProduct('${product.id}')">Xóa</button></td>
    </tr>
    `
  });
  listProductBlock.innerHTML = htmls.join("");
}

function createProduct(data,callback){
  options = {
    method: 'POST',
    body: JSON.stringify(data)
  };
  fetch(productApi,options)
  .then(function(response){
    response.json();
  })
  .then(callback);
}

function handleDeleteProduct(id){
  options = {
    method: 'DELETE',
  };
  fetch(productApi + '/' + id,options)
  .then(function(response){
    response.json();
  })
  .then(function(){
    let productItem = document.querySelector('.product-item-'+id);
    if(productItem){
      productItem.remove();
    }
  });
}

function handleCreateForm(){
  let createBtn = document.querySelector('#create-btn');
  createBtn.addEventListener("click",function(event){
    event.preventDefault();
    let product_id = document.querySelector('#input-product').value;
    let quantity = document.querySelector('#input-quantity').value;

    let formData = {
      product_id:product_id,
      quantity:quantity
    }
    createProduct(formData,function(){
      getProducts(renderProducts);
    });
  });
}


