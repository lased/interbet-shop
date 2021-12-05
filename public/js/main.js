$(document).ready(function(){

  if($("#sort-container").length){
    var mixer = mixitup('#sort-container', {animation: {duration: 100}});
  }

  $(".uk-card > .uk-card-footer").on("click", function(e){
    var t = e.target;
    var type = t.name;
    if(type == "edit_show"){
      var id = t.dataset.id;
      var name = t.dataset.type;
      $("#modal-overflow .uk-modal-body").html("<div uk-spinner></div>");
      $.ajax({
        type: "post",
        url: "../../components/ajax.php",
        data: "type=" + type + "&id=" + id + "&name=" + name
      })
      .done(function(str){
        $("#modal-overflow .uk-modal-body").html(str);
        $("#edit_save").attr({
          "data-id": id,
          "data-type": name,
          "value": id
        });
      });
    }
  });

  $("#showPassword").on("change", function(){
    let input = $("#inputPassword");
    if(this.checked){
      input.attr("type","text");
    }
    else{
      input.attr("type","password");
    }
  });

  if("mask" in $) {
    $(".phone").mask("+7(999)999-99-99", {autoclear: false});
  }

  $("#addInput").on("click", function(){
    let i = $("#listInput > *").length - 1;
    let len = i + +$("#countData").val();

    for (; i < len; i++) {
      $("#listInput").append(''+
      '<div class="uk-form-controls uk-margin">' +
      '<input class="uk-input" type="text" placeholder="название..." required name="' + i + '">'+
      '</div>'+
      '');
    }
  });

  $("#categoryName").on("change", function(){
    $("#listDataProduct").html('');
    getItemCategory();
  });
  getItemCategory();

  function getItemCategory(){
    $.ajax({
      type: 'POST',
      dataType:'json',
      url: '../../config/category_params.json'
    })
    .done(function(response){
      var text = $("select#categoryName option:selected").text();
      response.forEach(function(item, i){
        for(var key in item){
          if(!text.localeCompare(key)){
            for (var j = 0; j < item[key].length; j++) {
              $("#listDataProduct").append('' +
              '<div class="uk-margin uk-form-label">' + item[key][j] + '</div>' +
              '<div class="uk-form-controls">' +
              '<input class="uk-input" type="text" placeholder="' + item[key][j] + '..." required name="' + j + '">' +
              '</div>');
            }

          }
        }
      });
    });
  }

  $(".addToCart").on("click", function(e){
    var t = e.target;
    var id = t.dataset.id;
    var price = t.dataset.price;
    var obj, name;

    if(getCookie("shop") == "[]"){
      deleteCookie("shop");
    }
    if(getCookie("shop") == undefined){
      name = "product_" + id;
      obj = {};
      obj[name] = [1, price];
      obj = JSON.stringify(obj);
      setCookie("shop", obj, {path: "/", expires: 3600*24});
    }
    else{
      var find = 0;
      name = "product_" + id;
      obj = JSON.parse(getCookie("shop"));
      for(var key in obj){
        if(name == key){
          obj[key][0]++;
          find++;
          break;
        }
      }
      if(!find){
        obj[name] = [1, price];
      }
      obj = JSON.stringify(obj);
      setCookie("shop", obj, {path: "/", expires: 3600*24});
    }
    var str = $("#cart_count").html();
    str = deleteSpace(str);
    $("#cart_count").html(str + 1);
  });

  $(".cart_change_count").on("change", function(){
    var value = this.value, sum = 0, id = this.dataset.id;
    var name = ".cart_sum_" + id;
    var data;
    obj = JSON.parse(getCookie("shop"));

    for(var key in obj){
      var number = key.split('_')[1];
      if(number == id){
        data = value * obj[key][1];
        $(name + " > span").html(data);
        obj[key][0] = value;
        obj = JSON.stringify(obj);
        setCookie("shop", obj, {path: "/", expires: 3600*24});
        break;
      }
    }
    obj = JSON.parse(obj);
    for(var key in obj){
      sum += obj[key][0] * obj[key][1];
    }
    $("#cart_summary").html(sum);
  });

});

function deleteSpace(str){
  str = str.replace(/\s/g, '');
  return +str;
}

function getJSON(){
  $.ajax({
    type: "post",
    url: "../../components/JSONTest.php",
    dataType: 'json'
  })
  .done(function(str){
    console.log(str);
  });
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
  /*options
  Объект с дополнительными свойствами для установки cookie:

  expires
  Время истечения cookie. Интерпретируется по-разному, в зависимости от типа:
  Число – количество секунд до истечения. Например, expires: 3600 – кука на час.
  Объект типа Date – дата истечения.
  Если expires в прошлом, то cookie будет удалено.
  Если expires отсутствует или 0, то cookie будет установлено как сессионное и исчезнет при закрытии браузера.

  path
  Путь для cookie.

  domain
  Домен для cookie.

  secure
  Если true, то пересылать cookie только по защищенному соединению.
  */
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

function deleteCookie(name) {
  setCookie(name, "", {
    expires: -1
  })
}
