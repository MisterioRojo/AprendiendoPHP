<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $nota1 = 5;
    $nota2 = 8;
    $nota3 = 9;
    $nota4 = 4;
    $nota5 = 3;
    $aNota = 0;
    $mNota = 10;
    $notas = [$nota1, $nota2, $nota3, $nota4, $nota5];
    $array_num = count($notas);
    for ($i = 0; $i < $array_num; $i++) {
        if ($aNota < $notas[$i]) {
            $aNota = $notas[$i];
        }
        if ($mNota > $notas[$i]) {
            $mNota  = $notas[$i];
        }
    }

    print("Nota mayor: $aNota");
    print("<br>Nota menor: $mNota");


    ?>
</body>

</html>