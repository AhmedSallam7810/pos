<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.orders'); ?>
                <small><?php echo e($orders->total()); ?> <?php echo app('translator')->get('site.orders'); ?></small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.orders'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px"><?php echo app('translator')->get('site.orders'); ?></h3>

                            <form action="<?php echo e(route('dashboard.orders.index')); ?>" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('site.search'); ?>" value="<?php echo e(request()->search); ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo app('translator')->get('site.search'); ?></button>
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        <?php if($orders->count() > 0): ?>

                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th><?php echo app('translator')->get('site.client_name'); ?></th>
                                        <th><?php echo app('translator')->get('site.price'); ?></th>

                                        <th><?php echo app('translator')->get('site.created_at'); ?></th>
                                        <th><?php echo app('translator')->get('site.action'); ?></th>
                                    </tr>

                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($order->client->name); ?></td>
                                            <td><?php echo e(number_format($order->total_price, 2)); ?></td>
                                            
                                                
                                                    
                                                    
                                                    
                                                    
                                                    
                                                
                                                    
                                                
                                            
                                            <td><?php echo e($order->created_at->toFormattedDateString()); ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                        data-url="<?php echo e(route('dashboard.orders.products', $order->id)); ?>"
                                                        data-method="get"
                                                >
                                                    <i class="fa fa-list"></i>
                                                    <?php echo app('translator')->get('site.show'); ?>
                                                </button>
                                                <?php if(auth()->user()->hasPermission('update_orders')): ?>
                                                    <a href="<?php echo e(route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id])); ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                                <?php else: ?>
                                                    <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                                <?php endif; ?>

                                                <?php if(auth()->user()->hasPermission('delete_orders')): ?>
                                                    <form action="<?php echo e(route('dashboard.clients.orders.destroy', ['client' => $order->client->id, 'order' => $order->id])); ?>" method="post" style="display: inline-block;">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('delete')); ?>

                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> <?php echo app('translator')->get('site.delete'); ?></button>
                                                    </form>

                                                <?php else: ?>
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> <?php echo app('translator')->get('site.delete'); ?></a>
                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table><!-- end of table -->

                                <?php echo e($orders->appends(request()->query())->links()); ?>


                            </div>

                        <?php else: ?>

                            <div class="box-body">
                                <h3><?php echo app('translator')->get('site.no_records'); ?></h3>
                            </div>

                        <?php endif; ?>

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px"><?php echo app('translator')->get('site.show_products'); ?></h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px"><?php echo app('translator')->get('site.loading'); ?></p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/dashboard/orders/index.blade.php ENDPATH**/ ?>