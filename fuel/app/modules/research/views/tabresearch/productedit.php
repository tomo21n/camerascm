<?php echo Form::open(array("class"=>"form-horizontal")); ?>

    <fieldset class="col-md-12">
        <div class="form-group">
            <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($product) ? $product->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product name')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('カテゴリ', 'category', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
                    <?php echo Form::select('category', Input::post('category', isset($product) ? $product->category : ''), \Ebay\Controller_Product::$category,array('class' => 'col-md-4 form-control', 'placeholder'=>'Category')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('メーカー', 'maker', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
                    <?php echo Form::select('maker', Input::post('maker', isset($product) ? $product->maker : ''), \Ebay\Controller_Product::$maker,array('class' => 'col-md-4 form-control', 'placeholder'=>'Maker')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('モデル', 'model', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
                    <?php echo Form::input('model', Input::post('model', isset($product) ? $product->model : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Model')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('オプション', 'option', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('option_1', Input::post('option_1', isset($product) ? $product->option_1 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Option_1')); ?>
                </div>
                <div class="col-md-4">
                    <?php echo Form::input('option_2', Input::post('option_2', isset($product) ? $product->option_2 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Option_2')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('入口価格', 'in_price', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('in_upper_price', Input::post('in_upper_price', isset($product) ? $product->in_upper_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'In_upper_price')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::input('in_mean_price', Input::post('in_mean_price', isset($product) ? $product->in_mean_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'In_mean_price')); ?>
                </div>
                <div class="col-md-3">
                    <?php echo Form::input('in_lower_price', Input::post('in_lower_price', isset($product) ? $product->in_lower_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'In_lower_price')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('出口価格', 'out_price', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('out_upper_price', Input::post('out_upper_price', isset($product) ? $product->out_upper_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'In_upper_price')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::input('out_mean_price', Input::post('out_mean_price', isset($product) ? $product->out_mean_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'In_mean_price')); ?>
                </div>
                <div class="col-md-3">
                    <?php echo Form::input('out_lower_price', Input::post('out_lower_price', isset($product) ? $product->out_lower_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'In_lower_price')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('出口売り足', 'out_search_count', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('out_search_count', Input::post('out_search_count', isset($product) ? $product->out_search_count : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'out_search_count')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('備考', 'comment', array('class'=>'col-md-3 control-label')); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Form::input('comment', Input::post('comment', isset($product) ? $product->comment : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'comment')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
    </fieldset>
<?php echo Form::close(); ?>