<div id="main">

    <div class="loading">
        <img src="" alt="loading" width="71" height="61"
             id="loading"/>
    </div>
    <div id="pageContent">


        <table class="table table-bordered">
            <caption><h3>Informations utilisateur</h3></caption>
            <thead>
            <tr>
                <th><p class="text-center"><strong>Intitulés</strong></p></th>
                <th><p class="text-center"><strong>Renseignements</strong></p></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nom d'utilisateur :</td>
                <td>{ utilisateur.username }</td>
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><i class="glyphicon glyphicon-asterisk"></i><i class="glyphicon glyphicon-asterisk"></i><i
                        class="glyphicon glyphicon-asterisk"></i></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td>{ utilisateur.nom }}</td>
            </tr>
            <tr>
                <td>prénom :</td>
                <td>{ utilisateur.prenom }</td>
            </tr>
            <tr>
                <td>Email :</td>
                <td>{ utilisateur@email.fr }</td>
            </tr>
            </tbody>
        </table>
        <a href="" class="btn btn-default">
            <i class="glyphicon glyphicon-chevron-right"></i>
            Modifier
        </a>

    </div>
</div>