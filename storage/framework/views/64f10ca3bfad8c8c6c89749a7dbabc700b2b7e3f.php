<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <form action="/threads" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <input type="text" name="title" id="title"
                           class="form-control <?php echo e($errors->first('title') ? 'alert-danger' : ''); ?>"
                           value="<?php echo e(old('title')); ?>" required>
                    <?php if($errors->has('title')): ?>
                        <div class="alert alert-danger">
                            <p><?php echo e($errors->first('title')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <textarea name="body" id="body" cols="30" rows="10"
                              class="form-control <?php echo e($errors->first('body') ? 'alert-danger' : ''); ?> " required><?php echo e(old('body')); ?></textarea>
                    <?php if($errors->has('body')): ?>
                        <div class="alert alert-danger">
                            <p><?php echo e($errors->first('body')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="channel">Channel</label>
                    <select name="channel_id" id="channel" class="form-control" required>
                        <option value="">Choose smth ....</option>
                        <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($channel->id); ?>" <?php echo e(old('channel_id') == $channel->id ? 'selected' : ''); ?>><?php echo e($channel->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                </div>
                <button>Post</button>
            </form>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>