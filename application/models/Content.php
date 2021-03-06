<?php

class Model_Content extends Zend_Db_Table_Abstract
{
	protected $_name = 'content';
	
	public function addData($data){
                   $row = $this->createRow();
				   
				   $row->guid = uniqid('acild-content-');
				   
                   $row->setFromArray($data);
                   //save the new row
                   return $row->save();
           }
	
	public function updateData($id, $data)
		 {
			
			$select = $this->select()
						->where('id=?',$id);
			$rows= $this->fetchAll($select);
			if(!empty($rows)){
				foreach ($rows as $row) {
				$row->setFromArray($data);
				//save the new row
				return $row->save();
				}
				return TRUE;
			}else{
				return FALSE;
			}
	       
		 }
		 
		  public function fetchData(){
		 	$select = $this->select()
					->where('deleted=?',0)
					->order('dateentered DESC');
			return $this->fetchAll($select);
		 }
		  public function fetchDataByOrg($org){
		 	if($org==1 ){
		 		$select = $this->select()
					->where('deleted=?',0)
					->order('dateentered DESC');
				return $this->fetchAll($select);
		 	}else{
		 		$select = $this->select()
					->where('organization=?',$org)
					->where('deleted=?',0)
					->order('dateentered DESC');
			return $this->fetchAll($select);
		 	}	
		 	
		 }
	  
	  public function fetchDataByGuid($guid){
	  	$select = $this->select()
				->where('guid=?',$guid);
		return $this->fetchRow($select);
	  }
		  
		  
}

