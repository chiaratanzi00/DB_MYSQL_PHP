<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<h2>Prenotazioni</h2>

    <!--Form-->
    <div class="card mb-4">

        <div class="card-body">

            <form action="" method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Data prenotazione : </label>
                        <input type="date" name="data_prenotazione" class="form-control" placeholder="Inserisci la data di prenotazione..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Acconto : </label>
                        <input type="number" name="acconto" class="form-control" placeholder="Inserisci acconto..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Numero persone : </label>
                        <input type="number" name="numero_persone" class="form-control" placeholder="Inserisci il numero delle persone..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Assicurazione: </label>
                        <input type="number" name="assicurazione" class="form-control" placeholder="Inserisci se il cliente ha l'assicurazione..." required>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Invia</button>
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
                <th>Acconto</th>
                <th>Numero persone</th>
                <th>Assicrazione</th>
                

            </tr>

        </thead>

        <tbody>
          <!-- Qui verranno inserite le righe dal database -->
        </tbody>

    </table>




<?php include 'footer.php'; ?>    
