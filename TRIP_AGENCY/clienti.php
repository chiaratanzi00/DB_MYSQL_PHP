<?php 
    include 'header.php'; 
    include 'db.php'; 
 
    //chiamata POST che prende il gancio del bottone aggiugi del form, prendendo i valori inseriti nei vari campi
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['aggiungi'])){

        //Preparo lo stato stmt -> statement 
        $stmt = $conn->prepare("INSERT INTO clienti (nome, cognome, email, telefono, nazione, codice_fiscale, documento) 
                                VALUES  (?, ?, ?, ?, ?, ?, ?)");
        //Binding dei parametri e tipizzo
        $stmt->bind_param("sssssss", $_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono'], $_POST['nazione'], $_POST['codice_fiscale'], $_POST['documento']);
        
        //eseguo lo statement
        $stmt->execute();

        echo "<div class='alert alert-success'>Cliente Aggiunto!</div>";


    }
 
 
 
 ?>










<h2>Clienti</h2>

    <!--Form-->
    <div class="card mb-4">

        <div class="card-body">

            <form action="" method="POST">

                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Nome : </label>
                        <input type="text" name="nome" class="form-control" placeholder="es.: Mario" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Cognome : </label>
                        <input type="text" name="cognome" class="form-control" placeholder="es.: Rossi" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Email : </label>
                        <input type="text" name="email" class="form-control" placeholder="es.: mario.rossi@mail.it" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Telefono : </label>
                        <input type="text" name="telefono" class="form-control" placeholder="es.: 393406587398" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Nazione : </label>
                        <input type="text" name="nazione" class="form-control" placeholder="es.: Italia" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Codice Fiscale : </label>
                        <input type="text" name="codice_fiscale" class="form-control" placeholder="Codice Fiscale di 16 cifre..." required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Documento : </label>
                        <input type="file" name="documento" class="form-control" placeholder="Inserisci il codice del documento del cliente..." >
                    </div>
                    
                    <div class="col-12">
                        <button name="aggiungi" class="btn btn-success" type="submit">Salva</button>
                    </div>

                </div>
            </form>
        </div>
    </div>



    <!--LOGICA RENDER -->
    





    <!--Tabella-->
    <table class="table table-striped">

        <thead>

            <tr>

                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Nazione</th>
                <th>Codice Fiscale</th>
                <th>Documento</th>
                <th>Azioni</th>

            </tr>

        </thead>

        <tbody>




        </tbody>

    </table>


<?php include 'footer.php'; ?>