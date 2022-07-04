<!DOCTYPE html>
<html lang="uk">
<head>
    <title>Grape|Катихитична комісія УГКЦ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="demo/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="demo/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="demo/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="demo/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="demo/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="demo/css/util.css">
    <link rel="stylesheet" type="text/css" href="demo/css/main.css">
    <!--===============================================================================================-->
</head>
<body>


<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" style="background-image: url('demo/images/bg_03.jpg');">
    <div class="wsize1 bor1 bg1 p-t-175 p-b-45 p-l-15 p-r-15 respon1">
        <div class="wrappic1">
            <img src="demo/images/logo.jpg" width="200px" alt="LOGO" style="border-radius: 50%">
        </div>

        <p class="txt-center m1-txt1 p-t-33 p-b-68">
{{--            Our website is under construction--}}
        </p>
        <?php
        $now = new DateTime(); // текущее время на сервере
        $date = DateTime::createFromFormat("Y-m-d H:i", '2022-09-30 23:59'); // задаем дату в любом формате
        $interval = $now->diff($date); // получаем разницу в виде объекта DateInterval
//        echo $interval->y, "\n"; // кол-во лет
//        echo $interval->m, "\n"; // кол-во лет
//        echo $interval->d, "\n"; // кол-во дней
//        echo $interval->h, "\n"; // кол-во часов
//        echo $interval->i, "\n"; // кол-во минут
        ?>

        <div class="wsize2 flex-w flex-c hsize1 cd100">
            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt1 p-b-9 muns">{{$interval->m}}</span>
                <span class="s1-txt1">Місяців</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt1 p-b-9 days">{{$interval->d}}</span>
                <span class="s1-txt1">Днів</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt1 p-b-9 hours">{{$interval->h}}</span>
                <span class="s1-txt1">Годин</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt1 p-b-9 minutes">{{$interval->i}}</span>
                <span class="s1-txt1">Хвилин</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt1 p-b-9 seconds">{{$interval->s}}</span>
                <span class="s1-txt1">Секунд</span>
            </div>
        </div>

            <div class="flex-w flex-c-m contact100-form validate-form p-t-55">
                <a href="/register" class="flex-c-m s1-txt3 size3 how-btn trans-04 where1">
                    Реєстрація
                </a>
            </div>

    </div>
</div>





<!--===============================================================================================-->
<script src="demo/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="demo/vendor/bootstrap/js/popper.js"></script>
<script src="demo/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="demo/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="demo/vendor/countdowntime/moment.min.js"></script>
<script src="demo/vendor/countdowntime/moment-timezone.min.js"></script>
<script src="demo/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
<script src="demo/vendor/countdowntime/countdowntime.js"></script>
<script>
    $('.cd100').countdown100({
        /*Set Endtime here*/
        /*Endtime must be > current time*/
        endtimeYear: 0,
        endtimeMonth: {{$interval->m}},
        endtimeDate: {{$interval->d}},
        endtimeHours: {{$interval->h}},
        endtimeMinutes: {{$interval->i}},
        endtimeSeconds: {{$interval->s}},
        timeZone: ""
        // ex:  timeZone: "America/New_York"
        //go to " http://momentjs.com/timezone/ " to get timezone
    });
</script>
<!--===============================================================================================-->
<script src="demo/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="demo/js/main.js"></script>

</body>
</html>
