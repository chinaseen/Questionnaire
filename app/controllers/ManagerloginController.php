<?php

class ManagerloginController extends Base
{
    public function initialize()
    {
          $this->view->setTemplateAfter('base1');
    }

    public function indexAction()
    {

    }

    public function loginAction()
    {
        $username = $this->request->getPost("username", "string");
        $password = $this->request->getPost("password", "string");
        $manager = Manager::checkLogin($username, $password);

        if ($manager === 0)
        {
            $this->view->setVar('error', '密码不正确');
             $this->view->setTemplateAfter('blank');
            $this->view->pick('managerlogin/error');
            return;
        }

        if ($manager === -1)
        {
            $this->view->setVar('error', '用户不存在');
             $this->view->setTemplateAfter('blank');
            $this->view->pick('managerlogin/error');
            return;
        }
        if ($manager != 0)
        {
            $this->session->set('Manager', $manager);
            $this->response->redirect('index');

	        switch ($manager->role) {
	        	case 'M': // 管理员
	        		# code...
	        		break;
	        	case 'P': // 项目经理

	        		break;
	        	case 'L':  // 领导

	        		break;

	        	case 'I': // 面询专家
	        		break;

	        	default:
	        		$this->forward('managerlogin', 'index');
	        		break;
        	}
        }
    }

    public function logoutAction()
    {
    	
    }

}

