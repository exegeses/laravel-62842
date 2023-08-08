<?php $__env->startSection('contenido'); ?>

    <h1>Modificaión de un producto</h1>

    <div class="alert p-4 col-8 mx-auto shadow">
        <form action="/producto/update" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>
            <div class="form-group mb-4">
                <label for="prdNombre">Nombre del Producto</label>
                <input type="text" name="prdNombre"
                       value="<?php echo e(old('prdNombre', $producto->prdNombre)); ?>"
                       class="form-control" id="prdNombre">
                <?php if($errors->has('prdNombre')): ?>
                    <span class="fs-6 text-danger"><?php echo e($errors->first('prdNombre')); ?></span>
                <?php endif; ?>
            </div>

            <label for="prdPrecio">Precio del Producto</label>
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                </div>
                <input type="number" name="prdPrecio"
                       value="<?php echo e(old('prdPrecio', $producto->prdPrecio)); ?>"
                       class="form-control" id="prdPrecio" min="0" step="0.01">
                <?php if($errors->has('prdPrecio')): ?>
                    <span class="mt-0 fs-6 text-danger"><?php echo e($errors->first('prdPrecio')); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label for="idMarca">Marca</label>
                <select class="form-select" name="idMarca" id="idMarca">
                    <option value="">Seleccione una marca</option>
            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if( old('idMarca', $producto->idMarca)==$marca->idMarca ): echo 'selected'; endif; ?> value="<?php echo e($marca->idMarca); ?>"><?php echo e($marca->mkNombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('idMarca')): ?>
                    <span class="fs-6 text-danger"><?php echo e($errors->first('idMarca')); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label for="idCategoria">Categoría</label>
                <select class="form-select" name="idCategoria" id="idCategoria">
                    <option value="">Seleccione una categoría</option>
            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if( old('idCategoria', $producto->idCategoria)==$categoria->idCategoria ): echo 'selected'; endif; ?> value="<?php echo e($categoria->idCategoria); ?>"><?php echo e($categoria->catNombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('idCategoria')): ?>
                    <span class="fs-6 text-danger"><?php echo e($errors->first('idCategoria')); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group mb-4">
                <label for="prdDescripcion">Descripción del Producto</label>
                <textarea name="prdDescripcion" class="form-control"
                          id="prdDescripcion"><?php echo e(old('prdDescripcion', $producto->prdDescripcion)); ?></textarea>
                <?php if($errors->has('prdDescripcion')): ?>
                    <span class="mt-0 fs-6 text-danger"><?php echo e($errors->first('prdDescripcion')); ?></span>
                <?php endif; ?>
            </div>

            <div class="custom-file mt-1 mb-4">
                Imagen actual:
                <img src="<?php echo e(env('RUTA_PRODUCTOS').$producto->prdImagen); ?>" class="img-thumbnail">
            </div>
            <div class="custom-file mt-1 mb-4">
                Modificar imagen (opcional):
                <input type="file" name="prdImagen" class="custom-file-input" id="customFileLang" lang="es">
                <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">Seleccionar Archivo: </label>
                <?php if($errors->has('prdImagen')): ?>
                    <span class="mt-0 fs-6 text-danger"><?php echo e($errors->first('prdImagen')); ?></span>
                <?php endif; ?>
            </div>

            <input type="hidden" name="idProducto"
                   value="<?php echo e($producto->idProducto); ?>">
            <input type="hidden" name="imgActual"
                   value="<?php echo e($producto->prdImagen); ?>">

            <button class="btn btn-dark mr-3 px-4">Modificar producto</button>
            <a href="/productos" class="btn btn-outline-secondary">
                Volver a panel de productos
            </a>

        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/marcos/Documents/Cursos/Laravel/laravel-62842/catalogo/resources/views/productoEdit.blade.php ENDPATH**/ ?>