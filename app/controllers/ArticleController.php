<?php
/* 
* @Author: sxf
* @Date:   2014-08-06 15:22:46
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-17 19:27:35
*/

/**
 * 这个类主要是用来控制显示网站文章的
 */
class ArticleController extends ControllerBase
{


    public function initialize()
    {
        // $this->view->setTemplateAfter('main');
        // Phalcon\Tag::setTitle('Welcome');
        $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
        $this->view->disable(); //阻止显示
        // parent::initialize();
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
                    } else {
                        foreach ($article->getMessages() as $message) {
                            throw new Exception($message, 100);
                        }
                    }
                } else {
                    throw new Exception('同名文章已存在', 201);
                }
            } catch (Exception $e) {
                $ans['ret'] = -1;
                Utils::makeError($e, $ans);
            } finally {
                echo json_encode($ans);
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
                $section = $this->request->getPost("section");

                $existArticle = Article::find(array("conditions" => "id=?1",
                    "bind" => array(1 => $tarid)));
                if (count($existArticle) == 0) {
                    throw new Exception("要修改的文章不存在", 204);
                } else {
                    $existArticle->title = $title;
                    $existArticle->date = $date;
                    $existArticle->body = $body;
                    $existArticle->section = $section;

                    if ($existArticle->save() == true) {
                        $ans['ret'] = 0;
                    } else {
                        throw new Exception("参数存在非法数据", 102);
                    }
                }
            } catch (Exception $e) {
                $ans['ret'] = -1;
                Utils::makeError($e, $ans);
            } finally {
                echo json_encode($ans);
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
                            throw new Exception("要删除的文章不存在", 204);
                        } else {
                            $existArticle->delete();
                            $ans['ret'] = 0;
                        }
                    }
                } else {
                    foreach ($titles as $titleItem) {
                        $existArticle = Article::find(array("conditions" => "title=?1",
                            "bind" => array(1 => $titleItem)));
                        if (count($existArticle) == 0) {
                            throw new Exception("要删除的文章不存在", 204);
                        } else {
                            $existArticle->delete();
                            $ans['ret'] = 0;
                        }
                    }
                }
            } catch (Exception $e) {
                $ans['ret'] = -1;
                Utils::makeError($e, $ans);
            } finally {
                echo json_encode($ans);
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
                    throw new Exception("要查找的文章不存在", 204);
                } else {
                    $data = [];
                    $data['title'] = $existArticle->title;
                    $data['date'] = $existArticle->date;
                    $sectionId = $existArticle->section_id;
                    $conditions = "id =:id:";
                    $parameters = array("id" => $sectionId);
                    $temp_section = Section::find(array($conditions, "bind" => $parameters));
                    $data['section'] = $temp_section->name;
                    $ans['ret'] = 0;
                    $ans['data'] = $data;
                }
            } catch (Exception $e) {
                $ans['ret'] = -1;
                Utils::makeError($e, $ans);
            } finally {
                echo json_encode($ans);
            }
        }
    }

    //较特殊的方法，用来获取文章的Html内容，注意校验权限
    public function putHtmlAction($id)
    {
        if ($this->request->isPost() == true) {
            try {
                $body = $this->request->getPost("body");
                $existArticle = Article::find(array("conditions" => "id=?1",
                    "bind" => array(1 => $tarid)));
                if (count($existArticle) == 0) {
                    throw new Exception("要修改的文章不存在", 204);
                } else {
                    $existArticle->body = $body;

                    if ($existArticle->save() == true) {
                        $ans['ret'] = 0;
                    } else {
                        throw new Exception("参数存在非法数据", 102);
                    }

                }
            } catch (Exception $e) {
                $ans['ret'] = -1;
                Utils::makeError($e, $ans);
            } finally {
                echo json_encode($ans);
            }
        }
    }

    //较特殊的方法，用来获取文章的Html内容，注意校验权限
    public function getHtmlAction($id)
    {
        $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
        if ($this->request->isGet() == true) {
            try {
                $existArticle = Article::find(array("conditions" => "id=?1",
                    "bind" => array(1 => $id)));
                if (count($existArticle) == 0) {
                    throw new Exception("要查找的文章不存在", 204);
                } else {
                    echo $existArticle->body;
                }
            } catch (Exception $e) {
                $ans['ret'] = -1;
                Utils::makeError($e, $ans);
                echo json_encode($ans);
            }
        }
    }

}

?>
