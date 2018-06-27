//Проверка строки на пустоту
function isEmpty(str) {
  if (str.trim() == '')
    return true;
  return false;
}

//Перекраска и напоминание о сохранении при изменении select com2
(function($) {
  $.fn.ShowStarAndColor = function() {
    var td = $(this).parent()[0];
    var iFlag = $($(td).find('i')).is(".glyphicon-asterisk");
    if (!iFlag) {
      $($(td).children()[0]).after('<i class="glyphicon glyphicon-asterisk"' +
        'style="color:#e6002e; margin-left:2px; font-size:10px;"></i>');
    }
    var row = $(td).parent()[0];
    rowColorChange(row);
  };
})(jQuery);

//автоматическое изменение select com2 по эмайл, должности и имени руководителя
(function($) {
  $.fn.ChangeComm2 = function() {
    var td = $(this).parent()[0];
    var tr = $(td).parent()[0];
    var select = $(tr).find("select[class='com2Sel']");
    var num = 0;
    var isEmail = false;
    var isGeneralPost = false;
    var isBossName = false;
    var email = $($(tr).find("textarea[placeholder='email']")).val();
    if (!isEmpty(email)) isEmail = true;
    var bossPost = $($(tr).find("textarea[placeholder='bs_post']")).val();
    if (!isEmpty(bossPost)) isGeneralPost = true;
    var bossName = $($(tr).find("textarea[placeholder='bs_name']")).val();
    if (!isEmpty(bossName)) isBossName = true;
    console.log(isEmail);
    console.log(isGeneralPost);
    console.log(isBossName);
    if (isEmail) //если почта сразу 1
      num = 1;
    if (isGeneralPost && isBossName) {
      num = 3; //если генеральный и инициалы, но нет почты
      if (isEmail) num = 2; //еще есть почта
    }
    $(select).val(num);
    $(select).ShowStarAndColor();
  };
})(jQuery);

//функция сохранения строчки асинхронно
(function($) {
  $.fn.Save = function() {
    var td = $(this).parent()[0];
    var tr = $(td).parent()[0];
    var textareas = $(tr).find('textarea');
    $(td).append('<i class="glyphicon glyphicon-sort" style="color:red; font-size:20px;"></i>');
    var ajaxStr = "ajaxStr=";
    textareas.each(function() {
      var id = $(this).attr("id");
      var val = $(this).val();
      if (isEmpty(val) || val == ' ')
        val = "_backspace_";
      ajaxStr += id + "~" + encodeURIComponent(val) + "~";
    });
    var select = $(td).find('select[class="com2Sel"]');
    var val = $(select).val();
    if (isEmpty(val) || val == ' ')
      val = "_backspace_";
    ajaxStr += $(select).attr("id") + "~" + val;
    console.log(ajaxStr);
    $.ajax({
      url: "http://localhost/quickJobGood/server.php",
      cache: false,
      type: "POST",
      dataType: "text",
      data: ajaxStr,
      success: function(data) {
        console.log(data);
        $(td).find("i[class='glyphicon glyphicon-asterisk']").remove();
        $(td).find("i[class='glyphicon glyphicon-sort']").remove();
      }
    });
  };
})(jQuery);

//изменение размера textarea
(function($) {
  $.fn.Resize = function(addCount = 0) {
    var contentSize = $(this).val().length;
    var colCount = $(this).attr('cols');
    var newRowCount = contentSize / colCount;
    var mod = contentSize % colCount;
    if (mod > 0)
      newRowCount += 1;
		newRowCount+=addCount;
    $(this).attr('rows', newRowCount);
  };
})(jQuery);

//перекраска строки
function rowColorChange(row) {
  var classRow = "danger";
  var classCol = "colorDanger";
  var classRowDel1 = "success";
  var classColDel1 = "colorSuccess";
  var classRowDel2 = "warning";
  var classColDel2 = "colorYellow";
  var select = $(row).find("select[class='com2Sel']");

  if (select.val().trim() == '' || select.val() == ' ') {
    classRow = "warning";
    classCol = "colorYellow";
    classRowDel2 = "danger";
    classColDel2 = "colorDanger";
  }
  if (select.val() == "1" || select.val() == "2" || select.val() == "3") {
    classRow = "success";
    classCol = "colorSuccess";
    classRowDel1 = "danger";
    classColDel1 = "colorDanger";
  }
  $(row).removeClass(classRowDel1);
  $(row).removeClass(classRowDel2);
  $(row).addClass(classRow);
  var tdAll = $(row).find('td');
  tdAll.each(function() {
    $(this).find('textarea').removeClass(classColDel1);
    $(this).find('textarea').removeClass(classColDel2);
    $(this).find('textarea').addClass(classCol);
  });
}

//функция для поиска на сайте рус профайл
function searchRusProfile(a) {
  var td = $(a).parent()[0];
  var tr = $(td).parent()[0];
  var checkboxes = $(tr).find("input[type=checkbox]:checked");
  var textareas = $(checkboxes).siblings('textarea');
  var searchString = "";
  textareas.each(function() {
    if ($(this).attr('placeholder') == 'bs_name')
      searchString += $(this).val() + " ";
    else {
      var href = $(this).siblings('a').attr('href').substr(38);
      searchString += href + " ";
    }
  });
  checkboxes.each(function() {
    $(this).removeAttr("checked");
  });
  $(a).attr('href', "http://www.rusprofile.ru/search?query=" + searchString);
}

