<?php
class FileUploader  
{
    private static $target_directory = "uploads/";
    private static $size_limit = 50000;//Size in bytes
    private $uploadOk = false;
    private $file_original_name;
    private $file_type;
    private $file_size;
    private $final_file_name;
    private $tmp_name;
    private $err_message = [];

    

    public function getTargetDIrectory()        
    {
        return self::$target_directory;
    }

     public function setOriginalName( $name)
    {
        $this->file_original_name = $name;

    }
    public function getOriginalName()
    {
        return $this->file_original_name;
    }
    public function setFileType($name)
    {
        $path = $name;
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $this->file_type = strtolower($extension);
    }
    public function getFileType(){
       
        return $this->file_type;
    }
    public function getFileSize()   
    {
        return $this->file_size;
    }
    public function setFileSize($size)   
    {
         $this->file_size = $size;
    }
    public function setFinalName($final_name)
    {
        $this->final_file_name = $final_name;
    }
    public function getFinalName()
    {
        return $this->final_file_name;
    }
    public function getTmp_name($tmp_name){
        return $this->tmp_name;
    }
    public function setTmp_name($tmp_name){
         $this->tmp_name= $tmp_name;
    }
     public function uploadFile(){
            if($this->fileTypeIsCorrect() && $this->fileSizeIsCorrect() && (!$this->fileAlreadyExists())){
                 $this->uploadOk = true;
            }
            else{
                $this->uploadOk = false;
            }
         
        return $this->uploadOk;
     }
     public function fileAlreadyExists()
     {
        $path = self::$target_directory.$this->file_original_name;

         if(file_exists($path)){
            $msg = "File Already exists. Please try Again!!." ;
            array_push($this->err_message,$msg);
            return true;
         }
         else{
             return false;
         }

     }
     public function saveFilePathTo()
     {
        return $this->file_original_name;
    }
     public function moveFile()
     {
         
         //!This should change to file fianl name
         $destination = self::$target_directory.$this->file_original_name;
        //  if($this->uploadOk){
        return move_uploaded_file($this->tmp_name, $destination);
        
         
     }
     public function fileTypeIsCorrect()
     {
         $extensions_arr = array("jpg","jpeg","png","gif");
         if(in_array($this->file_type, $extensions_arr)){
             return true;
         }
         else{
            $msg = "Please ensure your file is an image!!" ;
            array_push($this->err_message,$msg);
            return false;
         }
     }
     public function fileSizeIsCorrect()
     {
        if($this->file_size <= self::$size_limit){
            return true;
        }    
        else{
            $msg = "Please ensure the image is less than ".self::$size_limit."(50kb)!!";
            array_push($this->err_message,$msg);
            return false;
        }    
        
     }
     public function fileWasCorrected()
     {
         # code...
     }
     public function getErr_message(){
         return $this->err_message[0];
     }


}

?>