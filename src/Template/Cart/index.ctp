<?php $this->assign('title', 'Shopping cart - '.$maintitle);?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb" style="margin-bottom: 10px">
			<li>
				<?= $this->Html->link('Home','/');?>
			</li>
			<li class="active">
        <?= 'Cart';?>
			</li>
		</ol>
	</div>
</div>
<div class="col-md-12" style="margin-bottom: 20px">
  <h1>Shopping Cart</h1>
	<hr>
  <?php if(empty($shop['OrderItem'])) : ?>
    <h2 style="padding-left:10px">Shopping Cart is empty</h2>
  <?php else: ?>
    <?= $this->Form->create(NULL, array('url' => array('controller' => 'cart', 'action' => 'cartupdate'))); ?>
    <hr>
    <div class="row">
      <div class="col col-sm-7">ITEM</div>
      <div class="col col-sm-1">PRICE</div>
      <div class="col col-sm-1">QUANTITY</div>
      <div class="col col-sm-1">TOTAL</div>
      <div class="col col-sm-1">ACTION</div>
      <br>
    </div>
		<br>

		<!-- for quantity, every quantity input will go after previous tabindex  -->
		<?php $tabindex = 1; ?>

    <?php foreach ($shop['OrderItem'] as $key => $item): ?>
      <div class="row" id="row-<?= $key; ?>">
        <div class="col col-sm-7">
            <strong>
              <?= $this->Html->link($item['name'], array('controller' => 'product', 'action' => 'view', $item['product_id'])); ?>
            </strong>
        </div>
        <div class="col col-sm-1">
          <?= $this->Number->currency($item['price'], $currency); ?>
        </div>
        <div class="col col-sm-1">
					 <?= $this->Form->input('quantity-' . $key, array('div' => false, 'class' => 'numeric form-control input-small', 'label' => false, 'size' => 2, 'maxlength' => 2, 'tabindex' => $tabindex++, 'data-id' => $item['product_id'], 'value' => $item['quantity'])); ?>
        </div>
        <div class="col col-sm-1">
          <?= $this->Number->currency($item['total'], $currency); ?>
        </div>
        <div class="col col-sm-1">
          <?= $this->Html->link('Delete', array('controller' => 'cart', 'action' => 'remove', $key),['confirm' => __('Are you sure you want to delete this product from cart?')]); ?>
        </div>
      </div>
      <hr>
    <?php endforeach; ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="pull-right" style="float:right">
        <?= $this->Html->link('Clear Shopping Cart', array('controller' => 'Cart', 'action' => 'clear'), array('class' => 'btn btn-sm btn-danger', 'escape' => false,'confirm' => __('Are you sure you want to clear all your cart?' ))); ?>
        <?= $this->Form->button('Update', array('class' => 'btn btn-sm btn-default', 'escape' => false));?>
        <?= $this->Form->end(); ?>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class=" pull-right">
        Order Total: <span class="red" id="total"><?= $this->Number->currency($shop['Order']['total'], $currency); ?></span>
        <br />
			  Total weight: <span class="red" id="total"><?= ($shop['Order']['weight']); ?> KG</span>
				<br />
				<br />
        <?= $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'step1'))); ?>
      		<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="submit" />
        <?= $this->Form->end(); ?>
      </div>
    </div>
  <?php endif; ?>
</div>



<style media="screen">

@media screen and (max-width: 600px) {

}

</style>