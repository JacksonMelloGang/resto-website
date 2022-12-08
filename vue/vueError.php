<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        #background { 
            position: absolute;
            top: 0;
            width: 100%;
        }

        .rounded-cube {
            width: 100px;
            height: 100px;
            position: relative;
            transform: rotateZ(45deg);
            background: red;
        } 
    </style>
</head>
<body style="margin:auto">
    <div id="background">
        <span class="rounded-cube" id="1"></span>
        <span class="rounded-cube" id="2"></span>
        <span class="rounded-cube" id="3"></span>
        <span class="rounded-cube" id="4"></span>
        <span class="rounded-cube" id="5"></span>
    </div>

    <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;height:100vh">
        <h1><?= $error ?></h1>
        <p><?= $errormessage ?></p>
    </div>
</body>
</html>