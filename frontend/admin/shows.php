<?php 
// 1. Conexión a la base de datos (Ruta corregida)
require_once "../../backend/src/config/database.php";
include 'header.php';

$database = new Database();
$db = $database->getConnection();

// 2. Obtener categorías
$queryCat = "SELECT * FROM categorias ORDER BY nombre_categoria ASC";
$stmtCat = $db->prepare($queryCat);
$stmtCat->execute();
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// 3. Obtener listado de shows
$queryShows = "SELECT s.*, c.nombre_categoria 
               FROM shows s 
               LEFT JOIN categorias c ON s.categoria_id = c.id 
               ORDER BY s.id DESC";
$stmtShows = $db->prepare($queryShows);
$stmtShows->execute();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Administración de Shows</h1>
        <div>
            <button class="btn btn-dark shadow-sm" data-toggle="modal" data-target="#modalCategorias">
                <i class="fas fa-tags fa-sm"></i> Categorías
            </button>
            <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalNuevoShow">
                <i class="fas fa-plus fa-sm"></i> Registrar Nuevo Show
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-black text-white text-center">
            <h6 class="m-0 font-weight-bold">Catálogo de Obras y Presentaciones</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Show / Categoría</th>
                            <th>Espacio Mín.</th>
                            <th>Duración</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmtShows->fetch(PDO::FETCH_ASSOC)): 
                            // RUTA ACTUALIZADA SEGÚN TU ESTRUCTURA
                            $path = "../../assets/img/img_shows/";
                            $img = $path . $row['foto1'];
                            
                            // Si no hay foto o no existe, usamos el banner por defecto que se ve en tu captura
                            if(empty($row['foto1']) || !file_exists($img)) {
                                $img = "../../assets/img/banner.png"; 
                            }
                            
                        ?>
                        <tr class="<?php echo $row['estado'] == 0 ? 'table-secondary text-muted' : ''; ?>">
                            <td class="text-center">
                                <img src="<?php echo $img; ?>" class="img-thumbnail" style="width: 70px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['nombre_show']); ?></strong><br>
                                <span class="badge badge-info"><?php echo htmlspecialchars($row['nombre_categoria'] ?? 'Sin categoría'); ?></span>
                            </td>
                            <td><small><?php echo htmlspecialchars($row['especificaciones']); ?></small></td>
                            <td><?php echo htmlspecialchars($row['duracion']); ?></td>
                            <td class="text-center">
                                <span class="badge <?php echo $row['estado'] == 1 ? 'badge-success' : 'badge-secondary'; ?>">
                                    <?php echo $row['estado'] == 1 ? 'Visible' : 'Oculto'; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm">
                                    <a href="../pages/shows/show.php?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-sm btn-info" title="Ver en la web">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    
                                    <a href="procesar_show.php?accion=toggle&id=<?php echo $row['id']; ?>&estado=<?php echo $row['estado']; ?>" 
                                    class="btn btn-sm <?php echo $row['estado'] == 1 ? 'btn-warning' : 'btn-success'; ?>">
                                        <i class="fas <?php echo $row['estado'] == 1 ? 'fa-eye-slash' : 'fa-eye'; ?>"></i>
                                    </a>
                                    <button onclick="confirmarEliminar(<?php echo $row['id']; ?>)" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: GESTIONAR CATEGORÍAS
     ========================================== -->
<div class="modal fade" id="modalCategorias" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-dark">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Administrar Categorías</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario agregar -->
                <form action="procesar_categoria.php?accion=crear" method="POST" class="mb-4">
                    <label class="font-weight-bold small">Nueva Categoría:</label>
                    <div class="input-group">
                        <input type="text" name="nombre_cat" class="form-control" placeholder="Ej: Danza Contemporánea" required>
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Añadir</button>
                        </div>
                    </div>
                </form>
                
                <label class="font-weight-bold small">Categorías Actuales:</label>
                <ul class="list-group shadow-sm">
                    <?php foreach($categorias as $cat): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                        <?php echo $cat['nombre_categoria']; ?>
                        <a href="procesar_categoria.php?accion=eliminar&id=<?php echo $cat['id']; ?>" 
                           class="btn btn-sm btn-outline-danger border-0" 
                           onclick="return confirm('¿Eliminar categoría? Los shows asociados quedarán como Sin Categoría.')">
                            <i class="fas fa-times"></i>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: REGISTRAR NUEVO SHOW
     ========================================== -->
<div class="modal fade" id="modalNuevoShow" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-dark">
            <form action="procesar_show.php?accion=crear" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">Formulario de Nueva Obra</h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Nombre del Show</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Categoría</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría...</option>
                                <?php foreach($categorias as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nombre_categoria']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Duración</label>
                            <input type="text" name="duracion" class="form-control" placeholder="Ej: 45 min">
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">YouTube ID</label>
                            <input type="text" name="video_url" class="form-control" placeholder="ID del video">
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Espacio Mínimo</label>
                            <input type="text" name="especificaciones" class="form-control" placeholder="Ej: 6x6 metros">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="font-weight-bold">Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" rows="3" required></textarea>
                        </div>
                        
                        <!-- Sección Galería de Fotos -->
                        <div class="col-12"><hr><p class="small font-weight-bold text-primary">Galería de Imágenes (Máx. 3)</p></div>
                        <div class="col-md-4">
                            <label class="small">Foto Principal</label>
                            <input type="file" name="foto1" class="form-control-file" accept="image/*" required>
                        </div>
                        <div class="col-md-4">
                            <label class="small">Foto 2</label>
                            <input type="file" name="foto2" class="form-control-file" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label class="small">Foto 3</label>
                            <input type="file" name="foto3" class="form-control-file" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary px-4" type="submit">Guardar Show</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Confirmación para eliminar show
function confirmarEliminar(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este show permanentemente? Esta acción borrará todos sus datos.')) {
        window.location.href = 'procesar_show.php?accion=eliminar&id=' + id;
    }
}
</script>

<?php include 'footer.php'; ?>