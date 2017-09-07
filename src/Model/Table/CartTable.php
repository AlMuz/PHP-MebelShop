<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Cart Model
 *
 * @method \App\Model\Entity\Cart get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cart findOrCreate($search, callable $callback = null, $options = [])
 */
class CartTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cart');
        $this->setDisplayField('idCart');
        $this->setPrimaryKey('idCart');
        $this->belongsToMany('Product');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('idCart')
            ->allowEmpty('idCart', 'create');

        $validator
            ->integer('FullPrice')
            ->requirePresence('FullPrice', 'create')
            ->notEmpty('FullPrice');

        $validator
            ->integer('Quantity')
            ->requirePresence('Quantity', 'create')
            ->notEmpty('Quantity');

        $validator
            ->integer('Product_idProduct')
            ->requirePresence('Product_idProduct', 'create')
            ->notEmpty('Product_idProduct');

        return $validator;
    }

    public function addProduct($productId) {
  		$allProducts = $this->readProduct();
  		if (null!=$allProducts) {
  			if (array_key_exists($productId, $allProducts)) {
  				$allProducts[$productId]++;
  			} else {
  				$allProducts[$productId] = 1;
  			}
  		} else {
  			$allProducts[$productId] = 1;
  		}

  		$this->saveProduct($allProducts);
  	}

  	/*
  	 * get total count of products
  	 */
  	public function getCount() {
  		$allProducts = $this->readProduct();

  		if (count($allProducts)<1) {
  			return 0;
  		}

  		$count = 0;
  		foreach ($allProducts as $product) {
  			$count=$count+$product;
  		}

  		return $count;
  	}

  	/*
  	 * save data to session
  	 */
  	public function saveProduct($data) {
  		return $session->write('cart',$data);
  	}

  	/*
  	 * read cart data from session
  	 */
  	public function readProduct() {
      $cart = $this->request->session()->read('carts');
  		return $cart;
  	}

}
