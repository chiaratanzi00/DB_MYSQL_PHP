<?php

//includo il file db
require 'db.php';

//  Gestione dell'Invio del Form (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    
// Verifica che l'utente abbia selezionato un contatto dal menu a tendina. Se vuoto, blocca l'esecuzione con die().   
    if (empty($_POST['contatto_id'])) {
        die(" ERRORE: Devi selezionare un contatto! <a href='aggiungi_ordine.php'>Riprova</a>");
    }
    
// intval(): converte in intero
// mysqli_real_escape_string(): protegge le stringhe da caratteri pericolosi
// $data_di_ordine: viene preso così com'è 
    $contatto_id = intval($_POST['contatto_id']);
    $prodotto = mysqli_real_escape_string($conn, $_POST['prodotto']);
    $quantita = intval($_POST['quantita']);
    $data_di_ordine = $_POST['data_di_ordine'];
    
    // Verifica che il contatto esista, se non esiste  blocca operazione
    $check = mysqli_query($conn, "SELECT id, nome FROM contatti WHERE id = $contatto_id");
    
    if (mysqli_num_rows($check) == 0) {
        die(" ERRORE: Il contatto selezionato non esiste! <a href='aggiungi_ordine.php'>Riprova</a>");
    }
    
    // Inserimento ordine con prepared statement
    // prepare(): prepara la query con placeholder ?
    // bind_param("sisi", ...): associa i valori ai placeholder
    // sisi" = tipi di dato: string, integer, string, integer
    $stmt = $conn->prepare("INSERT INTO ordini (prodotto, quantita, data_di_ordine, contatto_id) 
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $prodotto, $quantita, $data_di_ordine, $contatto_id);
    

    if ($stmt->execute()) {
        header("Location: ordini.php");
        exit;
    } else {
        die(" Errore inserimento: " . $stmt->error . "<br><a href='aggiungi_ordine.php'>Riprova</a>");
    }
}

// Recupera tutti i contatti per il select
$contatti = mysqli_query($conn, "SELECT id, nome FROM contatti ORDER BY nome");

// Se arriva da index.php con contatto_id nell'URL
$contatto_id_preselezionato = $_GET['contatto_id'] ?? '';

// Se c'è un contatto preselezionato, recupera il nome
$nome_contatto = '';
if ($contatto_id_preselezionato) {
    $result_contatto = mysqli_query($conn, "SELECT nome FROM contatti WHERE id = " . intval($contatto_id_preselezionato));
    if ($result_contatto && mysqli_num_rows($result_contatto) > 0) {
        $nome_contatto = mysqli_fetch_assoc($result_contatto)['nome'];
    }
}

if (!$contatti || mysqli_num_rows($contatti) == 0) {
    die(" Nessun contatto disponibile! <a href='index.php'>Torna alla rubrica</a>");
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi ordine</title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
</head>
<body>

<div class="container">

    <h1>Aggiungi nuovo ordine</h1>
    
    <?php if ($nome_contatto): ?>
        <p><strong>Ordine per:</strong> <?= htmlspecialchars($nome_contatto) ?></p>
    <?php endif; ?>

    <form action="aggiungi_ordine.php" method="POST">
        
        <label>Seleziona contatto:</label>
        <select name="contatto_id" required>
            <option value="">-- Scegli un contatto --</option>
            <?php 
            mysqli_data_seek($contatti, 0);
            while ($row = mysqli_fetch_assoc($contatti)): 
                $selected = ($row['id'] == $contatto_id_preselezionato) ? 'selected' : '';
            ?>
                <option value="<?= $row['id'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($row['nome']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Prodotto:</label>
        <input type="text" name="prodotto" required>
        
        <label>Quantità:</label>
        <input type="number" name="quantita" min="1" value="1" required>
        
        <label>Data ordine:</label>
        <input type="date" name="data_di_ordine" value="<?= date('Y-m-d') ?>" required>

        <button type="submit" class="buttonSave">Salva ordine</button>

    </form>

    <a href="ordini.php" class="button">Torna alla lista ordini</a>
    <a href="index.php" class="button">Torna alla rubrica</a>

</div>

</body>
</html>