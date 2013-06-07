<?php
App::uses('AppController', 'Controller');
App::uses('AdminComment', 'active_admin.Model');

/**
 * AdminComments Controller
 *
 * @author Jared Bowles (jaredb7)
 * @package active_admin
 * @version 0.0.1
 */
class AdminCommentsController extends ActiveAdminAppController
{

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->AdminComment->recursive = 0;
        $filter = $this->Filter->process($this);
        $this->set('comments', $this->Paginator->paginate(null, $filter));
//        $this->set('comments', $this->Paginator->paginate());
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        //Has commenting been disabled
        if (Configure::read('ActiveAdmin.allow_comments') == true) {
            if ($this->request->is('post')) {
                $this->AdminComment->create();
                if ($this->AdminComment->save($this->request->data)) {
                    $this->Session->setFlash(__('Comment has been successfully added.'));

                    $this->redirect($this->referer());
                } else {
                    $this->Session->setFlash(__('Comment could not be saved. Please, try again.'), 'default', array('class' => 'error-message'));
                }
            } else {
                $this->redirect(array('action' => 'index'));
            }

            $this->set(compact('timetables', 'routeCodes'));
        } else {
            $this->Session->setFlash(__('Comment could not be added. Commenting has been disabled.'), 'default', array('class' => 'error-message'));
            $this->redirect($this->referer());
        }
    }
}