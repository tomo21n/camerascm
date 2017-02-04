<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
        <div class="form-group">
			<?php echo Form::label('ID', 'Specific Id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-1">
				<?php echo Form::input('specific_id', Input::post('specific_id', isset($itemspecific) ? $itemspecific->specific_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'specific_id')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('Product', 'product_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-1">
                    <?php echo Form::input('product_id', Input::post('product_id', isset($itemspecific) ? $itemspecific->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_id')); ?>
                </div>
                <div class="col-md-4">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($itemspecific) ? $itemspecific->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_name')); ?>
                </div>
            </div>
        </div>

        <div class="form-block" id="form_block[0]">
                <!-- Closeボタン -->
            <span class="close" title="Close" style="display: none;">DELETE</span>
            <div class="form-group">
                <?php echo Form::label('値', 'value', array('class'=>'col-md-2 control-label')); ?>
               <div class="row">
                   <div class="col-md-2">
                        <?php echo Form::input('name[0]', Input::post('name', isset($itemspecific) ? $itemspecific->name : ''),array('class' => 'col-md-4 form-control', 'placeholder'=>'name')); ?>
                    </div>
                    <div class="col-md-1">
                        <?php echo Form::input('value[0]', Input::post('value', isset($itemspecific) ? $itemspecific->value : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'value')); ?>
                    </div>
               </div>
           </div>
        </div>
            <!-- Addボタン -->
        <div class="form-group">
            <?php echo Form::label('', 'value', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::label('ADD', '', array('class'=>'btn btn-primary add control-label')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>

<script>
    $(function () {
        var frm_cnt = 0;

        $(document).on('click', '.add', function(){
            var original = $('#form_block\\[' + frm_cnt + '\\]');
            var originCnt = frm_cnt;
            var originVal = $("input[name='sex\\[" + frm_cnt + "\\]']:checked").val();

            frm_cnt++;

            original
                .clone()
                .hide()
                .insertAfter(original)
                .attr('id', 'form_block[' + frm_cnt + ']') // クローンのid属性を変更。
                .find("input[type='radio'][checked]").prop('checked', true)
                .end() // 一度適用する
                .find('input, textarea').each(function(idx, obj) {
                    $(obj).attr({
                        id: $(obj).attr('id').replace(/\[[0-9]\]+$/, '[' + frm_cnt + ']'),
                        name: $(obj).attr('name').replace(/\[[0-9]\]+$/, '[' + frm_cnt + ']')
                    });
                    if ($(obj).attr('type') == 'text') {
                        $(obj).val('');
                    }
                });

            // clone取得
            var clone = $('#form_block\\[' + frm_cnt + '\\]');
            clone.children('span.close').show();
            clone.slideDown('slow');

            // originalラジオボタン復元
            original.find("input[name='sex\\[" + originCnt + "\\]'][value='" + originVal + "']").prop('checked', true);
        });

        $(document).on('click', '.close', function(){
            var removeObj = $(this).parent();
            removeObj.fadeOut('fast', function() {
                removeObj.remove();
                // 番号振り直し
                frm_cnt = 0;
                $(".form-block[id^='form_block']").each(function(index, formObj) {
                    if ($(formObj).attr('id') != 'form_block[0]') {
                        frm_cnt++;
                        $(formObj)
                            .attr('id', 'form_block[' + frm_cnt + ']') // id属性を変更。
                            .find('input, textarea').each(function(idx, obj) {
                                $(obj).attr({
                                    id: $(obj).attr('id').replace(/\[[0-9]\]+$/, '[' + frm_cnt + ']'),
                                    name: $(obj).attr('name').replace(/\[[0-9]\]+$/, '[' + frm_cnt + ']')
                                });
                            });
                    }
                });
            });
        });
    });

</script>