<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 19.04.2018
 * Time: 14:11
 */

namespace Models;


use Library\Db;
use Library\HttpException;

class Post
{
    public $id;
    public $title;
    public $content;
    public $author;
    public $pubdate;

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
                users.login as authoor_name FROM post, users WHERE post.author_id = users.id AND post.id = {$id}";
        //echo $sql;
        $result = $this->_db->sendQuery($sql);
        if($result->num_rows == 0){
            throw new HttpException('Not Found', '404');
        }

        $post = $result->fetch_assoc();

        $this->id = $post['id'];
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->pubdate = $post['pubdate'];
        $this->author = [
            'id' => $post['author_id'],
            'name' => $post['author_name']
            ];

    }
}