<?php include 'header.php'; ?>
<?php include 'db.php'; ?>



    <h1 class="mb-4">Ricerca Destinazioni</h1>

    <!-- Form di ricerca -->
    <div class="card shadow-sm mb-4">
        
        <div class="card-body">
            
            <form method="GET" action="">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Città</label>
                        <input type="text" name="citta" class="form-control"  placeholder="es. Milano">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Paese</label>
                        <input type="text" name="paese" class="form-control"  placeholder="es. Italia">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Data Partenza</label>
                        <input type="date" name="data_partenza" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Data Ritorno</label>
                        <input type="date" name="data_ritorno" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Prezzo Minimo</label>
                        <input type="number" name="prezzo_minimo" min="0" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label font-weight: 600">Prezzo Massimo</label>
                        <input type="number" name="prezzo_massimo" min="0" class="form-control">
                    </div>

                    <div class="col-md-6">
                    <label class="form-label font-weight: 600">Posti Disponibili</label>
                    <input type="number" name="posti" class="form-control">
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
                <th>Posti Disponibili</th>
                <th>Azioni</th>

            </tr>

        </thead>

    </table>




















<?php  include 'footer.php' ?>