<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 mb-4 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Tasker</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <?php if (isset($_SESSION['authorize']) || isset($_SESSION['admin'])): ?>
                    <a class="nav-link" href="/logout">Выход</a>
                <?php else: ?>
                    <a class="nav-link" href="/login">Авторизация</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    <?php echo $content; ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/ajax-form.js"></script>
    <script src="/public/scripts/change_status.js"></script>
    <script src="/public/scripts/sort.js"></script>
</body>
</html>