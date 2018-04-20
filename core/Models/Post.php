<?php
/**
 * Created by PhpStorm.
 * RegisterForm: BestUser1
 * Date: 19.04.2018
 * Time: 14:11
 */

namespace Core\Models;


use Core\Library\Db;
use Core\Library\HttpException;

class Post
{
    public $id;
    public $title;
    public $content;
    public $posts;
    protected $_db;

    /**
     * Post constructor.
     * @param $id
     * @throws HttpException
     * @throws \Exception
     */
    public function __construct($id)
    {
        $this->_db = Db::getDb();
        $sql = "SELECT post.id, post.title, post.content, post.pubdate, users.id as author_id, 
                users.login as author_name FROM post, users WHERE post.author_id = users.id AND post.id = '{$id}'";

        //echo $sql;
        $result = $this->_db->sendQuery($sql);
        if($result->num_rows == 0){
            throw new HttpException('Not Found', '404');
        }else{
            while ($row = $result->fetch_assoc()){
                $this->posts[] = $row;
            }
        }
        $this->id = $this->posts[0]['id'];
        $this->title = $this->posts[0]['title'];
        $this->content = $this->posts[0]['content'];
    }
}