<?php include ROOT . '/views/layouts/header.php'; ?>

    <h1>Page tasks</h1>

    <p>
        <strong>User: <?php echo $_SESSION['logged_user_name'] ?></strong>
        <a href="/delete/user"> Logout </a>
    </p>

    <hr>

    <div class="container ">
        <p>Upload file</p>
        <form action="/page/uploadfile" enctype="multipart/form-data" method="post">
            Select file:<input type="file" name="file" required>
            <input type="submit" name="submit" value="Upload file" >
        </form>
        
        <hr>
        <p>
            <a href="/page/task">My tasks</a>
        </p>
        <p>
            <a href="/page/distribute">Distribute tasks</a>
        </p>
        <p>
            <a href="/view">View all tasks</a>
        </p>
    </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>