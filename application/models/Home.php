<?php

namespace application\models;

use application\core\Model;

class Home extends Model
{
    public $error;

    public function getTasks($route, $sort_data)
    {
        $sql = 'SELECT * FROM tasks ';
        if (!empty($sort_data)) {
            $sql .= 'ORDER BY '.$sort_data['column'].' '.$sort_data['order'].' ';
        } else {
            $sql .= 'ORDER BY id DESC ';
        }
        $params = [
            'max' => 3,
            'start' => ((isset($route['page']) ? $route['page'] : 1) - 1) * 3,
        ];
        $sql .= 'LIMIT :start, :max';

        $result = $this->db->row($sql, $params);
        return $result;
    }

    public function addTask($post)
    {
        $params = [
            'username' => htmlspecialchars(trim($post['username'])),
            'email' => htmlspecialchars(trim($post['email'])),
            'text' => htmlspecialchars(trim($post['text'])),
        ];
        $this->db->query('INSERT INTO tasks (username, email, text) VALUES (:username, :email, :text)', $params);
    }

    public function tasksCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM tasks');
    }

    public function changeStatus($id, $status)
    {
        $params = [
            'id' => $id,
            'status' => $status,
        ];
        $this->db->query('UPDATE tasks SET status = :status WHERE id = :id', $params);
    }

    public function addValidate($post)
    {
        $usernameLen = iconv_strlen(trim($post['username']));
        $emailLen = iconv_strlen(trim($post['email']));
        $textLen = iconv_strlen(trim($post['text']));
        if ($usernameLen < 1 || $usernameLen > 255) {
            $this->error = 'Имя должно содержать от 1 до 255 символов.';
            return false;
        } elseif ($emailLen < 1 || $emailLen > 255) {
            $this->error = 'Email должен содержать от 1 до 255 символов.';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email должен быть похож на email.';
            return false;
        } elseif ($textLen < 1 || $textLen > 1000) {
            $this->error = 'Текст задачи должен содержать от 1 до 1000 символов.';
            return false;
        }
        return true;
    }
}
