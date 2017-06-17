<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">

    <div class="row">

        <div class="main">

            <!--sign up form-->
            <h2>Login</h2>
           
            <form action="/page/login"  method="post">

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
                    <input type="submit" name="submit" value="login" />
                </div>
            </form>

            <div id="ref_registration">
                <a href="/page/regist">Registration</a>
            </div>

            <br/>
            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
            
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <div class="error">
                        <li> - <?php echo $error; ?></li>
                    </div>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>