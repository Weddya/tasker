<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-4 col-lg-4 mx-auto">
            <h2><?php echo $title; ?></h2>
            <div id="ajax-message"></div>
            <form action="/add" method="post" id="add-form">
                <div class="form-group">
                    <label for="username">Имя пользователя</label>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="text">Текст задачи</label>
                    <input type="text" name="text" class="form-control" id="text">
                </div>
                <p><button type="submit" name="enter" class="btn btn-primary">Добавить</button></p>
            </form>
        </main>
    </div>
</div>
