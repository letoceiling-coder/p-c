<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="/template/client/css/all.min.css">
    <link rel="stylesheet" href="/template/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/client/css/styles.css">
    <link rel="stylesheet" href="/template/client/css/noty.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" ></script>
    <script type="text/javascript" src="/template/client/js/noty.js"></script>
    <?php if($this->template == 'authorization'):?>
        <link rel="stylesheet" href="/template/client/css/main2.css">
        <script src="/template/client/js/authorization.js" ></script>
    <?else:?>


    <link rel="stylesheet" type="text/css" href="/template/client/lib/slick/slick.css"/>

    <link rel="stylesheet" type="text/css" href="/template/client/lib/slick/slick-theme.css"/>

    <?php include_once "template/client/js/jsPhp.php"?>


    <script type="text/javascript" src="/template/client/js/decimal.js"></script>
    <script type="text/javascript" src="/template/client/js/paper-full.js"></script>
    <script type="text/javascript" src="/template/client/js/delaunay.js"></script>
    <script type="text/javascript" src="/template/client/js/sketch_class.js"></script>
    <script type="text/javascript" src="/template/client/js/sketch.js"></script>

    <link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">
    <title><?=$this->route['title']?></title>
    <meta name="description" content="<?=$this->route["description"]?>" />

    <meta property="og:title" content="<?=$this->route["name_title"]?>">
    <meta property="og:image" content="<?=IMG?>logo.png" />
    <meta property="og:url" content="<?=SITES?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:name" content="Производство, продажа и монтаж натяжных потолков и комплектующих от компании <?=COMPANY?>"/>
    <meta property="og:description" content="<?=$this->route["description"]?>"/>
    <meta property="og:updated_time" content="<?=$this->newData?>"/>
    <meta property="og:type" content="Company <?=COMPANY?>">
    <meta property="og:video" content="/video/video.mp4" />
    <script src="/template/client/js/jquery.cookie.js" ></script>
    <script src="/template/client/js/jquery.inputmask.min.js" ></script>
    <script src="/template/client/js/script_main.js" ></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/template/client/lib/slick/slick.min.js"></script>
    <style>
        .main,.document,.project-management,.listing,.user,.smeta_{
            display: none;
        }
    </style>
    <?endif;?>
</head>
<body>