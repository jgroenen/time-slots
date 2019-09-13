<?php

ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

$data = json_decode(file_get_contents("http://x.apitecture.nl/posts.json"), true);

$dagen = [];

for ($dag = 20; $dag <= 28; ++$dag)
    for ($uur = 11; $uur <= 19; ++$uur)
        foreach (["00", "15", "30", "45"] as $minuut)
            $dagen[$dag][] = "{$uur}:{$minuut}";

?>
<!doctype html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php

foreach ($dagen as $dag => $slots) {
    echo "<h1>{$dag} oktober</h1>";
    foreach ($slots as $slot) {
        if (!empty($data["posts"][$dag][$slot])) {
            echo "{$data["posts"][$dag][$slot]}<br>";
        } else {
            echo "<button data-dag='{$dag}'>{$slot}</button><br>";
        }
    }
}

?>
<script>

$('button').click(function () {
    var dag = $(this).data("dag");
    var slot = $(this).html();
    var naam = prompt("Wat is je naam?");
    $(this).replaceWith(naam);
    $.post("/save.php", {
        dag: dag,
        slot: slot,
        naam: naam
    });
});

</script>
</body>
</html>
