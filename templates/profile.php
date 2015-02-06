<?php include('templates/header.php');?>

<div class="container">
    <div class="page-header">
        <h1><?php if ($loggedIn):?>Редактировать профиль
            <?php else :?>Зарегистрироватся<?php endif;?>
        </h1>
    </div>

    <?php if ($action <> '') :?>
        <div class="alert alert-success"><?= $action ?></div>
    <?php endif;?>



    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <p class="text-error">
                    <?= $errorToken ?>
            </p>
            <input type="hidden" name="token" value="<?= h($matriculant->getCode())?>">

            <label for="name" >Имя студента</label>
            <input type="text" name="name" id="name" value="<?= h($matriculant->getName())?>">
            <span class="text-error"><?= $matriculant->getErrorName()?></span>    

            <label for="surname">Фамилия студента</label>
            <input type="text" name="surname" id="surname" value="<?= h($matriculant->getSurname())?>">
            <span class="text-error"><?= $matriculant->getErrorSurname()?></span>

            <label>Пол студента <span class="text-error"><?= $matriculant->getErrorSex()?></span></label>
            <label class="radio"><input type="radio" name="sex" value="male" 
                <?php if ($matriculant->getSex()=='male'): ?>checked<?php endif;?> >М</label>
            <label class="radio"><input type="radio" name="sex" value="female" 
                <?php if ($matriculant->getSex()=='female'): ?>checked<?php endif;?> >Ж</label>

            <label for="numberGroup">Номер группы</label>
            <input type="text" name="numberGroup" id="numberGroup"
                value="<?= h($matriculant->getNumberGroup())?>">
            <span class="text-error"><?= $matriculant->getErrorNumberGroup()?></span>

            <label for="email">e-mail</label>
            <input type="text" name="email" id="email" value='<?= h($matriculant->getEmail())?>'>
            <span class="text-error"><?= $matriculant->getErrorEmail()?></span>       

            <label for="score">Суммарное число баллов на ЕГЭ</label>
            <input type="text" name="score" id="score" value="<?= h($matriculant->getScore())?>">
            <span class="text-error"><?= $matriculant->getErrorScore()?></span>

            <label for="yearOfBirth">Год рождения</label>
            <input type="text" name="yearOfBirth" id="yearOfBirth"
                value="<?= h($matriculant->getYearOfBirth())?>"> 
            <span class="text-error"><?= $matriculant->getErrorYearOfBirth()?></span>

            <label>Местный или иногородный <span class="text-error"><?= $matriculant->getErrorLocation()?></span></label>
            
            <label class="radio"><input type="radio" name="location" value="resident"
                <?php if ($matriculant->getLocation() == 'resident'): ?>checked<?php endif; ?>>Местный</label>
            <label class="radio"><input type="radio" name="location" value="notresident" 
                <?php if ($matriculant->getLocation() == 'notresident'): ?>checked<?php endif; ?>>Иногородний</label>
           

            <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
        </fieldset>
    </form>
</div>
<?php include('templates/footer.php'); ?>
