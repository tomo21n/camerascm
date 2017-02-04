<div class="col-md-6">
    <?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
        <div class="form-group">
            <?php echo Form::label('プロモーションID', 'promotion_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('promotion_id', Input::post('promotion_id', isset($promotion) ? $promotion->promotion_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'promotion_id','readonly'=>'readonly')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('プロモーション名', 'promotional_sale_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-5">
                    <?php echo Form::input('promotional_sale_name', Input::post('promotional_sale_name', isset($promotion) ? $promotion->promotional_sale_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'promotional_sale_name')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('プロモーションタイプ', 'promotional_sale_type', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('promotional_sale_type', Input::post('promotional_sale_type', isset($promotion) ? $promotion->promotional_sale_type : 'Percentage'), \Ebay\Controller_Promotion::$promotional_sale_type,array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<?php echo Form::label('値引きタイプ', 'discount_type', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('discount_type', Input::post('discount_type', isset($promotion) ? $promotion->discount_type : ''), \Ebay\Controller_Promotion::$discount_type,array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('値引き値', 'discount_value', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
				<?php echo Form::input('discount_value', Input::post('discount_value', isset($promotion) ? $promotion->discount_value : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'discount_value')); ?>
                </div>
            </div>
		</div>

		<div class="form-group">
			<?php echo Form::label('開始日', 'promotional_sale_starttime', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-5">
                    <input type="datetime-local" name='promotional_sale_starttime' value="<?php echo Input::post('promotional_sale_starttime', isset($promotion) ? $promotion->promotional_sale_starttime : ''); ?>" class='col-md-4 form-control' placeholder ='promotional_sale_starttime' >
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('終了日', 'promotional_sale_endtime', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-5">
                    <input type="datetime-local" name='promotional_sale_endtime' value="<?php echo Input::post('promotional_sale_endtime', isset($promotion) ? $promotion->promotional_sale_endtime : ''); ?>" class='col-md-4 form-control' placeholder ='promotional_sale_endtime' >
                </div>
            </div>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
</div>
<div class="col-md-6">
    <table class="table table-bordered">
        <tbody id="detailtable">

        </tbody>
    </table>
</div>