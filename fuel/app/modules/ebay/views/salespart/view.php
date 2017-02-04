<h2>Viewing <span class='muted'>#<?php echo $salespart->id; ?></span></h2>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>

<fieldset>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Inventory ID</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->inventory_id; ?></div>
            <?php echo Form::hidden('inventory_id', $salespart->inventory_id); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>eBay Item Number</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->eBay_item_number; ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Selling Type</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->selling_type; ?></div>
            <?php echo Form::hidden('selling_type', $salespart->selling_type); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Listening Duration</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->listing_duration; ?></div>
            <?php echo Form::hidden('listing_duration', $salespart->listing_duration); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Start Price</strong></div>
            <div class="col-md-2 control-label" style="text-align: left"><?php echo $salespart->start_price; ?></div>
            <?php echo Form::hidden('start_price', $salespart->start_price); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>BestOffer</strong></div>
            <div class="col-md-2 control-label" style="text-align: left"><?php echo $salespart->best_offer; ?></div>
            <?php echo Form::hidden('best_offer', $salespart->best_offer); ?>
            <div class="col-md-2 control-label"><strong>BestOfferAutoAccept</strong></div>
            <div class="col-md-2 control-label" style="text-align: left"><?php echo $salespart->best_offer_auto_accept; ?></div>
            <?php echo Form::hidden('best_offer_auto_accept', $salespart->best_offer_auto_accept); ?>
            <div class="col-md-2 control-label"><strong>BestOfferMinimum</strong></div>
            <div class="col-md-2 control-label" style="text-align: left"><?php echo $salespart->best_offer_minimum; ?></div>
            <?php echo Form::hidden('best_offer_minimum', $salespart->best_offer_minimum); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Title</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->title; ?></div>
            <?php echo Form::hidden('title', $salespart->title); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Category ID</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->category_id; ?></div>
            <?php echo Form::hidden('category_id', $salespart->category_id); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>SKU</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->sku; ?></div>
            <?php echo Form::hidden('sku', $salespart->sku); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>SerialNo</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->serialno; ?></div>
            <?php echo Form::hidden('serialno', $salespart->serialno); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Condition</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->condition_description; ?></div>
            <?php echo Form::hidden('condition_description', $salespart->condition_description); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Store Category</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->store_category_name; ?></div>
            <?php echo Form::hidden('store_category_name', $salespart->store_category_name); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Specific ID</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->specific_id; ?></div>
            <?php echo Form::hidden('specific_id', $salespart->specific_id); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"></div>
            <div class="col-md-6" style="text-align: left">
                <table class="table table-striped">
                    <tbody>
                    <?php foreach ($itemspecific as $item): ?>
                        <tr>
                            <td><?php echo $item->name; ?></td>
                            <td><?php echo $item->value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Shipping</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $shipping->shipping_name; ?></div>
            <?php echo Form::hidden('shipping_id', $salespart->shipping_id); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"></div>
            <div class="col-md-6" style="text-align: left">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><?php echo $shipping->domestic_service_1; ?></td>
                            <td><?php echo "Domestic"; ?></td>
                            <td><?php echo $shipping->domestic_cost_1; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $shipping->international_service_1; ?></td>
                            <td><?php echo $shipping->international_location_1; ?></td>
                            <td><?php echo $shipping->international_cost_1; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $shipping->international_service_2; ?></td>
                            <td><?php echo $shipping->international_location_2; ?></td>
                            <td><?php echo $shipping->international_cost_2; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $shipping->international_service_3; ?></td>
                            <td><?php echo $shipping->international_location_3; ?></td>
                            <td><?php echo $shipping->international_cost_3; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $shipping->international_service_4; ?></td>
                            <td><?php echo $shipping->international_location_4; ?></td>
                            <td><?php echo $shipping->international_cost_4; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $shipping->international_service_5; ?></td>
                            <td><?php echo $shipping->international_location_5; ?></td>
                            <td><?php echo $shipping->international_cost_5; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Start Date</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->start_date; ?></div>
            <?php echo Form::hidden('start_date', $salespart->start_date); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>End Date</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->end_date; ?></div>
            <?php echo Form::hidden('end_date', $salespart->end_date); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Including</strong></div>
            <div class="col-md-6 control-label" style="text-align: left">
                <div class="col-md-6" style="text-align: left">
                    <?php $includings = @explode("\n", $salespart->including); ?>
                    <table class="table table-striped">
                        <tbody>
                        <?php foreach ($includings as $item): ?>
                            <tr>
                                <td><?php echo $item; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php echo Form::hidden('including', $salespart->including); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>Picture</strong></div>
            <div class="col-md-10 control-label" style="text-align: left">
                <?php $picture_urls = @explode("\n", $salespart->picture_url); ?>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <?php for ($count = 0; $count < count($picture_urls); $count++): ?>
                                <?php if($count == 6) echo "</tr><tr>"; ?>
                                <td class="col-md-1"><?php echo @Html::img($picture_urls[$count],array( "class" =>"img-thumbnail" )); ?></td>
                            <?php endfor;?>
                        </tr>
                    </tbody>
                </table>
                </div>
            <?php echo Form::hidden('picture_url', $salespart->picture_url); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 control-label"><strong>description</strong></div>
            <div class="col-md-6 control-label" style="text-align: left"><?php echo $salespart->description; ?></div>
            <?php echo Form::hidden('description', $salespart->description); ?>
        </div>
    </div>

</fieldset>
<div class="form-group">
    <label class='control-label'>&nbsp;</label>
    <?php echo Form::submit('submit', '出品', array('class' => 'btn btn-primary')); ?>
</div>
<?php echo Form::close(); ?>

<?php echo Html::anchor('ebay/salespart/edit/'.$salespart->id, 'Edit'); ?> |
<?php echo Html::anchor('ebay/salespart', 'Back'); ?>