<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller
{
    public function loginAction()
    {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('/');
        }

        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('/');

            $this->view->message('success', 'OK');
        }
        $this->view->render('Вход в панель управления');
    }

    public function editAction()
    {
        if (!$this->model->isTaskExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if (!$this->model->editValidate($_POST)) {
                $this->view->message('danger', $this->model->error);
            }
            $this->model->editTask($_POST, $this->route['id']);
            $this->view->message('success', 'Задача сохранена');
        }

        $vars = [
            'data' => $this->model->getTaskData($this->route['id'])[0],
        ];
        $this->view->render('Редактирование задачи', $vars);
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('/');
    }
}