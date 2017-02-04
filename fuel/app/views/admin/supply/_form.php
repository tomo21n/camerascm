<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($supply) ? $supply->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supply id', 'supply_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('supply_id', Input::post('supply_id', isset($supply) ? $supply->supply_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Auction id', 'auction_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('auction_id', Input::post('auction_id', isset($supply) ? $supply->auction_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Auction id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supply channel', 'supply_channel', array('class'=>'control-label')); ?>

				<?php echo Form::input('supply_channel', Input::post('supply_channel', isset($supply) ? $supply->supply_channel : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply channel')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supplier id', 'supplier_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('supplier_id', Input::post('supplier_id', isset($supply) ? $supply->supplier_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supplier id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Auction title', 'auction_title', array('class'=>'control-label')); ?>

				<?php echo Form::input('auction_title', Input::post('auction_title', isset($supply) ? $supply->auction_title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Auction title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supply price', 'supply_price', array('class'=>'control-label')); ?>

				<?php echo Form::input('supply_price', Input::post('supply_price', isset($supply) ? $supply->supply_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply price')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supply tax', 'supply_tax', array('class'=>'control-label')); ?>

				<?php echo Form::input('supply_tax', Input::post('supply_tax', isset($supply) ? $supply->supply_tax : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply tax')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supply shipping', 'supply_shipping', array('class'=>'control-label')); ?>

				<?php echo Form::input('supply_shipping', Input::post('supply_shipping', isset($supply) ? $supply->supply_shipping : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply shipping')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Supply cost', 'supply_cost', array('class'=>'control-label')); ?>

				<?php echo Form::input('supply_cost', Input::post('supply_cost', isset($supply) ? $supply->supply_cost : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply cost')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Product id', 'product_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('product_id', Input::post('product_id', isset($supply) ? $supply->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Condition', 'condition', array('class'=>'control-label')); ?>

				<?php echo Form::input('condition', Input::post('condition', isset($supply) ? $supply->condition : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Condition')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Comment', 'comment', array('class'=>'control-label')); ?>

				<?php echo Form::input('comment', Input::post('comment', isset($supply) ? $supply->comment : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Comment')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>