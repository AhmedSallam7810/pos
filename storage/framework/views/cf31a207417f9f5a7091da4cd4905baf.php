<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1><?php echo app('translator')->get('site.categories'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.categories'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px"><?php echo app('translator')->get('site.categories'); ?> <small><?php echo e($categories->total()); ?></small></h3>

                    <form action="<?php echo e(route('dashboard.categories.index')); ?>" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('site.search'); ?>" value="<?php echo e(request()->search); ?>">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo app('translator')->get('site.search'); ?></button>
                                <?php if(auth()->user()->hasPermission('create_categories')): ?>
                                    <a href="<?php echo e(route('dashboard.categories.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    <?php if($categories->count() > 0): ?>

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->get('site.name'); ?></th>
                                <th><?php echo app('translator')->get('site.products_count'); ?></th>
                                <th><?php echo app('translator')->get('site.related_products'); ?></th>
                                <th><?php echo app('translator')->get('site.action'); ?></th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($category->name); ?></td>
                                    <td><?php echo e($category->products->count()); ?></td>
                                    <td><a href="<?php echo e(route('dashboard.products.index', ['category_id' => $category->id])); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->get('site.related_products'); ?></a></td>
                                     <td>
                                        <?php if(auth()->user()->hasPermission('update_categories')): ?>
                                            <a href="<?php echo e(route('dashboard.categories.edit', $category->id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> <?php echo app('translator')->get('site.edit'); ?></a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermission('delete_categories')): ?>
                                            <form action="<?php echo e(route('dashboard.categories.destroy', $category->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                
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
                        
                        <?php echo e($categories->appends(request()->query())->links()); ?>

                        
                    <?php else: ?>
                        
                        <h2>'site.no_data_found'</h2>
                        
                    <?php endif; ?>

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/dashboard/categories/index.blade.php ENDPATH**/ ?>