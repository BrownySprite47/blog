<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 19.04.2018
 * Time: 12:58
 */

namespace Controllers;


use Base\Controller;
use Library\Auth;
use Library\HttpException;
use Library\Request;
use Library\Url;
use Models\Post;
use Models\PostForm;

class ControllerPost extends Controller
{

    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
    }

    public function actionView()
    {

    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionCreate()
    {
        if (!Auth::isGuest()){
            $model = new PostForm();
            $this->_view->render('post_form', ['model' => $model]);
            if (Request::isPost()){
                if ($model->load(Request::getPost()) and $model->validate()){
                    if ($model->save()){
                        header('Location: /post/view/'.$model->id);
                    }
                }
            }
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
        if (!Auth::isGuest()){
            $postId = Url::getSegment(2);
            if (!empty($postId)){

                $post = new Post($postId);
                $model = new PostForm();
                $model->id = $post->id;
                $model->title = $post->title;
                $model->content = $post->content;

            }else{
                throw new HttpException('Not found', '404');
            }
            //$model = new Post($postId);
            $this->_view->render('post_form', ['model' => $model]);
            if (Request::isPost()){
                if ($model->load(Request::getPost()) and $model->validate()){
                    if ($model->update()){
                        header('Location: /post/view/'.$model->id);
                    }
                }
            }
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }

    /**
     * @throws HttpException
     */
    public function actionDelete()
    {
        if (!Auth::isGuest()){

        }else{
            throw new HttpException('Forbidden', '403');
        }
    }
}