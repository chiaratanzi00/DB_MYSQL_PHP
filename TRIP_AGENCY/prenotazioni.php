<?php include 'header.php'; ?>
<?php include 'db.php'; 


//Logica per impaginazione
$perPagina = 10;  // n elementi mostrati per pagina
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPagina;



//===========================  LOGICA DI AGGIUNTA PRENOTAZIONE
//chiamata POST che prende il gancio del bottone aggiugi del form, prendendo i valori inseriti nei vari campi
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['aggiungi'])){


//Preparo lo stato stmt -> statement 
$stmt = $conn->prepare("INSERT INTO prenotazioni 
        (seleziona_cliente, seleziona_destinazione, data_prenotazione, numero_persone, assicurazione, acconto)
        VALUES (?, ?, ?, ?, ?, ?)
");

//Binding dei parametri e tipizzo
$stmt->bind_param("ssssss",
        $_POST['seleziona_cliente'],
        $_POST['seleziona_destinazione'],
        $_POST['dataprenotazione'],
        $_POST['numero_persone'],
        $_POST['assicurazione'],
        $_POST['acconto']
    );

    $stmt->execute();

    echo "<div class='alert alert-success'>Prenotazione aggiunta con successo!</div>";

}

// =========================== LOGICA DI MODIFICA
$prenotazione_modifica = null;

if (isset($_GET['modifica'])) {

    $id = intval($_GET['modifica']);
    $res = $conn->query("SELECT * FROM prenotazioni WHERE id = $id");

    $prenotazione_modifica = $res->fetch_assoc();
}


// ============================== SALVATAGGIO MODIFICA
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['salva_modifica'])){

//PREPARE
$stmt = $conn->prepare("UPDATE prenotazioni
        SET seleziona_cliente=?, seleziona_destinazione=?, dataprenotazione=?, numero_persone=?, assicurazione=?, acconto=?
        WHERE id=?"
);


//BINDING
$stmt->bind_param("ssssssd",
        $_POST['seleziona_cliente'],
        $_POST['seleziona_destinazione'],
        $_POST['dataprenotazione'],
        $_POST['numero_persone'],
        $_POST['data_ritorno'],
        $_POST['assicurazione'],
        $_POST['acconto']
);


























?>


<h2>Prenotazioni</h2>

    <!--Form-->
    <div class="card mb-4">

        <div class="card-body">

            <form action="" method="POST">

                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Seleziona Cliente : </label>
                        <input type="text" name="cliente" class="form-control" placeholder="" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Seleziona Destinazione : </label>
                        <input type="text" name="destinazione" class="form-control" placeholder="" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Data Prenotazione : </label>
                        <input type="date" name="dataprenotazione" class="form-control" placeholder="" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Numero persone : </label>
                        <input type="number" name="num_persone" class="form-control" placeholder="es.: 10" required>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Assicurazione : </label>
                        <input type="checkbox" name="assicurazione"  placeholder="Assicurazione del cliente..." required>
                    </div>
                    
                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Acconto : </label>
                        <input type="number" name="acconto" class="form-control" placeholder="Acconto del cliente..." required>
                    </div>
                    
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Salva</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!--Tabella-->
    <table class="table table-striped">

        <thead>

            <tr>

                <th>ID</th>
                <th>Cliente</th>
                <th>Destinazione</th>
                <th>Data</th>
                <th>Persone</th>
                <th>Assicurazione</th>
                <th>Acconto</th>
                <th>Azioni</th>

            </tr>

        </thead>

        <tbody>


        

        </tbody>

    </table>


<?php include 'footer.php'; ?>