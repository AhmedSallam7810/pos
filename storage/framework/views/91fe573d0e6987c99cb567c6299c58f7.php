<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.edit_order'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li><a href="<?php echo e(route('dashboard.clients.index')); ?>"><?php echo app('translator')->get('site.clients'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.edit_order'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px"><?php echo app('translator')->get('site.categories'); ?></h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#<?php echo e(str_replace(' ', '-', $category->name)); ?>"><?php echo e($category->name); ?></a>
                                            </h4>
                                        </div>

                                        <div id="<?php echo e(str_replace(' ', '-', $category->name)); ?>" class="panel-collapse collapse">

                                            <div class="panel-body">

                                                <?php if($category->products->count() > 0): ?>

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th><?php echo app('translator')->get('site.name'); ?></th>
                                                            <th><?php echo app('translator')->get('site.stock'); ?></th>
                                                            <th><?php echo app('translator')->get('site.price'); ?></th>
                                                            <th><?php echo app('translator')->get('site.add'); ?></th>
                                                        </tr>

                                                        <?php $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($product->name); ?></td>
                                                                <td><?php echo e($product->stock); ?></td>
                                                                <td><?php echo e($product->sale_price); ?></td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-<?php echo e($product->id); ?>"
                                                                       data-name="<?php echo e($product->name); ?>"
                                                                       data-id="<?php echo e($product->id); ?>"
                                                                       data-price="<?php echo e($product->sale_price); ?>"
                                                                       class="btn <?php echo e(in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success add-product-btn'); ?> btn-sm">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </table><!-- end of table -->

                                                <?php else: ?>
                                                    <h5><?php echo app('translator')->get('site.no_records'); ?></h5>
                                                <?php endif; ?>

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title"><?php echo app('translator')->get('site.orders'); ?></h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            <?php echo $__env->make('partials._errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <form action="<?php echo e(route('dashboard.clients.orders.update', ['order' => $order->id, 'client' => $client->id])); ?>" method="post">

                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('site.product'); ?></th>
                                        <th><?php echo app('translator')->get('site.quantity'); ?></th>
                                        <th><?php echo app('translator')->get('site.price'); ?></th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">

                                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($product->name); ?></td>
                                            <td><input type="number" name="products[<?php echo e($product->id); ?>][quantity]" data-price="<?php echo e(number_format($product->sale_price, 2)); ?>" class="form-control input-sm product-quantity" min="1" value="<?php echo e($product->pivot->quantity); ?>"></td>
                                            <td class="product-price"><?php echo e(number_format($product->sale_price * $product->pivot->quantity, 2)); ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-btn" data-id="<?php echo e($product->id); ?>"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table><!-- end of table -->

                                <h4><?php echo app('translator')->get('site.total'); ?> : <span class="total-price"><?php echo e(number_format($order->total_price, 2)); ?></span></h4>

                                <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit_order'); ?></button>

                            </form><!-- end of form -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    <?php if($client->orders->count() > 0): ?>

                        <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px"><?php echo app('translator')->get('site.previous_orders'); ?>
                                    <small><?php echo e($orders->total()); ?></small>
                                </h3>

                            </div><!-- end of box header -->

                            <div class="box-body">

                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#<?php echo e($order->created_at->format('d-m-Y-s')); ?>"><?php echo e($order->created_at->toFormattedDateString()); ?></a>
                                                </h4>
                                            </div>

                                            <div id="<?php echo e($order->created_at->format('d-m-Y-s')); ?>" class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="list-group-item"><?php echo e($product->name); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php echo e($orders->links()); ?>


                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    <?php endif; ?>

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos-master\resources\views/dashboard/clients/orders/edit.blade.php ENDPATH**/ ?>