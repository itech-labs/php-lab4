<?php
    if (isset($_POST['calculate'])) {
        $number1 = floatval($_POST['number1']);
        $number2 = floatval($_POST['number2']);
        $historyEntry = "";

        $operation = $_POST['operation'];

        switch ($operation) {
            case 'add':
                $result = $number1 + $number2;
                $historyEntry .= "$number1 + $number2 = $result\n";
                break;
            case 'subtract':
                $result = $number1 - $number2;
                $historyEntry .= "$number1 - $number2 = $result\n";
                break;
            case 'multiply':
                $result = $number1 * $number2;
                $historyEntry .= "$number1 * $number2 = $result\n";
                break;
            case 'divide':
                if ($number2 != 0) {
                    $result = $number1 / $number2;
                    $historyEntry .= "$number1 / $number2 = $result\n";
                } else {
                    $result = "Помилка: ділення на нуль";
                    $historyEntry .= "$number1 / $number2 = $result\n";
                }
                break;
        }

        $historyContent = file_get_contents('history.txt');
        file_put_contents('history.txt', $historyEntry . $historyContent);
    } else {
        $result = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./style.css">
        <title>Lab 4: PHP</title>
    </head>
    <body>
        <body>
            <h1>Калькулятор</h1>
            <form action="index.php" method="post">
                <input type="text" name="number1" placeholder="Перше число" pattern="[-+]?[0-9]+" required/>
                <div class="operations">
                <div>
                    <input type="radio" name="operation" value="add" id="add" required/>
                    <label for="add">+</label>
                </div>
                <div>
                    <input type="radio" name="operation" value="subtract" id="subtract" required/>
                    <label for="subtract">-</label>
                </div>
                <div>
                    <input type="radio" name="operation" value="multiply" id="multiply" required/>
                    <label for="multiply">*</label>
                </div>
                <div>
                    <input type="radio" name="operation" value="divide" id="divide" required/>
                    <label for="divide">/</label>
                </div>
            </div>
                <input type="text" name="number2" placeholder="Друге число" pattern="[-+]?[0-9]+" required/>
                <input type="submit" name="calculate" value="Обчислити" />
            </form>
            <h2>Результат:</h2>
            <p>
                <?php
                    if (isset($result) && $result != "") {
                        echo "Результат: $result";
                    }
                ?>
            </p>
            <h2>Історія обчислень:</h2>
            <textarea cols="50" rows="10" style="resize:none" readonly >
                <?php
                    echo file_get_contents('history.txt');
                ?>
            </textarea>
        </body>
    </body>
</html>
