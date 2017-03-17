<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>форма</title>
    <!-- Bootstrap core CSS -->
    <link href="/boot/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme CSS -->
    <link href="/boot/css/bootstrap-theme.min.css" rel="stylesheet" />
    <!-- Bootstrap my CSS <link href="/css/bootstrap-override.css') }}" rel="stylesheet"> -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <script src="/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="/js/jquery-2.1.4.min.js"></script>
      <script src="/js/bootstrap-datepicker.js"></script>

      <style>
         /* Large desktops and laptops */
         @media (min-width: 1200px) {
         }
         /* Landscape tablets and medium desktops */
         @media (min-width: 992px) and (max-width: 1199px) {
         }
         /* Portrait tablets and small desktops */
         @media (min-width: 768px) and (max-width: 991px) {
         }
         /* Landscape phones and portrait tablets */
         @media (max-width: 767px) {
         }
         /* Portrait phones and smaller */
         @media (max-width: 480px) {
         }
      </style>
</head>
<body>

<div class="container-fluid" id='app_content'>
    <div class="row">
    <div class="col-sm-12 col-sm-offset-3">
      <img  src="/tst/img/ptica.png">
    </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <!-- Контейнер, содержащий форму обратной связи -->
        <div class="panel panel-info">
          <!-- Заголовок контейнера -->
          <div class="panel-heading">
            <h3 class="panel-title" id='header'>Форма обратной связи</h3>
          </div>
          <!-- Содержимое контейнера -->
          <div class="panel-body">

            <!-- Сообщение, отображаемое в случае успешной отправки данных -->
            <div class="alert alert-success hidden" role="alert" id="successMessage">
              <strong>Внимание!</strong> Ваше сообщение успешно отправлено.
            </div>

            <!-- Форма обратной связи -->
            <form id="contactForm" >
              <div class="row">


                <div id="error" class="col-sm-12" style="color: #ff0000; margin-top: 5px; margin-bottom: 5px;"></div>

                <!-- Имя и рождение пользователя -->
                <div class="col-sm-12">
                  <!-- Имя пользователя -->
                  <div class="form-group has-feedback">
                    <label for="name" class="control-label">ФИО:</label>
                    <input type="text" id="name" name="name" class="form-control" required="required" value="" placeholder="Например, Иван Иванович" minlength="2" maxlength="30">
                    <span class="glyphicon form-control-feedback"></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <!-- рождение пользователя -->
                  <div class="form-group has-feedback">
                    <label for="date" class="control-label">Дата рождения:</label>
                    <div class="input-group date datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                      <input type="text" class="form-control" name='pubdate' id='pubdate' required="required" placeholder="Например, 01/01/2002"/>
                      <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                    <span class="glyphicon form-control-feedback"></span>
                  </div>
                </div>
              </div>

              <!-- Сообщение пользователя -->
              <div class="form-group has-feedback">
                <label for="message" class="control-label">Пол:</label>
                <select class="form-control" name="fema" id="fema">
                   <option selected value="0">Мужской</option>
                   <option value="1">Женский</option>
                </select>
              </div>
              <!-- Кнопка, отправляющая форму              <button type="submit" class="btn btn-primary pull-right">Сохранить</button>              -->
              <input type="button" class="btn btn-default add_button" value="Сохранить" />
            </form><!-- Конец формы -->

          </div>
        </div><!-- Конец контейнера -->

      </div>
    </div>
  </div>


</div>

    <script src="{{asset('/boot/js/bootstrap.min.js"></script>
    <script src="{{asset('/js/ie10-viewport-bug-workaround.js"></script>
    <script src="{{asset('/js/fileinput/bootstrap-filestyle.min.js"></script>


    <script type="text/javascript">
    var photo_counter=0;

      $(document).ready(function()
      {

        $('.datepicker').datepicker(
        {
          language: 'ru',
          dateFormat: "dd-mm-yy",
          timeFormat: "hh-mm-ss"
        });


    $('.add_button').click
    (function(){
        button=$(this); // объект кнопка
        aname=$('#name').val();  // имя
        adate=$("#pubdate").val(); //datepicker("getDate");;  // дата
        afema=$('#fema').val();  // дата
        // {name: aname, date: adate, fema: afema},
        $.ajax({
            url: '/tst/add_user.php',
            type: "POST",
            data: {'name': aname, 'date': adate, 'fema': afema},
            dataType: 'json',
            success: function(data)
            {
              if(data.status==1)
              {
                photo_counter = photo_counter+1;
                $("#header").text( data.message);
                $('#name').val('');
                $("#pubdate").val('');
                $('#fema').val(0);
              }else{
                $("#header").text( "( Пользователь не сохранен");
              }
            },
            error: function(msg){
                $("#header").text( "( Пользователь успешно сохранен" + photo_counter + ")");
                alert(msg); //console.log(msg);
            }
        });
    });


      });
</script>

  </body>
</html>