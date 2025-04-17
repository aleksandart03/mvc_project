<a href="/mvc_project/public/index.php">Nazad na listu proizvoda</a>
<br><br>


<h2>Dodaj novi proizvod</h2>

<form action="/mvc_project/public/index.php?action=store" method="POST">
    <label for="name">Naziv:</label><br>
    <input type="text" name="name" required><br><br>

    <label for="description">Opis:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label for="price">Cena (€):</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <input type="submit" value="Dodaj proizvod">


</form>