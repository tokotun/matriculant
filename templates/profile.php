<?php include('templates/header.php');?>

                <li><a href="index.php">На главную</a></li>
                <li class="active"><a href="login.php">
                    <?php if ($matriculantMapper->loggedIn):?>Редактировать профиль
                    <?php else :?>Зарегистрироватся<?php endif;?>
                </a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">

<div class="page-header">
<h1><?php if ($matriculantMapper->loggedIn):?>Редактировать профиль
    <?php else :?>Зарегистрироватся<?php endif;?>
</h1>
</div>
    <?php if ($matriculantMapper->recorded) : ?>
        <?php if ($matriculantMapper->loggedIn):?>
            <div class="alert alert-success">Изменения сохранены</div>
        <?php else :?>
            <div class="alert alert-success">Вы успешно зарегистрировались и добавлены в таблицу</div>
        <?php endif;?>
    <?php endif; ?>


<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <p class="text-error">
                <?= $errorToken ?>
        </p>

        <input type="hidden" name="token" value="<?= h($matriculant->code)?>">

        <label for="name" >Имя студента</label>
        <input type="text" name="name" id="name"
            value="<?= h($matriculant->name)?>">
        <span class="text-error"><?= $matriculant->errors['name']?></span>    


        <label for="surname">Фамилия студента</label>
        <input type="text" name="surname" id="surname" value="<?= h($matriculant->surname)?>">
        <span class="text-error"><?= $matriculant->errors['surname']?></span>


        <label>Пол студента <span class="text-error"><?= $matriculant->errors['sex']?></span></label>
        <label class="radio"><input type="radio" name="sex" value="male" 
            <?php if ($matriculant->sex=='male'): ?>checked<?php endif;?> >М</label>
        <label class="radio"><input type="radio" name="sex" value="female" 
            <?php if ($matriculant->sex=='female'): ?>checked<?php endif;?> >Ж</label>




        <label for="numberGroup">Номер группы</label>
        <input type="text" name="numberGroup" id="numberGroup"
            value="<?= h($matriculant->numberGroup)?>">
        <span class="text-error"><?= $matriculant->errors['numberGroup']?></span>

        <label for="email">e-mail</label>
        <input type="text" name="email" id="email" value='<?= h($matriculant->email)?>'>
        <span class="text-error"><?= $matriculant->errors['email']?></span>       

        <label for="score">Суммарное число баллов на ЕГЭ</label>
        <input type="text" name="score" id="score" value="<?= h($matriculant->score)?>">
        <span class="text-error"><?= $matriculant->errors['score']?></span>

        <label for="yearOfBirth">Год рождения</label>
        <input type="text" name="yearOfBirth" id="yearOfBirth"
            value="<?= h($matriculant->yearOfBirth)?>"> 
        <span class="text-error"><?= $matriculant->errors['yearOfBirth']?></span>

        <label>Местный или иногородный <span class="text-error"><?= $matriculant->errors['location']?></span></label>
        
        <label class="radio"><input type="radio" name="location" value="resident"
            <?php if ($matriculant->location == 'resident'): ?>checked<?php endif; ?>>Местный</label>
        <label class="radio"><input type="radio" name="location" value="notresident" 
            <?php if ($matriculant->location == 'notresident'): ?>checked<?php endif; ?>>Иногородний</label>
       

        <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
    </fieldset>
</form>
</div>
<?php include('templates/footer.php'); ?>