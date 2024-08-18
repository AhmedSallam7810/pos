<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(asset('uploads/user_images/'.auth()->user()->image)); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-th"></i><span><?php echo app('translator')->get('site.dashboard'); ?></span></a></li>

            <?php if(auth()->user()->hasPermission('read_categories')): ?>
                <li><a href="<?php echo e(route('dashboard.categories.index')); ?>"><i class="fa fa-th"></i><span><?php echo app('translator')->get('site.categories'); ?></span></a></li>
           <?php endif; ?>

          
           
            <?php if(auth()->user()->hasPermission('read_products')): ?>
                <li><a href="<?php echo e(route('dashboard.products.index')); ?>"><i class="fa fa-th"></i><span><?php echo app('translator')->get('site.products'); ?></span></a></li>
            <?php endif; ?>

            
            <?php if(auth()->user()->hasPermission('read_clients')): ?>
            <li><a href="<?php echo e(route('dashboard.clients.index')); ?>"><i class="fa fa-th"></i><span><?php echo app('translator')->get('site.clients'); ?></span></a></li>
            <?php endif; ?>
            
            <?php if(auth()->user()->hasPermission('read_orders')): ?>
                <li><a href="<?php echo e(route('dashboard.orders.index')); ?>"><i class="fa fa-th"></i><span><?php echo app('translator')->get('site.orders'); ?></span></a></li>
            <?php endif; ?>
           
            <?php if(auth()->user()->hasPermission('read_users')): ?>
            <li><a href="<?php echo e(route('dashboard.users.index')); ?>"><i class="fa fa-th"></i><span><?php echo app('translator')->get('site.users'); ?></span></a></li>
            <?php endif; ?>
            
            

            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </ul>

    </section>

</aside>
<?php /**PATH C:\Users\DELL\Desktop\pos\resources\views/layouts/dashboard/_aside.blade.php ENDPATH**/ ?>