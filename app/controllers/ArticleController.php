<?php
/* 
* @Author: sxf
* @Date:   2014-08-06 15:22:46
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-07 17:52:25
*/

/**
 * 这个类主要是用来控制显示网站文章的
 */
class ArticleController extends ControllerBase
{


    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction()
    {
        echo $this->guid();
        $this->view->disable(); //阻止显示
    }


    public function detailsAction($id = null)
    {
        if ($id == null) {
            $this->dispatcher->forward(
                array(
                    'controller' => 'article',
                    'action' => 'index'
                ));
            return;
        } else {

            // Query string binding parameters with string placeholders
            $conditions = "id = :str:";

            //Parameters whose keys are the same as placeholders
            $parameters = array(
                "str" => $id
            );
            $article = Article::findFirst(array(
                $conditions,
                "bind" => $parameters
            ));
            $this->view->setVar('article_title', $article->title);
            $this->view->setVar('article_date', $article->date);
            $this->view->setVar('article_body', $article->body);

        }
    }

    public function guid()
    {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $uuid =
            substr($charid, 0, 8) .
            substr($charid, 8, 4) .
            substr($charid, 12, 4) .
            substr($charid, 16, 4) .
            substr($charid, 20, 12);
        return $uuid;
    }

    public function addAction()
    {
        if ($this->request->isPost() == true) {
            $ans = [];
            try {
                $title = $this->request->getPost("title");
                $date = $this->request->getPost("date");
                $body = $this->request->getPost("body");
                $section = $this->request->getPost("section");

                $existArticle = Article::find(array("conditions" => "title=?1",
                    "bind" => array(1 => $title)));
                if (count($existArticle) == 0) {
                    $article = new Article();
                    $article->title = $title;
                    $article->date = $date;
                    $article->body = $$body;
                    $article->section = $section;
                    if ($article->save()) {
                        $ans['ret'] = $article->id;
                        echo json_encode($ans);

                    } else {
                        foreach ($article->getMessages() as $message) {
                            throw new BaseException($message, 100);
                        }
                    }
                } else {
                    $ans['ret'] = -1;
                    $ans['error'] = 201;
                    echo json_encode($ans);
                    throw new BaseException('同名文章已存在', 201);
                }
            } catch (BaseException $e) {

            }
        }
    }

    public function changeAction($id)
    {
        if ($this->request->isPost() == true) {
            $ans = [];
            try {
                $tarid = $id;
                $title = $this->request->getPost("title");
                $date = $this->request->getPost("date");
                $body = $this->request->getPost("body");
                $section = $this->request->getPost("section");

                $existArticle = Article::find(array("conditions" => "id=?1",
                    "bind" => array(1 => $tarid)));
                if (count($existArticle) == 0) {
                    $ans['ret'] = -1;
                    $ans['error'] = 204;
                    echo json_encode($ans);
                    throw new BaseException("要修改的文章不存在", 204);
                } else {
                    $existArticle->title = $title;
                    $existArticle->date = $date;
                    $existArticle->body = $body;
                    $existArticle->section = $section;

                    if ($existArticle->save() == true) {
                        $ans['ret'] = 0;

                        echo json_encode($ans);

                    } else {
                        $ans['ret'] = -1;
                        $ans['error'] = 102;
                        echo json_encode($ans);
                        throw new BaseException("参数存在非法数据 ", 102);
                    }

                }
            } catch (BaseException $e) {


            }
        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost() == true) {
            $ans = [];
            try {
                $titles = $this->request->getPost("title");
                $ids = $this->request->getPost("id");
                if ($ids != null) {
                    foreach ($ids as $idItem) {
                        $existArticle = Article::find(array("conditions" => "id=?1",
                            "bind" => array(1 => $idItem)));
                        if (count($existArticle) == 0) {
                            $ans['ret'] = -1;
                            $ans['error'] = 204;
                            echo json_encode($ans);
                            throw new BaseException("要删除的文章不存在", 204);
                        } else {
                            $existArticle->delete();
                            $ans['ret'] = 0;
                            echo json_encode($ans);
                        }
                    }
                } else {
                    foreach ($titles as $titleItem) {
                        $existArticle = Article::find(array("conditions" => "title=?1",
                            "bind" => array(1 => $titleItem)));
                        if (count($existArticle) == 0) {
                            $ans['ret'] = -1;
                            $ans['error'] = 204;
                            echo json_encode($ans);
                            throw new BaseException("要删除的文章不存在", 204);
                        } else {

                            $existArticle->delete();
                            $ans['ret'] = 0;
                            echo json_encode($ans);
                        }
                    }
                }
            } catch (BaseException $e) {


            }
        }
    }


    public function getAction($id)
    {
        if ($this->request->isGet() == true) {
            $ans = [];
            try {
                $existArticle = Article::find(array("conditions" => "id=?1",
                    "bind" => array(1 => $id)));
                if (count($existArticle) == 0) {

                    $ans['ret'] = -1;
                    $ans['error'] = 204;
                    echo json_encode($ans);
                    throw new BaseException("要查找的文章不存在", 204);
                } else {
                    $data = [];
                    $data['title'] = $existArticle->title;
                    $data['date'] = $existArticle->date;
                    $data['body'] = $existArticle->body;
                    $sectionId = $existArticle->section_id;
                    $conditions = "id =:id:";
                    $parameters = array("id" => $sectionId);
                    $temp_section = Section::find(array($conditions, "bind" => $parameters));
                    $data['section'] = $temp_section->name;
                    $ans['ret'] = 0;
                    $ans['data'] = $data;
                    echo json_encode($ans);
                }
            } catch (BaseException $e) {


            }
        }
    }

    public function editAction($id)
    {
        if ($id == 'new') {

        } else {

        }
    }

}

?>
