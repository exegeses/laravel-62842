<?php $__env->startSection('contenido'); ?>

    <h1>Modificación de una marca</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/marca/update" method="post">
        <?php echo method_field('patch'); ?>
        <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="mkNombre">Nombre de la marca</label>
                <input type="text" name="mkNombre"
                       value="<?php echo e(old('mkNombre', $marca->mkNombre)); ?>"
                       class="form-control" id="mkNombre">
            </div>
            <input type="hidden" name="idMarca"
                   value="<?php echo e($marca->idMarca); ?>">

            <button class="btn btn-dark my-3 px-4">Modificar marca</button>
            <a href="/marcas" class="btn btn-outline-secondary">
                Volver a panel de marcas
            </a>
        </form>
    </div>

    <?php if( $errors->any() ): ?>
        <div class="alert alert-danger col-8 mx-auto">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><i class="bi bi-info-circle"></i>
                        <?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/marcos/Documents/Cursos/Laravel/laravel-62842/catalogo/resources/views/marcaEdit.blade.php ENDPATH**/ ?>