<?php

/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * classes/currentuser.php
 * Current user class extends user and stores the member id
 **/
class CurrentUser extends Users
{

    //memberid field
    private $_memberid;

    /**
     * getMemberid gets the member id
     * @return int
     */
    public function getMemberid()
    {
        return $this->_memberid;
    }

    /**
     * setMemberid sets the member id
     * @param int $memberid
     */
    public function setMemberid($memberid)
    {
        $this->_memberid = $memberid;
    }
}