<?php //这是测试的控制器，可以删除。
class myinformationModel extends Model
{
    public function unionSelectAll_information($userId)
    {
    	$sql = "select * from `pmanage` left join `zmanage`  on `pmanage`.pManagePosition=`zmanage`.zManageId left join `bmanage` on `zmanage`.zManageBranch =`bmanage`.bManageId WHERE `pmanage`.pManageId = $userId";
    	$sth = $this->_dbHandle->prepare($sql);
    	$sth->execute();

        return $sth->fetchAll();
    }
}