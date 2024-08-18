<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.products'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.products'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px"><?php echo app('translator')->get('site.products'); ?> <small><?php echo e($products->total()); ?></small></h3>

                    <form action="<?php echo e(route('dashboard.products.index')); ?>" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('site.search'); ?>" value="<?php echo e(request()->search); ?>">
                            </div>

                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value=""><?php echo app('translator')->get('site.all_categories'); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(request()->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo app('translator')->get('site.search'); ?></button>
                                <?php if(auth()->user()->hasPermission('create_products')): ?>
                                    <a href="<?php echo e(route('dashboard.products.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    <?php if($products->count() > 0): ?>

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->get('site.name'); ?></th>
                                <th><?php echo app('translator')->get('site.description'); ?></th>
                                <th><?php echo app('translator')->get('site.category'); ?></th>
                                <th><?php echo app('translator')->get('site.image'); ?></th>
                                <th><?php echo app('translator')->get('site.purchase_price'); ?></th>
                                <th><?php echo app('translator')->get('site.sale_price'); ?></th>
                                <th><?php echo app('translator')->get('site.profit_percent'); ?> %</th>
                                <th><?php echo app('translator')->get('site.stock'); ?></th>
                                <th><?php echo app('translator')->get('site.action'); ?></th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td><?php echo $product->description; ?></td>
                                    <td><?php echo e($product->category->name); ?></td>
                                    <td><img  src="<?php echo e(asset('uploads/product_images/'.$product->image)); ?>" style="width: 100px;height:70px;"  class="img-thumbnail" alt=""></td>
                                    <td><?php echo e($product->purchase_price); ?></td>
                                    <td><?php echo e($product->sale_price); ?></td>
                                    <td><?php echo e($product->profit_percent); ?> %</td>
                                    <td><?php echo e($product->stock); ?></td>
                                    <td>
                                        <?php if(auth()->user()->hasPermission('update_products')): ?>
                                            <a href="<?php echo e(route('dashboard.products.edit', $product->id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermission('delete_products')): ?>
                                            <form action="<?php echo e(route('dashboard.products.destroy', $product->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('delete')); ?>

                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> <?php echo app('translator')->get('site.delete'); ?></button>
                                            </form><!-- end of form -->
                                        <?php else: ?>
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> <?php echo app('translator')->get('site.delete'); ?></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table><!-- end of table -->
                        
                        <?php echo e($products->appends(request()->query())->links()); ?>

                        
                    <?php else: ?>
                        
                        <h2>'site.no_data_found'</h2>
                        
                    <?php endif; ?>

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/dashboard/products/index.blade.php ENDPATH**/ ?>