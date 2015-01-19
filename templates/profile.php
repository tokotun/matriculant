<?php include('templates/header.php'); ?>

<h1><?php if (isset($_COOKIE['id'])):?>Редактирование данных об абитуриенте
    <?php else                      :?>Регистрация абитуриента
    <?php endif;?>
</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <p class="text-error"><!-- ошибка выводится если форма была отправлена -->
            <?php if (isset($_POST['submit'])): ?>
                <?= $matriculant->errors['touken'] ?>
            <?php endif;?>
        </p>
        <?php $matriculant->code = $matriculant->code?>
        <input type="hidden" name="touken" value="<?= h($matriculant->code)?>">

        <label>Имя студента</label>
        <p class="text-error"><?= $matriculant->errors['name']?></p>
        <input type="text" name="name" 
            value="<?= h($matriculant->name)?>">

        <label>Фамилия студента</label>
        <p class="text-error"><?= $matriculant->errors['surname']?></p>
        <input type="text" name="surname" value="<?= h($matriculant->surname)?>">

        <label>Пол студента</label>
        <p class="text-error"><?= $matriculant->errors['sex']?></p>
        <label class="radio"><input type="radio" name="sex" value="male" 
            <?php if ($matriculant->sex=='male'): ?>checked<?php endif;?> >М</label>
        <label class="radio"><input type="radio" name="sex" value="female" 
            <?php if ($matriculant->sex=='female'): ?>checked<?php endif;?> >Ж</label>

        <label>Номер группы</label>
        <p class="text-error"><?= $matriculant->errors['numberGroup']?></p>
        <input type="text" name="numberGroup" 
            value="<?= h($matriculant->numberGroup)?>">


        <label>e-mail</label>
        <p class="text-error"><?= $matriculant->errors['email']?></p>
        <input type="text" name="email" value='<?= h($matriculant->email)?>'>
        

        <label>Суммарное число баллов на ЕГЭ</label>
        <p class="text-error"><?= $matriculant->errors['score']?></p>
        <input type="text" name="score" value="<?= h($matriculant->score)?>">


        <label>Год рождения</label>
        <p class="text-error"><?= $matriculant->errors['yearOfBirth']?></p>
        <input type="text" name="yearOfBirth" 
            value="<?= h($matriculant->yearOfBirth)?>"> 


        <label>Местный или иногородный</label>
        <p class="text-error"><?= $matriculant->errors['location']?></p>
        <label class="radio"><input type="radio" name="location" value="resident"
            <?php if ($matriculant->location == 'resident'): ?>checked<?php endif; ?>>Местный</label>
        <label class="radio"><input type="radio" name="location" value="notresident" 
            <?php if ($matriculant->location == 'notresident'): ?>checked<?php endif; ?>>Иногородний</label>


        <button type="submit" name="submit" class="btn">Отправить</button>
    </fieldset>
</form>

<?php include('templates/footer.php'); ?>