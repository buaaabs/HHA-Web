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
                    $ans['ret'] = -1;
                    $ans['error'] = 204;
                    echo json_encode($ans);
                    throw new BaseException('文章不存在', 204);
                } else {
                    $existSection = Section::find(array("conditions" => "name=?1",
                        "bind" => array(1 => $sectionNewName)));
                    if (count($existSection) == 0) {
                        $ans['ret'] = -1;
                        $ans['error'] = 105;
                        echo json_encode($ans);
                        throw new BaseException('栏目不存在', 105);
                    } else {
                        $existArticle->section_id = $existSection->id;
                        if ($existArticle->save() == true) {
                            $ans['ret'] = 0;

                            echo json_encode($ans);
                        } else {
                            $ans['ret'] = -1;
                            $ans['error'] = 102;
                            echo json_encode($ans);
                            throw new BaseException('参数存在非法数据', 102);
                        }
                    }
                }
            } catch (BaseException $e) {


            }
        }
    }
}