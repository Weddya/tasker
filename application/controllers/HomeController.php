<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class HomeController extends Controller
{
    public function indexAction()
    {
        if (!empty($_POST)) {
            if (isset($_POST['id']) && isset($_POST['status'])) {
                $id = (int)$_POST['id'];
                $status = (int)$_POST['status'];
                $this->model->changeStatus($id, $status);
                exit(json_encode(['success' => true]));
            }
        }

        $sort_data = [];
        $sort_options = ['sortUsernameAsc','sortUsernameDesc','sortEmailAsc','sortEmailDesc','sortStatusAsc','sortStatusDesc',];
        if (isset($this->route['sort']) && in_array($this->route['sort'], $sort_options)) {
            $tmp_data = explode(' ', preg_replace("/([a-zа-я])([A-ZА-Я])/u", '$1 $2', $this->route['sort']));
            $sort_data = [
                'action' => $tmp_data[0],
                'column' => strtolower($tmp_data[1]),
                'order' => strtoupper($tmp_data[2]),
            ];
        }

        $pagination = new Pagination($this->route, $this->model->tasksCount(), 3);
        $vars = [
            'tasks' => $this->model->getTasks($this->route, $sort_data),
            'pagination' => $pagination->get(),
            'sort' => isset($this->route['sort']) ? $this->route['sort'] : '',
            'adminAccess' => isset($_SESSION['admin']),
        ];
        $this->view->render('Главная страница', $vars);
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->addValidate($_POST)) {
                $this->view->message('danger', $this->model->error);
            }
            $this->model->addTask($_POST);
            $this->view->message('success', 'Задача добавлена');
        }
        $this->view->render('Добавление задачи');
    }


}