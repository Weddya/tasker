<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-9 col-lg-10 mx-auto">
            <a href="/add" class="btn btn-primary float-right">Добавить</a>
            <h2>Список задач</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>
                            <?php if ($sort == 'sortUsernameAsc'): ?>
                                <a href="sortUsernameDesc" class="sort-link">
                                    Имя пользователя
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <a href="sortUsernameAsc" class="sort-link">
                                    Имя пользователя
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </th>
                        <th>
                            <?php if ($sort == 'sortEmailAsc'): ?>
                                <a href="sortEmailDesc" class="sort-link">
                                    Email
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <a href="sortEmailAsc">
                                    Email
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </th>
                        <th>Текст задачи</th>
                        <th>
                            <?php if ($sort == 'sortStatusAsc'): ?>
                                <a href="sortStatusDesc" class="sort-link">
                                    Статус
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <a href="sortStatusAsc">
                                    Статус
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </th>
                        <?php if ($adminAccess): ?>
                            <th></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $val): ?>
                        <tr class="<?php echo $val['status'] ? 'table-success' : '';?>">
                            <td>
                                <?php if ($val['edited_by_admin']): ?>
                                    <small class="float-right mt-0 badge badge-primary">
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        отредактировано администратором
                                    </small>
                                <?php endif; ?>
                                <?php echo $val['username']; ?>

                            </td>
                            <td><?php echo $val['email']; ?></td>
                            <td><?php echo $val['text']; ?></td>
                            <td>
                                <button
                                    class="change-status btn btn-outline-primary"
                                    style="min-width: 132px"
                                    data-status="<?php echo $val['status']; ?>"
                                    data-id="<?php echo $val['id']; ?>">
                                        <?php echo $val['status'] ? 'Выполнено' : 'Не выполнено'; ?>
                                </button>
                            </td>
                            <?php if ($adminAccess): ?>
                                <td>
                                    <a href="/edit/<?php echo $val['id']; ?>" class="btn btn-outline-primary">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php echo $pagination; ?>
        </main>
    </div>
</div>

