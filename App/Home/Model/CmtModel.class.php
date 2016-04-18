<?php
namespace Home\Model;
use Think\Model;

class CmtModel extends Model {
	public function get_cmt($id){
		$cmtList = $this->where("needid=$id and pid=0")->select();
		foreach($cmtList as &$cmt){
			$cmt['time']=substr($cmt['time'],5,5);
			if($secList = $this->where("pid=$cmt[id]")->select())
				foreach($secList as &$scmt){
					$scmt['time']=substr($scmt['time'],5,5);
				}
				$cmt['child'] = $secList;
		}
		return $cmtList;
	}
}