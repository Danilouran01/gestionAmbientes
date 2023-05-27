<?php 
 require_once "./classAmbientes.php";

    if (isset($_POST['registrar'])) {
        

    
       
        $sillas = isset($_POST['cantSillas']) ? $_POST['cantSillas'] : 0;
        $mesas = isset($_POST['cantMesas']) ? $_POST['cantMesas'] : 0;

        $ambiente =new Ambientes();
        $ambiente->id_ambiente = $_POST['numeroAmbiente'];
        $ambiente->piso = $_POST['numeroPiso'];
        $ambiente->estado = $_POST['estadoAmbiente'];
        $ambiente->linea_formacion=$_POST['lineaFormacion'];
        $ambiente->sillas=$sillas;
        $ambiente->mesas=$mesas;

       $registrar_ambiente =$ambiente->registrarAmbiente();
       $numero_ambiente=$_POST['numeroAmbiente'];
       

if ($registrar_ambiente){

    header("Location: ver_ambiente.php?ambiente=$numero_ambiente");
}
        

        
    }

    ?>






