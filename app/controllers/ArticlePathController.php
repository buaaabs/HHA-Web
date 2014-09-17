<?php

/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/20/14
 * Time: 11:05 AM
 */

/**
 * @RoutePrefix("/ArticlePath")
 */
class ArticlePathController extends \Phalcon\Mvc\Controller
{
    public function putAction()
    {
        if ($this->request()->isPost() == true) {
            $ans = [];
            try {
                $id = $this->request->getPost("id");
                $sectionNewName = $this->request->getPost("name");
                $existArticle = Article::find(array("conditions" => "id=?1",
                    "bind" => array(1 => $id)));
                if (count($existArticle) == 0) {
                    throw new Exception('文章不存在', 204);
                } else {
                    $existSection = Section::find(array("conditions" => "name=?1",
                        "bind" => array(1 => $sectionNewName)));
                    if (count($existSection) == 0) {
                        throw new Exception('栏目不存在', 105);
                    } else {
                        $existArticle->section_id = $existSection->id;
                        if ($existArticle->save() == true) {
                            $ans['ret'] = 0;
                        } else {
                            throw new Exception('参数存在非法数据', 102);
                        }
                    }
                }
            } catch (Exception $e) {
                $ans['id'] = -1;
                Utils::makeError($e, $ans);
            } finally {
                echo json_encode($ans);
            }
        }
    }
}