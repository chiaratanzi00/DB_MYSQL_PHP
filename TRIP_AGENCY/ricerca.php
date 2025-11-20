<?php 
include 'header.php'; 
include 'db.php'; 

// recuperare i valori del form tramite get
// $_GET['nome'] contiene i valori inviati dal form tramite GET
// ?? '' significa se il valore non esiste, uso una stringa vuota.
$citta = $_GET['citta'] ?? '';
$paese = $_GET['paese'] ?? '';
$data_partenza = $_GET['data_partenza'] ?? '';
$data_ritorno = $_GET['data_ritorno'] ?? '';
$prezzo_minimo = $_GET['prezzo_minimo'] ?? '';
$prezzo_massimo = $_GET['prezzo_massimo'] ?? '';
$posti_disponibili = $_GET['posti_disponibili'] ?? '';


// aggiungo i vari filtri
// $where conterrà le condizioni SQL (es. "citta LIKE ?")
// $params contiene i valori da inserire nei ? in ordine.
// $types → stringa usata da bind_param() (s=stringa, i=intero).

$where = [];
$params = [];
$types = "";


// Controllo se l’utente ha inserito un valore
// Aggiungo una condizione alla WHERE
// Aggiungo il valore ai parametri
// Specifico il tipo (s/string, i/int)


// Città
if ($citta !== '') {
    $where[] = "citta LIKE ?";
    $params[] = "%$citta%";
    $types .= "s";
}

// Paese
if ($paese !== '') {
    $where[] = "paese LIKE ?";
    $params[] = "%$paese%";
    $types .= "s";
}

// Data partenza
if ($data_partenza !== '') {
    $where[] = "data_partenza >= ?";
    $params[] = $data_partenza;
    $types .= "s";
}

// Data ritorno
if ($data_ritorno !== '') {
    $where[] = "data_ritorno <= ?";
    $params[] = $data_ritorno;
    $types .= "s";
}

// Prezzo minimo
if ($prezzo_minimo !== '') {
    $where[] = "prezzo >= ?";
    $params[] = (int)$prezzo_minimo;
    $types .= "i";
}

// Prezzo massimo
if ($prezzo_massimo !== '') {
    $where[] = "prezzo <= ?";
    $params[] = (int)$prezzo_massimo;
    $types .= "i";
}

// Posti disponibili
if ($posti_disponibili !== '') {
    $where[] = "posti_disponibili >= ?";
    $params[] = (int)$posti_disponibili;
    $types .= "i";
}


// --------- Costruzione query
$query = "SELECT * FROM destinazioni";

if (!empty($where)) {
    $query .= " WHERE " . implode(" AND ", $where);
}


// (solo se usi paginazione)
$perPagina = 10;
$offset = 0;

$query .= " ORDER BY data_partenza ASC LIMIT $perPagina OFFSET $offset";


// PREPARAZIONE
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();










?>
    
    
    
    
    
    
    <h1 class="mb-4">Ricerca Destinazioni</h1>

    <!-- Form di ricerca -->
    <div class="card shadow-sm mb-4">
        
        <div class="card-body">
            
            <form method="GET" action="">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Città</label>
                        <input type="text" name="citta" class="form-control"  placeholder="es. Milano" value="<?= htmlspecialchars($citta) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Paese</label>
                        <input type="text" name="paese" class="form-control"  placeholder="es. Italia" value="<?= htmlspecialchars($paese) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Data Partenza</label>
                        <input type="date" name="data_partenza" class="form-control" value="<?= htmlspecialchars($data_partenza) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Data Ritorno</label>
                        <input type="date" name="data_ritorno" class="form-control" value="<?= htmlspecialchars($data_ritorno) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Prezzo Minimo</label>
                        <input type="number" name="prezzo_minimo" min="0" class="form-control" value="<?= htmlspecialchars($prezzo_minimo) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Prezzo Massimo</label>
                        <input type="number" name="prezzo_massimo" min="0" class="form-control" value="<?= htmlspecialchars($prezzo_massimo) ?>">
                    </div>

                    <div class="col-md-6">
                    <label class="form-label font-weight: 600">Posti Disponibili</label>
                    <input type="number" name="posti_disponibili" class="form-control" value="<?= htmlspecialchars($posti_disponibili) ?>">
                    </div>

                    <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Cerca</button>
                    </div>

                </div>
            </form>
        </div>
    </div>



    <!--Tabella-->
    <table class="table table-striped">

        <thead>
            <!--Intestazione tabella-->
            <tr>

                <th>ID</th>
                <th>Città</th>
                <th>Paese</th>
                <th>Prezzo</th>
                <th>Data partenza</th>
                <th>Data Ritorno</th>
                <th>Posti disponibili</th>

            </tr>

        </thead>

        <tbody>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>

            <td><?= htmlspecialchars($row['citta']) ?></td>

            <td><?= htmlspecialchars($row['paese']) ?></td>

            <td><?= number_format($row['prezzo'], 2, ',', '.') ?> €</td>

            <td><?= date('d/m/Y', strtotime($row['data_partenza'])) ?></td>

            <td><?= date('d/m/Y', strtotime($row['data_ritorno'])) ?></td>

            <td><?= $row['posti_disponibili'] ?></td>
        </tr>
 
        <?php endwhile; ?>

        <!-- QUI VA IL MESSAGGIO SE NON CI SONO RISULTATI -->
        <?php if ($result->num_rows === 0): ?>
        <tr>
            <td colspan="7" class="text-center text-muted">
                Nessuna destinazione trovata con questi filtri.
            </td>
        </tr>
    
        <?php endif; ?>

  
    
    
       

        </tbody>

    

    </table>


<?php  include 'footer.php' ?>