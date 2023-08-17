<?php
include 'Models/Model.php';

class Controllers
{
    public $modelObj;
    function __construct()
    {
        $this->modelObj = new Model();
    }
    public function homePage()
    {
        $workerId = (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']['workerID'] > 0) ? $_SESSION['loggedUser']['workerID'] : 0;
        $isAdmin = (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']['isAdmin'] > 0) ? $_SESSION['loggedUser']['isAdmin'] : 0;
        if ($workerId > 0 && $isAdmin == 0) {
            $dataArray = $this->modelObj->getWorkersDataById($workerId);
            include 'View/home.php';
        } elseif ($workerId > 0 && $isAdmin == 1) {
            $dataArray = $this->modelObj->getAllUsersData();
            include 'View/adminHome.php';
        } else {
            echo "<a href='" . BASE_ACTION_URL . "login'>Please Login First</a>";
        }
    }
    public function registerWorkers()
    {
        if (isset($_POST['email'])) {
            $fullName = isset($_POST['full_name']) ? $_POST['full_name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $errors = array();

            $formElements = ['full_name' => $fullName, 'email' => $email, 'password' => $password, 'mobile' => $mobile];
            foreach ($formElements as $key => $value) {
                if (empty(trim($value))) {
                    $errors[$key] = $key . " is required";
                }
            }
            if (empty($errors)) {
                $validateData = $this->validateData($formElements);
                $emailExists = $this->modelObj->verifyEmailExists($email, WORKERS_TABLE);
                if ($emailExists && empty($validateData)) {
                    $res = $this->modelObj->registerWorkers($formElements);
                    $isAdmin = (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']['isAdmin'] > 0) ? $_SESSION['loggedUser']['isAdmin'] : 0;
                    if ($res && $isAdmin == 0) {
                        echo json_encode(array('isadmin'=>'no'));
                        // header("LOCATION: " . BASE_ACTION_URL . "login");
                        exit;
                    } elseif ($res && $isAdmin == 1) {
                        echo json_encode(array('isadmin'=>'yes'));
                        // header("LOCATION: " . BASE_URL);
                        exit;
                    }
                } else {
                    $errors = empty($validateData) ? $emailExists : $validateData;
                    echo json_encode($errors);
                }
            } else {
                echo json_encode($errors);
            }
        } else {
            include 'View/register.php';
        }
    }
    public function loginPage()
    {
        $loggedin = (isset($_SESSION['loggedUser']['workerID']) || isset($_SESSION['loggedUser']['isAdmin'])) ? 1 : 0;
        if ($loggedin == 0) {
            if (isset($_POST['email'])) {
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';

                $formElements = ['email' => $email, 'password' => $password];
                foreach ($formElements as $key => $value) {
                    if (empty($value)) {
                        $errors[$key] = $key . " is required";
                    }
                }

                if (empty($errors)) {
                    $loginResult = $this->modelObj->login($formElements);
                    if ($loginResult != 0) {
                        $_SESSION['loggedUser'] = $loginResult;
                        header("LOCATION: " . BASE_URL);
                    } else {
                        echo "Wrong Credentials";
                        exit;
                    }
                } else {
                    print_r($errors);
                    exit;
                }
            } else {
                include 'View/login.php';
            }
        } else {
            header("LOCATION: " . BASE_URL);
        }
    }

    public function logoutUser()
    {
        // session_start();
        session_destroy();
        header("location: " . BASE_ACTION_URL . "login");
    }

    public function editWorkerData($editId = 0)
    {
        $isAdmin = (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']['isAdmin'] > 0) ? $_SESSION['loggedUser']['isAdmin'] : 0;
        if (isset($editId) && $isAdmin == 1) {
            $workerSessionId = (isset($editId) && $editId > 0) ? $editId : 0;
        } else {
            $workerSessionId = (isset($_SESSION['loggedUser']['workerID']) && $_SESSION['loggedUser']['workerID'] > 0) ? $_SESSION['loggedUser']['workerID'] : 0;
        }
        $ifUserExists = $this->modelObj->getWorkersDataById($workerSessionId);
        
        if ($workerSessionId > 0 && !empty($ifUserExists)) {
            if (isset($_POST['email'])) {
                $fullName = isset($_POST['full_name']) ? $_POST['full_name'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
                $formElements = ['full_name' => $fullName, 'email' => $email, 'password' => $password, 'mobile' => $mobile];
                $updateData = $this->modelObj->updateWorkersData($workerSessionId, $formElements);
                if ($updateData) {
                    header("location: " . BASE_URL);
                }
            } else {
                $dataArray = $this->modelObj->getWorkersDataById($workerSessionId);
                include 'View/editWorkers.php';
                exit;
            }
        } else {
            if($isAdmin){
                header("location: " . BASE_URL);
            }else{
                header("location: " . BASE_ACTION_URL."login");
            }
            // echo "<a href='" . BASE_ACTION_URL . "login'>Please Login</a>";
        }
    }

    public function deleteWorkerData($id)
    {
        $response = $this->modelObj->deleteWorkerData($id);
        if ($response) {
            header("LOCATION: " . BASE_URL);
        }
    }

    public function validateData($formElements)
    {
        $errors = array();
        foreach ($formElements as $key => $value) {
            switch ($key) {
                case 'full_name':
                    if (!preg_match(REGEX_FULL_NAME, $value)) {
                        $errors['full_name'] = 'Please Enter Your Full Name';
                    }
                    break;

                case 'email':
                    if (!preg_match(REGEX_EMAIL, $value)) {
                        $errors['email'] = 'Please Enter Email in proper format';
                    }
                    break;
                case 'mobile':
                    if (!preg_match(REGEX_MOBILE, $value)) {
                        $errors['mobile'] = 'Enter 10 digits only starting from 6-9';
                    }
                    break;
            }
        }
        return $errors;
    }
}
