<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<h2>Destinazioni</h2>

    <!--Form-->
    <div class="card mb-4">

        <div class="card-body">

            <form action="" method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Città : </label>
                        <input type="text" name="citta" class="form-control" placeholder="Inserisci la città..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Paese : </label>
                        <input type="text" name="paese" class="form-control" placeholder="Inserisci il paese..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Prezzo : </label>
                        <input type="number" name="prezzo" class="form-control" placeholder="Inserisci il prezzo..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Data partenza : </label>
                        <input type="date" name="data_partenza" class="form-control" placeholder="Inserisci la data di partenza..." required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-weight: 600;" for="">Data Ritorno : </label>
                        <input type="date" name="data_ritorno" class="form-control" placeholder="Inserisci data di ritorno..." required>
                    </div>

                     <div class="col-12">
                        <button class="btn btn-success" type="submit">Inserisci</button>
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
                <th>Città</th>
                <th>Paese</th>
                <th>Prezzo</th>
                <th>Data partenza</th>
                <th>Data ritorno</th>

            </tr>

        </thead>

        <tbody>
            <!-- Qui verranno inserite le righe dal database -->
        </tbody>

    </table>




<?php include 'footer.php'; ?>    


