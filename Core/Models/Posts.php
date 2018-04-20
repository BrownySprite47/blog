<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 20.04.2018
 * Time: 11:46
 */

namespace Core\Models;


use Core\Library\Db;
use Core\Library\HttpException;

class Posts
{
//    public $id;
//    public $title;
//    public $content;
//    public $author;
//    public $pubdate;
    public $posts = [];

    protected $_db;

    /**
     * Post constructor.
     * @param $id
     * @throws HttpException
     * @throws \Exception
     */
    public function __construct($id = null)
    {
        $this->_db = Db::getDb();
        if (is_null($id)){
            $sql = "SELECT post.id, post.title, post.content, post.pubdate, users.id as author_id, 
                users.login as author_name FROM post, users WHERE post.author_id = users.id";
        }else{
            $sql = "SELECT post.id, post.title, post.content, post.pubdate, users.id as author_id, 
                users.login as author_name FROM post, users WHERE post.author_id = users.id AND post.author_id = '{$id}'";
        }

        //echo $sql;
        $result = $this->_db->sendQuery($sql);
        if($result->num_rows == 0){
            throw new HttpException('Not Found', '404');
        }else{
            while ($row = $result->fetch_assoc()){
                $this->posts[] = $row;
            }
        }
    }
}