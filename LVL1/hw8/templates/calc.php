<div class="calc">
    <h3>Первое задание</h3>
    <div class="calc1">
    <form>
        <input type="text" name="arg1" placeholder="0" value="<?=$arg1?>">
        <select name="operation">
            <option value="add">+</option>
            <option value="sub">-</option>
            <option value="multiply">*</option>
            <option value="divided">/</option>
        </select>
        <input type="text" name="arg2" placeholder="0" value="<?=$arg2?>">
        <input type="submit" value="=">
        <input type="text" name="mathResult" placeholder="результат" value="<?=$mathResult?>">
    </form>
    </div>
    <h3>Второе задание</h3>
    <form class="calc2">
        <b>Первое число: </b><input type="text" name="number1" placeholder="0" value="<?=$number1?>"> <br>
        <b>Второе число: </b><input type="text" name="number2" placeholder="0" value="<?=$number2?>"> <br>
        <br>
        <button type="submit" name="operation" value="add">Сложениe</button>
        <button type="submit" name="operation" value="sub">Вычитание</button>
        <button type="submit" name="operation" value="multiply">Умножение</button>
        <button type="submit" name="operation" value="divided">Деление</button>
        <br><br>
        <b>Результат: </b><input type="text" name="mathResult2" placeholder="результат" value="<?=$mathResult2?>">
    </form>
</div>
