<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class OrdersController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'contain' => ['User'],
            'order' => [
              'Orders.Status' => 'asc',
              'Orders.Created' => 'asc'
            ]
        ];
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }

    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['User', 'OrderItem']
        ]);

        $this->set('order', $order);
    }

    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['User']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $user = $this->Orders->User->find('list', ['limit' => 200]);
        $this->set(compact('order', 'user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
