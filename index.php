<?php
header("Content-Type:application/json");
#includinl class responsible for carring request
include('requestClass.php');


if(!empty($_GET['name'])){
    $name=$_GET['name'];
    $id="";
    
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
    }
    $request = new REQUEST($name,$id);
    $req = $request->getRequest();
    
    
    if(empty($req)){
       deliver_response(200,"Request not found", NULL);
    }else{
       deliver_response(200,"Request found", $req); 
    }

}else{
    deliver_response(400,"Error. Please provide proper request eg. ('yourdomain.com/ping','yourdomain.com/system','yourdomain.com/mediainfo/{number}')",NULL);
}


function deliver_response($status,$status_message,$data){
    header("HTTP/1.1 $status $status_message");
    
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
    
    $json_response = json_encode($response);
    echo $json_response;
}
?>
