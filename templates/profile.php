<?php include('templates/header.php'); ?>

<h1><?= $title?></h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <label>Имя студента</label>
        <p class="text-error"><?= $errors['name']?></p>
        <input type="text" name="name" 
            value="<?= $name?>">

        <label>Фамилия студента</label>
        <p class="text-error"><?= $errors['surname']?></p>
        <input type="text" name="surname" value="<?= $surname?>">

        <label>Пол студента</label>
        <label class="radio"><input type="radio" name="sex" value="male" checked>М</label>
        <label class="radio"><input type="radio" name="sex" value="female" 
            <?php if ($sex=='female'): ?>checked<?php endif;?> >Ж</label>

        <label>Номер группы</label>
        <p class="text-error"><?= $errors['numberGroup']?></p>
        <input type="text" name="numberGroup" 
            value="<?= $numberGroup?>">


        <label>e-mail</label>
        <p class="text-error"><?= $errors['email']?></p>
        <input type="text" name="email" value='<?= $email?>'>
        

        <label>Суммарное число баллов на ЕГЭ</label>
        <p class="text-error"><?= $errors['score']?></p>
        <input type="text" name="score" value="<?= $score?>">


        <label>Год рождения</label>
        <p class="text-error"><?= $errors['yearOfBirth']?></p>
        <input type="text" name="yearOfBirth" 
            value="<?= $yearOfBirth?>"> 


        <label>Местный или иногородный</label>
        <label class="radio"><input type="radio" name="location" value="resident" checked>Местный</label>
        <label class="radio"><input type="radio" name="location" value="notresident" 
            <?php if ($location == 'notresident'): ?>checked<?php endif; ?> >Иногородний</label>

        <button type="submit" name="submit" class="btn">Отправить</button>
    </fieldset>
</form>

</body>
</html>