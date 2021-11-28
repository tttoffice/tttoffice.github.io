
   <link rel="stylesheet" href="{{ asset('comingSoon/css/base.css') }}">  
   <link rel="stylesheet" href="{{asset('comingSoon/css/main.css') }}">
   <link rel="stylesheet" href="{{asset('comingSoon/css/vendor.css') }}">
   <link rel="icon" type="image/png" href="{{ asset('comingSoon/images/favicon.png') }}">
   <html>
    <head><meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="{{ asset('comingSoon/images/logo.png')}}" type="image/gif">
        <title>Download App</title>
        <link rel="stylesheet" href="{{ asset('comingSoon/css/bootstrap.min.css')}} ">
        <link rel="stylesheet" href="{{ asset('comingSoon/css/style.css')}} ">
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    </head>
    <body class="body-head" style="display:table;width: 100%;">
        <div class="text-center" style="display: table-cell;vertical-align: middle;overflow:hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-9 col-12">
                        <div class="icons">
                            <img  src="{{ asset('comingSoon/images/logo.png')}}">
                            <p class="px-3">
                                توصيلكوا  هي منصه تربط بين اصحاب المطابخ والعملاء الخاصين بهم حيث يتيح التطبيق لصاحب المطبخ البيتى من عرض وجباتهم وبيعها من خلال المنصة كما يمكن العملاء من تصفح المطابخ المتاحة وامكانية شراء طلبات من خلالها ويضم التطبيق الموصلين الذين يقومون بتوصيل الطلبات من المطابخ الى العملاء....قريبا سيكون متاح بالامارات العربية المتحدة 
                            </p>

                            <div class="divider">
                                <span>حمل الان</span>
                            </div>
                            <div class="icon-btns">
                                <div class="row justify-content-center px-3">
                                    <div class="col-md-5">
                                        <a href="#"><img src=" {{ asset('comingSoon/images/google%20play.jpg')}} "></a>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="#"><img src=" {{ asset('comingSoon/images/ios.jpg')}} "></a>
                                    </div>
                                </div>
                            </div>
<!--                            <span id="countdown" class="timer"></span>-->
                            <div class="row justify-content-center timer m-0">
                                <div class="col-md-3 col-4">
                                    <span> <span> يوم </span> <span id="days"></span></span>
                                </div>
                                <div class="col-md-3 col-4">
                                    <span> <span> ساعة </span> <span id="hours"></span></span>
                                </div>
                                <div class="col-md-3 col-4">
                                    <span> <span> دقيقة </span> <span id="minutes"></span></span>
                                </div>
                                <div class="col-md-3 col-4">
                                    <span> <span> ثانية </span> <span id="seconds"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('comingSoon/js/popper.min.js')}} "></script>
        <script src="{{ asset('comingSoon/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{ asset('comingSoon/js/bootstrap.min.js')}} "></script>
        <script src="{{ asset('comingSoon/js/main.js')}}"></script>
    </body>
</html>