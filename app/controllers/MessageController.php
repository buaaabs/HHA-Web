<?php

/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/21/14
 * Time: 7:40 PM
 */
class MessageController extends \Phalcon\Mvc\Controller
{

    public function sendAction()
    {

        if ($this->request->isPost() == true) {
            $ans = [];

            $acceptIds = $this->request->getPost("to_id");
            $messageContent = $this->request->getPost("data");
            $messageTilte = $this->request->getPost("title");
            $messageType = 0;

            $successCount = 0;
//            $curUserId = $this->session->get('userId');
            $curUserId = 1; //测试用的id
            if ($curUserId != null) {

                foreach ($acceptIds as $userId) {
                    $existUser = User::find(array("conditions" => "id=?1",
                        "bind" => array(1 => $userId)));
                    if (count($existUser) == 0) {
                        $ans['error'] = 701;

                    } else {
                        $InsertMessage = new Message();
                        $InsertMessage->to_id = $userId;
                        $InsertMessage->from_id = $curUserId;
                        $InsertMessage->type = $messageType;
                        $InsertMessage->data = $messageContent;
                        if ($InsertMessage->save() == true) {
                            $successCount++;
                        } else {
                            foreach ($InsertMessage->getMessages() as $message) {
                                throw new BaseException($message, 100);
                            }
                        }

                    }

                }


                if ($successCount == count($acceptIds)) {
                    $ans['ret'] = -1;

                } else {
                    $ans['ret'] = $successCount;
                }

            } else {
                $ans['error'] = 103;
                $ans['ret'] = 0;

            }

            echo json_encode($ans);
        }
    }


    public function getAction($to_id)
    {
        if ($this->request->isPost() == true) {

            $ans = [];
            $ans['ret'] = -1;
            $messages = Message::find(array("conditions" => "to_id=?1",
                "bind" => array(1 => $to_id)));
            $mindex = 0;
            $data = array();
            foreach ($messages as $itemMsg) {

                $data[$mindex] = ['id' => $itemMsg->id, 'from_id' => $itemMsg->from_id, 'type' => $itemMsg->type, 'data' => $itemMsg->data, 'time' => $itemMsg->time];
                $mindex++;
                $ans['ret'] = 0;
            }
            $ans['data'] = $data;

            echo json_encode($ans);
        }
    }


    public function deleteAction()
    {
        if ($this->request->isPost() == true) {
            $ans = [];

            $acceptIds = $this->request->getPost("ids");
            foreach ($acceptIds as $itemId) {
                $tempMessage = Message::findFirst("id='$itemId'");
                if ($tempMessage == false) {
                    $ans['error'] = 104;
                    $ans['ret'] = -1;
                    throw new BaseException('要删除的消息不存在', 104);
                } else {
                    if ($tempMessage->delete()) {
                        $ans['ret'] = 0;
                    } else {
                        $ans['error'] = 102;
                        $ans['ret'] = -1;
                        throw new BaseException('数据库异常', 102);
                    }
                }

            }


            echo json_encode($ans);
        }
    }


}