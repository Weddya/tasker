<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-4 col-lg-4 mx-auto">
            <h2><?php echo $title; ?></h2>
            <div id="ajax-message"></div>
            <form action="/edit/<?php echo $data['id']; ?>" method="post">
                <div class="form-group">
                    <label for="username">Имя пользователя</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo $data['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo $data['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="text">Текст задачи</label>
                    <input type="hidden" name="old_text" value="<?php echo $data['text']; ?>">
                    <textarea type="text" name="text" class="form-control" id="text" rows="3"><?php echo $data['text']; ?></textarea>
                </div>
                <p><button type="submit" name="enter" class="btn btn-primary">Сохранить</button></p>
            </form>
        </main>
    </div>
</div>
