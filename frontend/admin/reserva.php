<?php 
// 1. Incluir archivos de configuración y conexión
require_once "../backend/src/config/database.php";
include 'header.php'; // Tu sidebar y topbar

// 2. Instanciar la base de datos
$database = new Database();
$db = $database->getConnection();

// 3. Obtener el filtro de estado (Categorización)
$estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';

// 4. Preparar la consulta SQL
$query = "SELECT r.*, s.nombre_show 
          FROM reservas r 
          LEFT JOIN shows s ON r.show_id = s.id";

if ($estado_filtro != '') {
    $query .= " WHERE r.estado = :estado";
}
$query .= " ORDER BY r.fecha_hora_reserva DESC";

$stmt = $db->prepare($query);

if ($estado_filtro != '') {
    $stmt->bindParam(':estado', $estado_filtro);
}
$stmt->execute();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Solicitudes de Reserva</h1>
    </div>

    <!-- Pestañas de Categorización -->
    <ul class="nav nav-tabs mb-4" id="reservaTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php echo $estado_filtro == '' ? 'active font-weight-bold' : ''; ?>" href="reserva.php">Todas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning <?php echo $estado_filtro == 'Pendiente' ? 'active font-weight-bold' : ''; ?>" href="reserva.php?estado=Pendiente">Pendientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success <?php echo $estado_filtro == 'Aceptada' ? 'active font-weight-bold' : ''; ?>" href="reserva.php?estado=Aceptada">Aceptadas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger <?php echo $estado_filtro == 'Rechazada' ? 'active font-weight-bold' : ''; ?>" href="reserva.php?estado=Rechazada">Rechazadas</a>
        </li>
    </ul>

    <!-- Tabla de Reservas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-black text-white">
            <h6 class="m-0 font-weight-bold">Listado de Reservas <?php echo $estado_filtro; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Cliente / Empresa</th>
                            <th>DNI/RUC</th>
                            <th>Contacto</th>
                            <th>Show</th>
                            <th>Lugar y Espacio</th>
                            <th>Fecha/Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                            // Clases de color según estado
                            $badge_class = 'badge-warning';
                            if($row['estado'] == 'Aceptada') $badge_class = 'badge-success';
                            if($row['estado'] == 'Rechazada') $badge_class = 'badge-danger';
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($row['cliente_nombre']); ?></strong><br>
                                <span class="badge badge-light border text-uppercase"><?php echo htmlspecialchars($row['empresa']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($row['documento_identidad']); ?></td>
                            <td>
                                <i class="fas fa-phone fa-sm mr-1"></i><?php echo htmlspecialchars($row['telefono']); ?>
                            </td>
                            <td class="text-primary font-weight-bold">
                                <?php echo htmlspecialchars($row['nombre_show']); ?>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['lugar_presentacion']); ?></strong><br>
                                <small class="text-muted"><?php echo htmlspecialchars($row['lugar_descripcion']); ?></small>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;">
                                    <i class="far fa-calendar-alt text-gray-500"></i> <?php echo date('d/m/Y', strtotime($row['fecha_hora_reserva'])); ?><br>
                                    <i class="far fa-clock text-gray-500"></i> <?php echo date('H:i A', strtotime($row['fecha_hora_reserva'])); ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge <?php echo $badge_class; ?> p-2">
                                    <?php echo $row['estado']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="dropdown no-arrow text-center">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Cambiar Estado:</div>
                                        <a class="dropdown-item text-success" href="actualizar_reserva.php?id=<?php echo $row['id']; ?>&nuevo_estado=Aceptada"><i class="fas fa-check fa-sm mr-2"></i>Aceptar</a>
                                        <a class="dropdown-item text-danger" href="actualizar_reserva.php?id=<?php echo $row['id']; ?>&nuevo_estado=Rechazada"><i class="fas fa-times fa-sm mr-2"></i>Rechazar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="ver_reserva.php?id=<?php echo $row['id']; ?>"><i class="fas fa-eye fa-sm mr-2"></i>Ver detalles</a>
                                    </div>
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
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>