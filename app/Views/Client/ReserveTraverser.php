<h4>Pseudo-Panier</h4>
<form action='' method='post'>
<table border=1>
    <tr>
    <th>Libellé</th>
    <th>Quantité</th>
    </tr>
    <tr>
    <td>
        <input type="hidden" name="categorie[0][Reference]" value="J124" />
        Animal Crossing
    </td>
    <td>
        <input type="text" name="categorie[0][Quantite]" value="1" />
    </td>
    </tr>

    <tr>
    <td>
        <input type="hidden" name="categorie[1][Reference]" value="J045" />
        The Legend of Zelda
    </td>
    <td>
        <input type="text" name="categorie[1][Quantite]" value="1" />
    </td>
    </tr>

    <tr>
    <td>
        <input type="hidden" name="categorie[2][Reference]" value="J007" />
        Minecraft
    </td>
    <td>
        <input type="text" name="categorie[2][Quantite]" value="1" />
    </td>
    </tr>
</table>
<BR>
<input type="submit" value="Valider panier">
</form>