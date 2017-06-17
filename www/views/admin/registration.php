<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    
    <div class="row">

        <div class="main">

            <?php if ($result): ?>
                <p >Congratulations, you are registered!</p>
                <div id="ref_login">
                    <a href="/page/log">Authorization</a>
                </div>
            <?php else: ?>
                    
                <div class="signup-form">
                    <h2>Registration</h2>

                    <form action="/page/registration" method="post">
                        <div id="fieldName">
                            <label for="name">Name:</label>
                            <br>
                            <input type="text" name="name" placeholder="Name" value="<?php echo @$data['name']?>"/>
                        </div>

                        <div id="fieldPass">
                            <label for="pass">Password:</label>
                            <br>
                            <input type="password" name="password" placeholder="Password"/>
                        </div>
                        <div class="submit">
                            <input type="submit" name="submit" value="registration" />
                        </div>
                                               
                    </form>

                    <div id="ref_login">
                        <a href="/page/log">Authorization</a>
                    </div>
                </div>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <div class="error">
                                <li> - <?php echo $error; ?></li>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
            <?php endif; ?>

            <br/>
            <br/>
        </div>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>