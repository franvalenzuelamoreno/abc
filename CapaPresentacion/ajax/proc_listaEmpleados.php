<?php
    require_once("../../CapaNegocio/Empleados.php");
    $empleado = new Empleados();
	
	switch ($_POST["opcion"]) {
		case "buscar":
			$respuesta = $empleado->fun_buscarEmpleados();
			$respuesta = pg_fetch_all($respuesta);
		    echo json_encode($respuesta);
			// echo $respuesta;
		
			
		break;
        case "eliminar":
            $respuestaEliminar = $empleado->fun_eliminarEmpleado($_POST["id"]);
            $respuestaEliminar = pg_fetch_array($respuestaEliminar);
            if($respuestaEliminar[0] == 1){
                $respuestaBuscar = $empleado->fun_buscarEmpleados();
			    $respuestaBuscar = pg_fetch_all($respuestaBuscar);
                  echo json_encode($respuestaBuscar);
            } else{
                echo json_encode("No se pudo eliminar");
            }
        break;
		case "buscarEmpleado":
            $respuesta = $empleado->fun_obtenerDatosEmpleado($_POST["id"]);
            $respuesta = pg_fetch_array($respuesta);
            echo $respuesta[0];
        break;
		case "actualizar":
		    $empleado->set_numeroEmpleado($_POST["numeroEmpleado"]);
			$empleado->set_nombre($_POST["nombre"]);
			$empleado->set_apellidoPaterno($_POST["apellidoPaterno"]);
			$empleado->set_apellidoMaterno($_POST["apellidoMaterno"]);
			$empleado->set_edad($_POST["edad"]);
			$empleado->set_direccion($_POST["direccion"]);
			$empleado->set_genero($_POST["genero"]);
			$respuesta = $empleado->fun_actualizarDatos($_POST["id"]);
			$respuesta = pg_fetch_array($respuesta);
			
			if($respuesta[0] == 1){
				$respuestaBuscar = $empleado->fun_buscarEmpleados();
			    $respuestaBuscar = pg_fetch_all($respuestaBuscar);
                echo json_encode($respuestaBuscar);
				
			} else{
				echo json_encode("No se pudo actualizar");
			}
		break;
        case "busquedaFiltrada":
		    $respuesta = $empleado->fun_buscarEmpladoNombreApellidos($_POST["filtro"]);
			$respuesta = pg_fetch_all($respuesta);
		    echo json_encode($respuesta);
        break;		
		default:
		break;
		
	}
