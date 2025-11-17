<?php 
    include 'header.php'; 
    include 'db.php'; 


    //Logica per impaginazione
    $perPagina = 10;  // n elementi mostrati per pagina
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $perPagina;









    //LOGICA DI AGGIUNTA
 
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
    

    //LOGICA DI AGGIUNTA

    

 
 
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
    <?php

        //vado a conteggiare il totale dei clienti con query
        $total = $conn->query("SELECT COUNT(*) as t FROM clienti")->fetch_assoc()['t'];
        $totalPages = ceil($total / $perPagina); // il numero di pagine della navigazione

        //QUERY PER ordinare i dati in modo DECRESCENTE IMPAGINATI PER valore di "$perPagina" 
        $result = $conn->query("SELECT * FROM clienti ORDER BY id ASC LIMIT $perPagina OFFSET $offset");

    ?>





    <!--Tabella-->
    <table class="table table-striped">

        <thead>
            <!--Intestazione tabella-->
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
        <!--Corpo tabella-->
        <tbody>

            <?php while ($row = $result->fetch_assoc()) : ?>
                
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['cognome'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['telefono'] ?></td>
                    <td><?= $row['nazione'] ?></td>
                    <td><?= $row['codice_fiscale'] ?></td>
                    <td><?= $row['documento'] ?></td>
                    <td>

                        <a class="btn btn-sm btn-warning" href="?modifica=<?= $row['id']  ?>">Modifica</a>
                        <a class="btn btn-sm btn-danger" href="?elimina=<?= $row['id']  ?>" onclick="return confirm ('Sicuro?')">Elimina</a>


                    </td>
                </tr>


            <?php endwhile; ?>

        </tbody>

    </table>



    <!--Paginazione-->
    <nav>

        <ul class="pagination">

            <?php for($i = 1; $i <= $totalPages; $i++ ) : ?>

                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>   

            <?php endfor; ?>



        </ul>
    </nav>

<?php include 'footer.php'; ?>