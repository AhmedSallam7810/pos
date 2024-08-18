<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo app('translator')->get('site.products'); ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->get('site.dashboard'); ?></a></li>
                <li><a href="<?php echo e(route('dashboard.products.index')); ?>"> <?php echo app('translator')->get('site.products'); ?></a></li>
                <li class="active"><?php echo app('translator')->get('site.add'); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?php echo app('translator')->get('site.add'); ?></h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    <?php echo $__env->make('partials._errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form action="<?php echo e(route('dashboard.products.store')); ?>" method="post" enctype="multipart/form-data">

                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('post')); ?>


                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.categories'); ?></label>
                            <select name="category_id" class="form-control">
                                <option value=""><?php echo app('translator')->get('site.all_categories'); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        

                        <?php $__currentLoopData = config('translatable.locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('site.' . $locale . '.name'); ?></label>
                                <input type="text" name="<?php echo e($locale); ?>[name]" class="form-control" value="<?php echo e(old($locale . '.name')); ?>">
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->get('site.' . $locale . '.description'); ?></label>
                                <textarea name="<?php echo e($locale); ?>[description]" class="form-control ckeditor"><?php echo e(old($locale . '.description')); ?></textarea>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.image'); ?></label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="<?php echo e(asset('uploads/product_images/default.png')); ?>" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.purchase_price'); ?></label>
                            <input type="number" name="purchase_price" step="0.01" class="form-control" value="<?php echo e(old('purchase_price')); ?>">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.sale_price'); ?></label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="<?php echo e(old('sale_price')); ?>">
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('site.stock'); ?></label>
                            <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock')); ?>">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('site.add'); ?></button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\pos-master\resources\views/dashboard/products/create.blade.php ENDPATH**/ ?>