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
                 */

            });

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
        });

        btnModifMail.click(function (e) {
            e.stopPropagation();

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

        });
}