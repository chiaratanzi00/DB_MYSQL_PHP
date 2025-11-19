</main> <!-- chiusura main di header-->

<footer class="text-white text-center mt-5 p-5" style="background-color: #0081a7">

    <small>© Trip-Agency <?php echo date("Y"); ?></small>


</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

 <!-- script per fare sparire gli alert -->
    <script>
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500); // lo rimuove dopo la dissolvenza
        });
    }, 10000); // 10 secondi
    
    </script>
</body>
</html>