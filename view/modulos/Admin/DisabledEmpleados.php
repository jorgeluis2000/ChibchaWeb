<?php
    require "AdminHeader.php";
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/EmpleadoDAO.class.php');

    $empleadoDAO = new EmpleadoDAO();
    $user = $empleadoDAO->getAllDisabledEmpleados();
?>

  <div class="container-fluid">
    <table class="datatable table table-hover ">
      <thead class="thead-light">
        <tr>
          <th></th>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Documento</th>
          <th>Correo electrónico</th>
          <th>Modificar</th>
          <th>Habilitar</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th></th>
          <th>
            <input type="text" class="form-control input-sm filter-column" />
          </th>
          <th>
            <input type="text" class="form-control input-sm filter-column">
          </th>
          <th>
            <input type="text" class="form-control input-sm filter-column" />
          </th>
          <th>
          <input type="text" class="form-control input-sm filter-column" />
          </th>
          <th>
          <input type="text" class="form-control input-sm filter-column" />
          </th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>
      <tbody>
          <?php while($mostrar=mysqli_fetch_array($user)){?>
            <tr>
            <td><a href="ShowEmpleado?cod_usuario=<?php echo $mostrar['cod_usuario'];?>"><img src="../../../Data/imgs/lupa.png" width="30"></a></td>
            <td><?php echo $mostrar['cod_usuario'] ?></td>
            <td><?php echo $mostrar['nom_usuario'] ?></td>
            <td><?php echo $mostrar['ape_usuario'] ?></td>
            <td><?php echo $mostrar['doc_usuario'] ?></td>
            <td><?php echo $mostrar['correo_usuario'] ?></td>
            <td><a href="UpdateEmpleado?cod_usuario=<?php echo $mostrar['cod_usuario'];?>"><img src="../../../Data/imgs/editar.png" width="30"></a></td>
            <td><a href="EnableEmpleado?cod_usuario=<?php echo $mostrar['cod_usuario'];?>"><img src="../../../Data/imgs/habilitar.png" width="30"></a></td>
            </tr>
          <?php }?>
          
      </tbody>
    </table>
  </div>
  

<?php require "AdminFooter.php";?>

