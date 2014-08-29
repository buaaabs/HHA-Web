<?php

/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/19/14
 * Time: 7:33 PM
 */
class SectionController extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {

    }


    public function addSectionAction()
    {
        if ($this->request->isPost() == true) {

            $ans = [];
            $sectionName = $this->request->getPost("name");
            $existSection = Section::find(array("conditions" => "name=?1",
                "bind" => array(1 => $sectionName)));
            if (count($existSection) == 0) {
                $section = new Section();
                $section->name = $sectionName;
                if ($section->save()) {
                    $ans['id'] = $section->id;
                    echo json_encode($ans);

                } else {
                    foreach ($section->getMessages() as $message) {
                        throw new BaseException($message, 100);
                    }
                }
            } else {
                throw new BaseException('栏目已存在', 101);
            }
           /* try {


            } catch (BaseException $e) {

            }*/
        }
    }


    public function deleteSectionAction()
    {
        if ($this->request->isPost() == true) {
            $ans=[];
            $sectionNames = $this->request->getPost("name");
            foreach ($sectionNames as $sectionItem) {
                $existSection = Section::find(array("conditions" => "name=?1",
                    "bind" => array(1 => $sectionItem)));
                if (count($existSection) == 0) {
                    $ans['ret']=-1;
                    $ans['error']=105;
                    echo json_encode($ans);
                    throw new BaseException('栏目不存在', 105);

                } else {
                    if ($existSection->delete() == true) {
                        $ans['ret']=0;
                        echo json_encode($ans);
                    } else {
                        foreach ($existSection->getMessages() as $message) {
                            throw new BaseException($message, 100);
                        }
                    }
                }
            }

        }
    }


    public function putSectionAction($name)
    {
        if ($this->request->isPost() == true) {
            $ans = [];
            try {


                $sectionNewName = $this->request->getPost("name");
                $oldSection = Section::findFirst("name='$name'");
                if ($oldSection == false) {
                    $ans['id']=-1;
                    $ans['error']=105;
                    throw new BaseException('栏目不存在', 105);
                } else {

                    $oldSection->name = $sectionNewName;
                    if ( $oldSection->save()) {
                        $ans['id']=$oldSection->id;
                        echo json_encode($ans);
                       } else {
                        $ans['id']=-1;
                        $ans['error']=102;

                        throw new BaseException('栏目不存在', 105);
                    }

                }
            } catch (BaseException $e) {
                echo json_encode($ans);
            }
        }
    }

    public function  getSectionAction()
    {
        if ($this->request->isPost() == true) {
            $sections = Section::find();
            foreach ($sections as $sectionItem) {

            }


        }
    }


}
