<?php
if (isset($_POST['calculate'])) {
    $number1 = floatval($_POST['number1']);
    $number2 = floatval($_POST['number2']);
    $historyEntry = "";

    if (isset($_POST['add'])) {
        $result = $number1 + $number2;
        $historyEntry .= "$number1 + $number2 = $result\n";
    }
    if (isset($_POST['subtract'])) {
        $result = $number1 - $number2;
        $historyEntry .= "$number1 - $number2 = $result\n";
    }
    if (isset($_POST['multiply'])) {
        $result = $number1 * $number2;
        $historyEntry .= "$number1 * $number2 = $result\n";
    }
    if (isset($_POST['divide'])) {
        if ($number2 != 0) {
            $result = $number1 / $number2;
            $historyEntry .= "$number1 / $number2 = $result\n";
        } else {
            $result = "Помилка: ділення на нуль";
            $historyEntry .= "$number1 / $number2 = Помилка: ділення на нуль\n";
        }
    }

    file_put_contents('history.txt', $historyEntry, FILE_APPEND);
} else {
    $result = "";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lab 4: PHP</title>
    </head>
    <body>
        <body>
            <h1>Калькулятор</h1>
            <form action="index.php" method="post">
                <input type="text" name="number1" placeholder="Перше число" />
                <input type="text" name="number2" placeholder="Друге число" />
                <br />
                <label for="add">+</label>
                <input type="checkbox" name="add" value="add" id="add" />

                <label for="subtract">-</label>
                <input type="checkbox" name="subtract" value="subtract" id="subtract" />

                <label for="multiply">*</label>
                <input type="checkbox" name="multiply" value="multiply" id="multiply"/>

                <label for="divide">/</label>
                <input type="checkbox" name="divide" value="divide" id="divide"/>

                <br />
                <input type="submit" name="calculate" value="Обчислити" />
            </form>
            <h2>Результат:</h2>
            <p>
                <?php
                    if (isset($result)) {
                        echo "Результат: $result";
                    }
                ?>
            </p>
            <h2>Історія обчислень:</h2>
            <textarea cols="30" rows="10" style="resize:none" readonly >
                <?php
                    echo file_get_contents('history.txt');
                ?>
            </textarea>
        </body>
    </body>
</html>
