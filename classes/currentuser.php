<?php

class CurrentUser extends Users {
    private $_memberid;



    /**
     * @return mixed
     */
    public function getMemberid()
    {
        return $this->_memberid;
    }

    /**
     * @param mixed $memberid
     */
    public function setMemberid($memberid)
    {
        $this->_memberid = $memberid;
    }
}