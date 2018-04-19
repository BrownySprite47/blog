<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 19.04.2018
 * Time: 13:01
 */

namespace Models;


use Base\BaseForm;
use Library\Auth;

class PostForm extends BaseForm
{
    public $id;
    public $title;
    public $content;
    protected $_tableName = 'post';

    /**
     * @return array|mixed
     */
    public function getRules()
    {
        return [
            'title' => ['required', 'unique'],
            'content' => ['required'],
        ];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        $author_id = Auth::getUserId();
        $sql = "INSERT INTO {$this->_tableName} (title, content, author_id) VALUES ('{$this->title}', '{$this->content}', {$author_id})";
        $result = $this->_db->sendQuery($sql);
        if (!$result){
            $this->_errors['saveError'] = 'Error!';
            return false;
        }

        $this->id = $this->_db->getLastInsertId();
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function update()
    {
        $sql = "UPDATE {$this->_tableName} SET title = '{$this->title}', content = '{$this->content}' WHERE id = {$this->id}";
        $result = $this->_db->sendQuery($sql);
        if (!$result){
            $this->_errors['updateError'] = 'Error!';
            return false;
        }
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        $sql = "DELETE FROM {$this->_tableName} WHERE id = {$this->id}";
        $result = $this->_db->sendQuery($sql);
        if (!$result){
            $this->_errors['deleteError'] = 'Error!';
            return false;
        }
        return true;
    }
}