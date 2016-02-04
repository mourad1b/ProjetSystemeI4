var Mail = function() {



	    var idSelectMail;
        var selectMail = $('.selectMail');
        var panelFormManageMail = $('.panelFormManageMail');
        var formManageMail = $('.formManageMail');
        var formActionMail = $('.formActionMail');

        var loadingImg = $('#loading-img');

        panelFormManageMail.hide();
        loadingImg.hide();
        var btnAddMail = $(".btnAddMail");
        var btnModifMail = $(".btnModifMail");

        var btnSupprMail = $(".btnSupprMail");
        var btnSubmitMail = $('.btnSubmitMail');
        var btnCancelMail = $('.btnCancelMail');

        var libelle = $('.libelleMail').val();
        var objet = $('.objetMail').val();
        var corps = $('.corpsMail').val();

        function fillForm() {
            li = $('.selectMail');
            $('.libelle').val(li.find('.libelle').text());
            $('.objet').val(li.find('.objet').text());
            $('.corps').val(li.find('.corps').text());
        }



        btnCancelMail.click(function (e) {
            e.stopPropagation();
            panelFormManageMail.hide();
        });

        btnSupprMail.click(function (e) {
            //e.stopPropagation();
            e.preventDefault();

            bootbox.confirm("Êtes-vous sûr ?", function(result) {
                //Example.show("Confirm result: "+result);
            });


            /*
            bootbox.confirm("Êtes-vous sûr ?", function(confirmed) {
                console.log("Confirmé : "+confirmed);

                idSelectMail = selectMail.data('id');
                var url = "../Web/index.php?page=addmail&action=delete&idMail="+idSelectMail;


                //console.log(idSelectMail);
                /*$.post(url, {
                 idSelectMail: idSelectMail})
                 .done(function (data) {
                 console.log(data);


                 loadingImg.hide();
                 });


            });
            */

        });

        btnAddMail.click(function (e) {
            e.stopPropagation();

            //action formulaure : Add
            formManageMail.attr('name', 'formAddMail');
            formActionMail.attr('action', '../Web/index.php?page=addmail');
            panelFormManageMail.show();

            btnSubmitMail.click(function (e) {
                e.stopPropagation();
                var url = "../Web/index.php?page=addmail&action=create";

                /*
                loadingImg.show();
                var dataMail = {
                    libelle : libelle,
                    objet : objet,
                    corps : corps
                }
                console.log(dataMail);
                $.post(url, dataMail)
                 .done(function (data) {
                    console.log(data);

                    panelFormManageMail.hide();
                    loadingImg.hide();

                 });
                 */
            });
        });

        btnModifMail.click(function (e) {
            e.stopPropagation();

             var html = '<div class="row">  ' +
             '<div class="col-md-12"> ' +
             '<form class="form-horizontal"> ' +
             '<div class="form-group"> ' +
             '<label class="col-md-4 control-label" for="name">Name</label> ' +
             '<div class="col-md-4"> ' +
             '<input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md"> ' +
             '<span class="help-block">Here goes your name</span> </div> ' +
             '</div> ' +
             '<div class="form-group"> ' +
             '<label class="col-md-4 control-label" for="awesomeness">How awesome is this?</label> ' +
             '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
             '<input type="radio" name="awesomeness" id="awesomeness-0" value="Really awesome" checked="checked"> ' +
             'Really awesome </label> ' +
             '</div><div class="radio"> <label for="awesomeness-1"> ' +
             '<input type="radio" name="awesomeness" id="awesomeness-1" value="Super awesome"> Super awesome </label> ' +
             '</div> ' +
             '</div> </div>' +
             '</form> </div>  </div>';

            formManageMail.attr('name', 'formUpdateMail');
            formActionMail.attr('action', '../Web/index.php?page=addmail');

            //panelFormManageMail.show();

            bootbox.dialog({
                    title: "Gestion des mails",
                    message: panelFormManageMail.show(),
                    buttons: [{
                        //success: {
                        label: "Annuler",
                        className: "btn-default btnCancelMail",
                        callback: function () {
                            var name = $('#name').val();
                            var answer = $("input[name='awesomeness']:checked").val()
                            //Example.show("Hello " + name + ". You've chosen <b>" + answer + "</b>");
                        }
                        //}
                    },
                        {
                        //success: {
                        label: "Enregistrer",
                            className: "btn-success btnSubmitMail",
                        callback: function () {
                        var name = $('#name').val();
                        var answer = $("input[name='awesomeness']:checked").val()
                        //Example.show("Hello " + name + ". You've chosen <b>" + answer + "</b>");
                        }
                    //}
                    }],
                    //show : false,
                    onEscape : function() {
                        //modal.modal("hide");
                    }
            });

            /*
            //action formulaure : modif
            formManageMail.attr('name', 'formUpdateMail');
            formActionMail.attr('action', '../Web/index.php?page=addmail');
            panelFormManageMail.show();

            btnSubmitMail.click(function (e) {
                e.stopPropagation();
                var url = "../Web/index.php?page=addmail&action=update";

                loadingImg.show();
                var dataMail = {
                    libelle : libelle,
                    objet : objet,
                    corps : corps
                }
                console.log(dataMail);
                $.post(url, dataMail)
                    .done(function (data) {
                        console.log(data);

                        panelFormManageMail.hide();
                        loadingImg.hide();

                    });
            });

            */

        });
}
$(document).ready(Mail());
