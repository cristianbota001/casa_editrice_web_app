<?php

require_once("./logic.php");

class Middleware{
    
    function __construct($request){
        $this->request = $request;
        $this->logic = new Logic();
        $this->SwitchRequestMethod();
    }

    private function SwitchRequestMethod(){
        switch ($this->request["REQUEST_METHOD"]){
            case "GET":{
                $this->SwitchMethodGet();
            } break;
            case "POST":{
                $this->SwitchMethodPost();
            } break;
        }
    }

    private function SwitchMethodGet(){
        if (isset($_GET["get_books"])){
            $this->GetBooks();
        }
        else if (isset($_GET["get_authors"])){
            $this->GetAuthors();
        }
    }

    private function SwitchMethodPost(){
        if (isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])){
            $this->RegistrationForm();
        }
        else if (isset($_POST["username"]) && isset($_POST["password1"])){
            $this->LoginForm();
        }else{
            //forbidden response 403
        }
    }

    private function LoginForm(){
        $value = $this->logic->ValidateLoginForm($_POST);
        echo json_encode($value);
    }

    private function RegistrationForm(){
        $value = $this->logic->ValidateRegistrationForm($_POST);
        echo json_encode($value);
    }

    private function GetBooks(){
        $value = $this->logic->GetBooks();
        echo json_encode($value);
    }

    private function GetAuthors(){
        $value = $this->logic->GetAuthors();
        echo json_encode($value);
    }

}

$middleware = new Middleware($_SERVER);

?>