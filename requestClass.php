<?php
class REQUEST{
    private $url = '';
    private $imageTitle = '';
    private $imageDimensions = array();
    private $fileName = '';
    private $fileSize = '';
    private $request = '';
    private $requestIdValue = '';
    
    public function __construct($name,$id){
        $this->request = $name;
        $this->requestIdValue = $id;
        
    }
    #this public method is only one called from outside, response is created based on variables passed to constructor
    public function getRequest(){
        if($this->request == 'ping'){
            return $this->getPong();
        }
        elseif($this->request == 'system'){
            return $this->getSysInfo();
        }
        elseif($this->request == 'mediainfo'){
            if(is_numeric($this->requestIdValue)){
                $this->url = 'https://www.pond5.com/photo/'.$this->requestIdValue.'/';
                return $this->createResponse();                
            }else{
                return "Id should be a number";
            }

        }else{
            return "Wrong request name you can use | ping | , | system | or | mediainfo/id=number |";
        }
    }
    //get pong request
    private function getPong(){
        return 'pong';
    }
    
    //get system info request
    private function getSysInfo(){
        $array = array('version' => phpversion(),
                       'system info' =>array('server name' => $_SERVER['SERVER_NAME'],
                                             'server software' => $_SERVER['SERVER_SOFTWARE'],
                                             'browser' => $_SERVER['HTTP_USER_AGENT']
                                             )
                       
                       );
        return $array;
    }
    # imagefile setter 
    private function setImageTitle($title){
        $this->imageTitle = $title;
    }
    
    # fileName setter
    private function setFileName($fileName){
        $this->fileName = $fileName;
    }
    
    #file size setter, values are stored in array
    private function setDimensions(){
        list($width, $height) = getimagesize($this->fileName);
        $this->imageDimensions = array('width'=>$width,
                                       'height'=>$height);
        
    }
    #setting file size based on information send by header
    private function setFileSize(){
        $headers = get_headers($this->fileName);
        $this->fileSize = round(str_replace('Content-Length: ','',$headers[2])/1024,2);
    }
    
    #removing URL part from image file addres to get file name in format name.extension
    private function getPlainFileName(){
        return str_replace("https://images.pond5.com/","",$this->fileName);    
    }
    
    #creating response array method
    private function createResponse(){
        #scraping metatag to get IMAGE TITLE and FULL PATH INC FILE NAME 
        $metaTag = get_meta_tags($this->url);

        
        $this->setImageTitle($metaTag["sailthru_title"]); #setting up title
        $this->setFileName($metaTag["sailthru_image_full"]); #setting up full file name
        $this->setDimensions(); #setting up image dimensions
        
        $this->setFileSize(); #setting up file size in kB
        
        #create response array based on properties
        $array = array('title' => $this->imageTitle,
                       'dimensions' => $this->imageDimensions,
                       'filename' => $this->getPlainFileName(),
                       'file size in kB' => $this->fileSize
              );
        
        return $array;
    }
}
?>

