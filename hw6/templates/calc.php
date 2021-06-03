<?php 
$arg1 = 0;
$arg2 = 0;
$mathResult = 0;

if(isset($_GET['arg1'])){
    $arg1 = $_GET['arg1'];
    $arg2 = $_GET['arg2'];
    $operation = $_GET['operation'];
    $mathResult = math_operation($arg1, $arg2, $operation);
}

$number1 = 0;
$number2 = 0;
$mathResult2 = 0;

if(isset($_GET['number1'])){
    $number1 = $_GET['number1'];
    $number2 = $_GET['number2'];
    $operation = $_GET['operation'];
    $mathResult2 = math_operation($number1, $number2, $operation);
}


?>
<div class="calc">
    <h3>Первое задание</h3>
    <div class="calc1">
    <form>
        <input type="text" name="arg1" value="<?=$arg1?>">
        <select name="operation">
            <option value="add">+</option>
            <option value="sub">-</option>
            <option value="multiply">*</option>
            <option value="divided">/</option>
        </select>
        <input type="text" name="arg2" value="<?=$arg2?>">
        <input type="submit" value="=">
        <input type="text" name="mathResult" value="<?=$mathResult?>">
    </form>
    </div>
    <h3>Второе задание</h3>
    <form class="calc2">
        <b>Первое число: </b><input type="text" name="number1" value="<?=$number1?>"> <br>
        <b>Второе число: </b><input type="text" name="number2" value="<?=$number2?>"> <br>
        <br>
        <button type="submit" name="operation" value="add">Сложениe</button>
        <button type="submit" name="operation" value="sub">Вычитание</button>
        <button type="submit" name="operation" value="multiply">Умножение</button>
        <button type="submit" name="operation" value="divided">Деление</button>
        <br><br>
        <b>Результат: </b><input type="text" name="mathResult2" value="<?=$mathResult2?>">
    </form>
</div>
