<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserShopRelistCron Controller
 *
 * @property \App\Model\Table\UserShopRelistCronTable $UserShopRelistCron
 */
class UserShopRelistCronController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Shops']
        ];
        $userShopRelistCron = $this->paginate($this->UserShopRelistCron);

        $this->set(compact('userShopRelistCron'));
        $this->set('_serialize', ['userShopRelistCron']);
    }

    /**
     * View method
     *
     * @param string|null $id User Shop Relist Cron id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userShopRelistCron = $this->UserShopRelistCron->get($id, [
            'contain' => ['Users', 'Shops']
        ]);

        $this->set('userShopRelistCron', $userShopRelistCron);
        $this->set('_serialize', ['userShopRelistCron']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopRelistCron = $this->UserShopRelistCron->newEntity();
        if ($this->request->is('post')) {
            $userShopRelistCron = $this->UserShopRelistCron->patchEntity($userShopRelistCron, $this->request->data);
            if ($this->UserShopRelistCron->save($userShopRelistCron)) {
                $this->Flash->success(__('The user shop relist cron has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop relist cron could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopRelistCron->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopRelistCron->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopRelistCron', 'users', 'shops'));
        $this->set('_serialize', ['userShopRelistCron']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Shop Relist Cron id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userShopRelistCron = $this->UserShopRelistCron->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userShopRelistCron = $this->UserShopRelistCron->patchEntity($userShopRelistCron, $this->request->data);
            if ($this->UserShopRelistCron->save($userShopRelistCron)) {
                $this->Flash->success(__('The user shop relist cron has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop relist cron could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopRelistCron->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopRelistCron->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopRelistCron', 'users', 'shops'));
        $this->set('_serialize', ['userShopRelistCron']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Shop Relist Cron id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userShopRelistCron = $this->UserShopRelistCron->get($id);
        if ($this->UserShopRelistCron->delete($userShopRelistCron)) {
            $this->Flash->success(__('The user shop relist cron has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop relist cron could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
