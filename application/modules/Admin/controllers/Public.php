<?php
class PublicController extends AdminBase{

    public function init()
    {
    }


    public function loginAction(){
        $this->getView()->assign('id',1);
        $this->displays();
    }

}