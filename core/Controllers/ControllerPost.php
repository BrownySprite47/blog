<?php
/**
 * Created by PhpStorm.
 * RegisterForm: BestUser1
 * Date: 19.04.2018
 * Time: 12:58
 */

namespace Core\Controllers;


use Core\Base\Controller;
use Core\Library\Auth;
use Core\Library\HttpException;
use Core\Library\Request;
use Core\Library\Url;
use Core\Models\Posts;
use Core\Models\Post;
use Core\Models\PostForm;

class ControllerPost extends Controller
{

    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionView()
    {
        if (!Auth::isGuest()){
            $postId = Url::getSegment(2);
            if (!empty($postId)){
                $model = new Post($postId);
            }

            $this->_view->setTitle('Просмотр поста');
            $this->_view->setCss('style.css');
            $this->_view->render('posts', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionCreate()
    {
        if (!Auth::isGuest()){
            $model = new PostForm();
            if (Request::isPost()){
                if ($model->load(Request::getPost()) and $model->validate()){
                    if ($model->save()){
                        header('Location: /post/view/'.$model->id);
                    }
                }
            }

            $this->_view->setTitle('Создать пост');
            $this->_view->setCss('style.css');
            $this->_view->render('post_form', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionEdit()
    {
        $postId = Url::getSegment(2);
        if (!Auth::isGuest() && !empty($postId)){
            $post = new Post($postId);
            $model = new PostForm();
            $model->id = $post->id;
            $model->title = $post->title;
            $model->content = $post->content;
            if (Request::isPost()){
                if ($model->load(Request::getPost()) and $model->validate()){
                    if ($model->update()){
                        header('Location: /post/view/'.$model->id);
                    }
                }
            }

            $this->_view->setTitle('Редактировать пост');
            $this->_view->setCss('style.css');
            $this->_view->render('post_form', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionMyposts()
    {
        if (!Auth::isGuest()){
            $model = new Posts($_SESSION['user']['id']);
            $this->_view->setTitle('Мои посты');
            $this->_view->setCss('style.css');
            $this->_view->render('posts', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }


    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionDelete()
    {
        $postId = Url::getSegment(2);
        if (!Auth::isGuest() && !empty($postId)){
            $model = new PostForm();
            $model->id = $postId;
            if ($model->delete()){
                header('Location: /');
            }
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }
}