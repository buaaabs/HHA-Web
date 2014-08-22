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

            $sectionNames = $this->request->getPost("name");
            foreach ($sectionNames as $sectionItem) {
                $existSection = Section::find(array("conditions" => "name=?1",
                    "bind" => array(1 => $sectionItem)));
                if (count($existSection) == 0) {
                    throw new BaseException('栏目不存在', 105);
                    echo json_encode(-1);
                } else {
                    if ($existSection->delete() == true) {
                        echo json_encode(0);
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
                    throw new BaseException('栏目不存在', 105);
                } else {
                    $oldSection->name = $sectionNewName;
                    $oldSection->save();
                }
            } catch (BaseException $e) {

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
