<?php

namespace application\models;

use application\core\Model;

class Admin extends Model
{
    public $error;

    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if ($post['username'] !== $config['username'] || $post['password'] !== $config['password']) {
            $this->error = 'Данные введены неверно.';
            return false;
        }
        return true;
    }

    public function isTaskExists($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM tasks WHERE id = :id', $params);
    }

    public function getTaskData($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM tasks WHERE id = :id', $params);
    }

    public function editTask($post, $id)
    {
        $params = [
            'id' => $id,
            'username' => htmlspecialchars(trim($post['username'])),
            'email' => htmlspecialchars(trim($post['email'])),
            'text' => htmlspecialchars(trim($post['text'])),
        ];
        if ($post['text'] === $post['old_text']) {
            $this->db->query('UPDATE tasks SET username = :username, email = :email, text = :text WHERE id = :id', $params);
        } else {
            $params['edited_by_admin'] = 1;
            $this->db->query('UPDATE tasks 
                SET username = :username, email = :email, text = :text, edited_by_admin = :edited_by_admin 
                WHERE id = :id', $params);
        }
    }

    public function editValidate($post)
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