//функция для поиска в яндексе
function searchYandex(a) {
  var td = $(a).parent()[0];
  var tr = $(td).parent()[0];
  var checkboxes = $(tr).find("input[type=checkbox]:checked");
  var textareas = $(checkboxes).siblings('textarea');
  var searchString = "";
  textareas.each(function() {
    searchString += $(this).val() + " ";
  });
  checkboxes.each(function() {
    $(this).removeAttr("checked");
  });
  $(a).attr('href', "https://yandex.ru/search/?text=" + searchString);
}

//функция для раскраски всей таблицы
(function($) {
  $.fn.СoloringRows = function() {
    var table = $(this);
    var child = 'tbody tr';
    var allTr = $(this).find(child);

    allTr.each(function() {
      var select = $(this).find("select[class='com2Sel']");
      rowColorChange($(this));
    });
  };
})(jQuery);

//функция установки формата телефонного номера
(function($) {
  $.fn.PhoneFormat = function() {
    var strPhone = $(this).val();
    var strReplace = strPhone.replace(/([^0-9]+)/g, '');
    strReplace = strReplace.replace(/(\d)(\d{10})/g, '7$2, ');
    strReplace = strReplace.replace(/(,\s)$/g, '');
    $(this).val(strReplace);
  };
})(jQuery);


//ПРИ ЗАГРУЗКЕ СТРАНИЦЫ
$(document).ready(function() {

  //подстройка textarea под содержимое
  $('textarea').each(function() {
    $(this).Resize(2);
  });

  //устанавливаем нужный формат для телефонов
  $("textarea[placeholder='phone']").each(function() {
    $(this).PhoneFormat();
  });

  //цвет для строк
  $('#main_data').СoloringRows();

  //удаление лишних пробелов в textarea
  $('textarea').blur(
    function() {
      var strReplace = $(this).val();
      strReplace = strReplace.replace(/(^\s+)|(\s+)$/g, '');
      strReplace = strReplace.replace(/(\s+)/g, ' ');
      $(this).val(strReplace);
      $(this).Resize();
    });

  //изменение select com2
  $("select[class='com2Sel']").change(function() {
    $(this).ShowStarAndColor();
  });

  //нажатия на главную кнопку рус профайл
  $("a[class='rusProfSearch']").click(function() {
    searchRusProfile($(this));
  });

  //нажатия на главную кнопку поиск в яндексе
  $("a[class='yandexSearch']").click(function() {
    searchYandex($(this));
  });

  //из Select в Textarea booss_post и own
  $("select[class='fromSel']").change(function() {
    var t = $(this).siblings('textarea');
    var text = $(this).val();
    $(t).val(text);
    $(this).val("");
    $(this).ChangeComm2();
  });

  //добавление ИО по ФИО
  $("textarea[placeholder='bs_name']").blur(function() {
    var strArr = $(this).val().split(" ");
    var td = $(this).parent()[0];
    var tr = $(td).parent()[0];
    var boss_ini = $(tr).find("textarea[placeholder='bs_ini']");
    if (strArr.length >= 3)
      $(boss_ini).val(strArr[1] + " " + strArr[2]);
    isBossName = true;
  });

  //ставим запятые для телефонов, формат телефонных номеров
  $("textarea[placeholder='phone']").blur(function() {
    $(this).PhoneFormat();
  });

  //сохранение строки при нажатии на значок
  $("a[class='save']").click(function() {
    $(this).Save();
  });

  //удаление содержимого textarea
  $("a[class='removeText']").click(function() {
    var tAr = $(this).siblings('textarea');
    tAr.val(" ");
    var a = $(this).siblings("a[class='rusProfHref']");
    var str = $(this).val();
    $(a).attr('href', "http://www.rusprofile.ru/search?query=" + str);
    if ($(tAr).attr("placeholder") == 'email') $(tAr).ChangeComm2();
  });

  //textarea обновление ссылки для rusprofile
  $("textarea").change(function() {
    if ($(this).hasClass("rusProf")) {
      var a = $(this).siblings("a[class='rusProfHref']");
      var str = $(this).val();
      $(a).attr('href', "http://www.rusprofile.ru/search?query=" + str);
    }
  });

  //смена ссылки на сайт при изменении
  $("textarea[placeholder='website']").change(function() {
    var a = $(this).siblings("a");
    var strHref = $(this).val();
    strHref = strHref.split(',', 1);
    $(a).attr('href', strHref);
  });

  //смена ссылки рус профайл при изменении адресса
  $("textarea[placeholder='address']").change(function() {
    var a = $(this).siblings("a");
    var strAddr = $(this).val();
    arrAddr = strAddr.split(' ', 2);
    $(a).attr('href', "http://www.rusprofile.ru/search?query=" + arrAddr[0] + " " + arrAddr[1]);
  });

  //изменение почты
  $("textarea[placeholder='email']").change(function() {
    $(this).ChangeComm2();
  });

  //изменение boss_name
  $("textarea[placeholder='bs_name']").change(function() {
    $(this).ChangeComm2();
  });

  //изменение boss_post
  $("textarea[placeholder='bs_post']").change(function() {
    $(this).ChangeComm2();
  });


});
