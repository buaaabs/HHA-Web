<?php
/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/22/14
 * Time: 11:35 AM
 */

class SysMessageController extends \Phalcon\Mvc\Controller{

    public  function sendSysMessageAction(){
        if ($this->request->isPost() == true) {
            $ans = [];

            $acceptIds = $this->request->getPost("auth-group");
            $messageContent = $this->request->getPost("data");
            $messageTilte = $this->request->getPost("title");
            $messageType = 1; //系统消息

            $successCount = 0;
            $curUserId = $this->session->get('userId');
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
                        if ($InsertMessage->save == true) {
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
}