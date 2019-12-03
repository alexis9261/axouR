<?php
    include_once '../Common/conexion.php';
    
    if(isset($_GET['falla']) and isset($_GET['id']) and isset($_GET['etapa'])){
        if ($_GET['falla']=='0k'){
                
             $newid=$_GET['id'] ;
             $etapa=$_GET['etapa'];
            
             $sql2="UPDATE `PEDIDOS` SET `ESTATUS`='$etapa' WHERE  `IDPEDIDO`='$newid'";
                    
                if ($conn->query($sql2) === TRUE) {
                
                    $sql="DELETE FROM `falla` WHERE `IDPEDIDO`='$newid'";
                    
                     if ($conn->query($sql) === TRUE) {

                        } else {
                        echo "Error: " . $sql. "<br>" . $conn->error;
                        }
                    
                } else {
                echo "Error: " . $sql2. "<br>" . $conn->error;
                }
            
            
        }
          header ('location:Falla.php');
    }
  


?>
   <html>
    <head>
           <link rel="stylesheet" href="../css/Stile.css">
    </head>
    <script>
        function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
            }   
        
        
         
         function confirma(){
             r=confirm("¿Esta usted seguro?");
             return r;
         }
        
    </script>
    <body onload="deshabilitaRetroceso()">
       
        <div class="container">
           <h1 id="titulo">Fallas de Sistema - Rouxa</h1>
           
            <?php
            
            $sql="SELECT * FROM `FALLA`;";
             $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                       $id=$row['IDPEDIDO'];
                       $comentario=$row['COMENTARIO'];
                       $fecha=$row['FECHAFALLA'];
                       
                       
            $sql1="SELECT `CLIENTE`, `TELEFONO`, `EMAIL` FROM `PEDIDOS` WHERE IDPEDIDO='$id' LIMIT 1";
                
            $result1 = $conn->query($sql1);
              if ($result1->num_rows > 0) {
                   while($row1 = $result1->fetch_assoc()) {
                       $cliente=$row1['CLIENTE'];
                       $tel=$row1['TELEFONO'];
                       $email=$row1['EMAIL'];
                       
                     ?>
           
           <div class="falla">
              <p id="idpedido">Pedido:  <?php echo $id;?> | Fecha de Falla:   <?php echo $fecha;?>
              </p>
             
            <p id ="datos" >Cliente: <?php echo $cliente;?>
            <br>E-mail: <?php echo $email;?>
            <br>Telefono: <?php echo $tel;?>
            </p> 
            <p id="datos">
                Comentario: <?php echo $comentario;?>
            </p>
                <form action="Falla.php">
                     <input type="text" value="<?php echo $id;?>" name="id" style="display: none">
                       <input type="text" value="0k" name="falla" style="display: none">
                     <center>
                           <select name="etapa" id="datos">
                        <option value="3">Pagado | Buscando en stock</option>
                        <option value="4">Por empaquetar</option>
                        <option value="5">Por enviar</option>
                        <option value="6">Enviado</option>
                        <option value="7">Completado</option>
                    </select> 
                     </center>
                    
                     <center>
                   <input type="submit" id="falla-solventada" value="Falla solventada" onclick="return confirma()"> 
                    </center> 
                </form>
                
                
           </div>            
                <?php
                        }
                    }
                   
                }
            
            
              }else{
                  
                   ?>
                         <p id="titulo" style="color:red">Sin fallas en sistema</p>
                      <?php
              }
                
            $conn->close()
        
            ?>                                           
        </div>
    </body>
</html>