<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use pedrovalmor\AclManager\Event\PermissionsEditor;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{

    public $helpers = [            
        'AclManager' => [
            'className' => 'pedrovalmor/AclManager.AclManager'
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $groups = $this->paginate($this->Groups);

        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                // デフォルトアクセス全許可にしたい場合は下記のコメントアウトを外す
                //if (isset($this->request->data['parent_id'])) {
                //    $parent = $this->request->data['parent_id'];
                //} else {
                //    $parent = null;
                //}
                //$this->eventManager()->on(new PermissionsEditor());
                //$perms = new Event('Permissions.addAro', $this, [
                //    'Aro' => $group,
                //    'Parent' => $parent,
                //    'Model' => 'Groups'
                //]);
                //$this->eventManager()->dispatch($perms);

                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
    
        $this->loadComponent('pedrovalmor/AclManager.AclManager');
        $EditablePerms = $this->AclManager->getFormActions();
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
    
                $this->eventManager()->on(new PermissionsEditor());
                $perms = new Event('Permissions.editPerms', $this, [
                    'Aro' => $group,
                    'datas' => $this->request->data
                ]);
                $this->eventManager()->dispatch($perms);
    
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('group', 'EditablePerms'));
        $this->set('_serialize', ['group', 'EditablePerms']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
