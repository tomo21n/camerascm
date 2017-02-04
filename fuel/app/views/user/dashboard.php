<div class="jumbotron">
	<h1>World Viewing Camera</h1>
	<br /><p>Camera SCM Solution</p>
    <p><a class="btn btn-primary btn-large" href="http://dev.world-viewing.com/ebay/inventory/">→ 在庫一覧</a></p>
</div>
<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>年</th>
            <th>月</th>
            <th>仕入個数</th>
            <th>仕入価格</th>
            <th>月初在庫個数</th>
            <th>月初在庫額</th>
            <th>販売個数</th>
            <th>販売原価</th>
            <th>売上額</th>
            <th>利益額</th>
            <th class="col-md-1">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($summaries as $item): ?>
        <tr>

            <td><?php echo $item->year; ?></td>
            <td><?php echo $item->month; ?></td>
            <td><?php echo number_format($item->supply_total_count); ?></td>
            <td><?php echo "¥".number_format($item->supply_total_price); ?></td>
            <td><?php echo number_format($item->begining_inventory_count); ?></td>
            <td><?php echo "¥".number_format($item->beginning_inventory_cost); ?></td>
            <td><?php echo number_format($item->sale_total_count); ?></td>
            <td><?php echo "¥".number_format($item->product_cost_total); ?></td>
            <td><?php echo "$".number_format($item->sale_total_price); ?></td>
            <td><?php echo "¥".number_format($item->profit_total); ?></td>
            </td>
        </tr>
<?php endforeach; ?>	</tbody>
</table>
    <?php echo Form::open(array('action' => 'ebay/inventory/updatesummary', 'method' => 'POST',"class"=>"form-horizontal")); ?>
        <div class="col-md-7">
            <fieldset>
                <div class="form-group">
                    <?php echo Form::label('在庫更新', 'inventory_id', array('class'=>'col-md-2 control-label')); ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?php echo Form::select('year', '2016',array('2015'=>'2015年','2016'=>'2016年','2017'=>'2017年'), array('class' => 'form-control', 'placeholder'=>'Inventory id')); ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo Form::select('month', '01',array('01'=>'1月','02'=>'2月','03'=>'3月','04'=>'4月','05'=>'5月','06'=>'6月','07'=>'7月','08'=>'8月','09'=>'9月','10'=>'10月','11'=>'11月','12'=>'12月'), array('class' => 'form-control', 'placeholder'=>'Inventory id')); ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo Form::submit('submit', '更新', array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    <?php echo Form::close(); ?>

    <div class="col-md-4">
	</div>
</div>