<?php
namespace App\Controller;

use App\Controller;

/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 27/03/2018
 * Time: 23:13
 */
class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * IndexAction
     */
    function index()
    {
        if (isset($_SESSION["loggued"])) {
            $this->dashboard();
        }
        $this->login();


    }

    /**
     * RegisterAction
     */
    function register()
    {

        $this->render->model('User');
        $message=null;
        if (isset($_POST["username"]) &&
            $_POST["username"] != "" &&
            isset($_POST["password"]) &&
            $_POST["password"] != ""
        ) {
            $retour =$this->User->create($_POST);
            $message="l'enregistrement a été effectué avec succès";
            if (false == $retour) {

                $message="Utilsateur existe déja";
            }

           // $this->RedirectOut();
        }
        $this->render->view('Register',['message'=>$message]);

    }

    /**
     * LoginAction
     */
    function login()
    {

        $this->render->model('User');
        if (isset($_POST["username"]) &&
            $_POST["username"] != "" &&
            isset($_POST["password"]) &&
            $_POST["password"] != ""
        ) {

            $user = $this->User->findUserByUsernameAndPassword($_POST);
            if (sizeof($user) > 0) {
                $this->setSession($user[0]);
                $this->User->update($user[0]->id, ['connected' => 1]);
                $this->RedirectTo('dashboard');
            }
        }
        $this->render->view('Login');

    }

    /**
     * LogoutAction
     */
    function logout()
    {
        $this->render->model('User');
        $this->User->update($_SESSION['id'], ['connected' => 1]);
        session_destroy();
        $this->Deconnexion();
    }

    /**
     * DashboardAction
     */
    function dashboard()
    {
        if (!isset($_SESSION["loggued"])) {
            $this->Deconnexion();
        }
        $this->_config->getParameters();
        $this->render->model('User');
        $this->render->model('Message');
        if (isset($_POST["message"]) &&
            $_POST["message"] != ""
        ) {
            $this->Message->create(["user"=>$_SESSION['id'],"message"=>$_POST["message"]]);

        }

        $this->render->view('Dashboard',
            [
                'connecteds' => $this->User->findUserConnected(),
                'messages'   => $this->Message->getMessages(),
                'id'         => $_SESSION["id"],
            ]
        );
    }

    /**
     * ConnectedAction
     */
    function connected()
    {
        $this->render->model('User');
        $this->render->view('Connected', ['connecteds' => $this->User->findUserConnected(), 'id' => $_SESSION["id"]]);
    }

    /**
     * ChatAction
     */
    function chat()
    {
        $this->render->model('Message');
        $this->render->view('Chat', ['messages' => $this->Message->getMessages()]);
    }

}