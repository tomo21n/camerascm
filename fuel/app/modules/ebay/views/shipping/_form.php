<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
        <div class="form-group">
			<?php echo Form::label('名前', 'Shipping Name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
				<?php echo Form::input('shipping_name', Input::post('shipping_name', isset($shipping) ? $shipping->shipping_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Shipping name')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('除外国', 'Exclude location', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Shipping::$shipping_location as $locationkey => $locationvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('exclude_location[]', $locationkey,'',array('id'=>'location',@strstr($shipping->exclude_location, $locationkey)?'checked':'')); ?>
                            <?php echo Form::label($locationvalue, $locationkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('米', 'Domestic Priority 1', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('domestic_service_1', Input::post('domestic_service_1', isset($shipping) ? $shipping->domestic_service_1 : ''), \Ebay\Controller_Shipping::$shipping_service,array('class' => 'col-md-4 form-control', 'placeholder'=>'Domestic service 1')); ?>
                </div>
                <?php echo Form::hidden('domestic_priority_1',1); ?>
                <div class="col-md-1">
                    <?php echo Form::input('domestic_cost_1', Input::post('domestic_cost_1', isset($shipping) ? $shipping->domestic_cost_1 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Domestic cost 1')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('国際1', 'International 1', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('international_service_1', Input::post('international_service_1', isset($shipping) ? $shipping->international_service_1 : ''), \Ebay\Controller_Shipping::$shipping_service,array('class' => 'col-md-4 form-control', 'placeholder'=>'Domestic service 1')); ?>
                </div>
                <?php echo Form::hidden('international_priority_1',1); ?>
                <div class="col-md-1">
                    <?php echo Form::input('international_cost_1', Input::post('international_cost_1', isset($shipping) ? $shipping->international_cost_1 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Domestic cost 1')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
                <?php echo Form::label('', 'International Priority 1', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Shipping::$shipping_location as $locationkey => $locationvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('international_location_1[]', $locationkey,'',array('id'=>'location',@strstr($shipping->international_location_1, $locationkey)?'checked':'')); ?>
                            <?php echo Form::label($locationvalue, $locationkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('国際2', 'International 2', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('international_service_2', Input::post('international_service_2', isset($shipping) ? $shipping->international_service_2 : ''), \Ebay\Controller_Shipping::$shipping_service,array('class' => 'col-md-4 form-control', 'placeholder'=>'International service 2')); ?>
                </div>
                <?php echo Form::hidden('international_priority_2',2); ?>
                <div class="col-md-1">
                    <?php echo Form::input('international_cost_2', Input::post('international_cost_2', isset($shipping) ? $shipping->international_cost_2 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'International cost 2')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('', 'International Priority 2', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Shipping::$shipping_location as $locationkey => $locationvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('international_location_2[]', $locationkey,'',array('id'=>'location',@strstr($shipping->international_location_2, $locationkey)?'checked':'')); ?>
                            <?php echo Form::label($locationvalue, $locationkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('国際3', 'International 3', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('international_service_3', Input::post('international_service_3', isset($shipping) ? $shipping->international_service_3 : ''), \Ebay\Controller_Shipping::$shipping_service,array('class' => 'col-md-4 form-control', 'placeholder'=>'International service 3')); ?>
                </div>
                <?php echo Form::hidden('international_priority_3',3); ?>
                <div class="col-md-1">
                    <?php echo Form::input('international_cost_3', Input::post('international_cost_3', isset($shipping) ? $shipping->international_cost_3 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'International cost 3')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('', '', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Shipping::$shipping_location as $locationkey => $locationvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('international_location_3[]', $locationkey,'',array('id'=>'location',@strstr($shipping->international_location_3, $locationkey)?'checked':'')); ?>
                            <?php echo Form::label($locationvalue, $locationkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('国際4', 'International 4', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('international_service_4', Input::post('international_service_4', isset($shipping) ? $shipping->international_service_4 : ''), \Ebay\Controller_Shipping::$shipping_service,array('class' => 'col-md-4 form-control', 'placeholder'=>'International service 4')); ?>
                </div>
                <?php echo Form::hidden('international_priority_4',4); ?>
                <div class="col-md-1">
                    <?php echo Form::input('international_cost_4', Input::post('international_cost_4', isset($shipping) ? $shipping->international_cost_4 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'International cost 4')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('', '', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Shipping::$shipping_location as $locationkey => $locationvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('international_location_4[]', $locationkey,'',array('id'=>'location',@strstr($shipping->international_location_4, $locationkey)?'checked':'')); ?>
                            <?php echo Form::label($locationvalue, $locationkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('国際5', 'International 5', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('international_service_5', Input::post('international_service_5', isset($shipping) ? $shipping->international_service_5 : ''), \Ebay\Controller_Shipping::$shipping_service,array('class' => 'col-md-4 form-control', 'placeholder'=>'International service 5')); ?>
                </div>
                <?php echo Form::hidden('international_priority_5',5); ?>
                <div class="col-md-1">
                    <?php echo Form::input('international_cost_5', Input::post('international_cost_5', isset($shipping) ? $shipping->international_cost_5 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'International cost 5')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('', '', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Shipping::$shipping_location as $locationkey => $locationvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('international_location_5[]', $locationkey,'',array('id'=>'location',@strstr($shipping->international_location_5, $locationkey)?'checked':'')); ?>
                            <?php echo Form::label($locationvalue, $locationkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>