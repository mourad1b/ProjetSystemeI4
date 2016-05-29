var User = function() {

    var idUser, nomUser, prenomUser, mailUser, telUser;
    var panelFormManageUser = $('.panelFormManageUser');
    var panelFormFileAddUsers = $('.panelFormFileAddUsers');

    var formManageUser = $('.formManageUser');
    var formActionUser = $('.formActionUser');

    var loadingImg = $('#loading-img');

    panelFormManageUser.hide();
    panelFormFileAddUsers.hide();
    loadingImg.hide();
    var btnAddUser = $(".btnAddUser");
    var btnModifUser = $(".btnModifUser");
    var btnSupprUser= $(".btnSupprUser");
    var btnSubmitUser = $('.btnSubmitUser');
    var btnCancelUser = $('.btnCancelUser');


    var _loaderOn = function() {
        $('#loader').slideDown();
        $('#panelFormListUser').slideUp();
    };
    var _loaderOff = function() {
        $('#loader').slideUp();
        $('#panelFormListUser').slideDown();
        $("body").addClass('modal-open');
    };
    var _getUsers = function() {
        //_loaderOn();

        // Lancement de l'appel ajax
        $.ajax({
            csrf:true,
            url: ""
        }).done(
            function(fulldata) {
            var _fichiersLi = '';

            $('#listUser').html(_fichiersLi);
            //_displayAddFile();
        }).always(function(){
            //_loaderOff();
        });
    };

    btnSupprUser.click(function (e) {
        //e.stopPropagation();
        e.preventDefault();

        console.log('btnSupprUser');
        idUser = $(this).parent().parent().data('id');
        //var nomSelectUser = $(this).parent().parent().val();

        var modal = bootbox.confirm({
           //title: "Suppression du mail "+nomSelectUser,
            message: "Êtes-vous sûr ?",
            callback: function (result) {
                //var name = $('#name').val();
                //var answer = $("input[name='awesomeness']:checked").val()
                //Example.show("Hello " + name + ". You've chosen <b>" + answer + "</b>");
            }
        });

        modal.on('click', '.btn-primary', function () {
            console.log("btn suppr");
            $.ajax({
                url: "../Web/index.php?page=users&action=delete&idUser=" + idUser
                //context: document.body
            }).done(function () {
                bootbox.alert("User supprimé.");
                //todo _getUsers ==> refresh list
                //$( this ).addClass( "done" );
            });
        });

    });

    btnAddUser.click(function (e) {
        e.stopPropagation();
        formManageUser.attr('name', 'formAddUser');
        //formActionUser.attr('action', '../Web/index.php?page=users');
        //panelFormManageUser.show();
        console.log('btnAddUser');

        // vérifier si les champs obligatoire sont remplis
        IHM.validateModal();

        var modal = bootbox.dialog({
            title: "Ajout de nouveaux utilisateurs",
            message: panelFormFileAddUsers.show(),
            buttons: [{
                label: "Annuler",
                className: "btn-default btnCancelUser"
            },
            {
                label: "Ajouter",
                className: "btn-success btnAddNewUser buttonValide",
                callback: function () {
                    //Example.show("Hello");
                }
            }],
            //show : false,
            onEscape : function() {
                console.log("X (exit add)");
                //modal.modal("hide");
            }
        });


        modal.on('click', '.btnAddNewUser', function(){
            console.log("ajax add");

            nomUser = $('.nomUser').val();
            prenomUser = $('.prenomUser').val();
            mailUser = $('.mailUser').val();
            telUser = $('.telUser').val();

            $.ajax({
                method: "POST",
                url: "../Web/index.php?page=users&action=create",
                data: { nomUser: nomUser, prenomUser: prenomUser, mailUser: mailUser, telUser: telUser }
                //,context: document.body
            }).done(function() {
                //_loaderOn();
                bootbox.alert("Utilisateur ajouté.");
                //$( this ).addClass( "done" );
            }).always(function() {
                    //_loaderOff();
                }
            );

        });
    });

    btnModifUser.click(function (e) {
        e.stopPropagation();
        //console.log("formUpdateUser");
        formManageUser.attr('name', 'formUpdateUser');
        //formActionUser.attr('action', '../Web/index.php?page=users');
        //panelFormManageUser.show();

        idUser = $(this).parent().parent().data('id');
        libelleUser = $(this).parent().parent().data('libelle');
        objetUser = $(this).parent().parent().data('objet');

        corpsUser = $(this).parent().parent().data('body');
        $('.libelleUser').val(libelleUser);
        $('.objetUser').val(objetUser);

        $('.corpsUser').val(corpsUser);

        var modal = bootbox.dialog({
                title: "Modification de l'utilisateur n° "+idUser,
                message: panelFormManageUser.show(),
                buttons: [{
                    label: "Annuler",
                    className: "btn-default btnCancelUser"
                },
                    {
                    //success: {
                    label: "Enregistrer",
                        className: "btn-success btnUpdateUser buttonValide",
                    callback: function () {
                        //Example.show("Hello");
                    }
                //}
                }],
                //show : false,
                onEscape : function() {
                    console.log("X (exit modif)");
                    //modal.modal("hide");
                }
        });


        // vérifier si les champs obligatoire sont remplis
        IHM.validateModal();

        modal.on('click', '.btnUpdateUser', function(){
            console.log("ajax modif");

            nomUser = $('.nomUser').val();
            prenomUser = $('.prenomUser').val();
            mailUser = $('.mailUser').val();
            telUser = $('.telUser').val();

            $.ajax({
                method: "POST",
                url: "../Web/index.php?page=users&action=update&idUser="+idUser,
                data: {idUser: idUser, nomUser: nomUser, prenomUser: prenomUser, mailUser: mailUser, telUser: telUser }
                //context: document.body
                }).done(function() {
                    //_loaderOn();
                    bootbox.alert("Utilisateur mis à jour.");
                    //$( this ).addClass( "done" );
                }).always(function() {
                        //_loaderOff();
                });
        });
    });
}
$(document).ready(User());
