<?php
require_once 'modules/Accounts/views/view.list.php';

class CustomAccountsViewList extends AccountsViewList{

    public function preDisplay(){
        parent::preDisplay();
        $this->lv->actionsMenuExtraItems[] = $this->getNewActionMenuItem();
    }

    private function getNewActionMenuItem(){
        global $mod_strings;
        //return sListView.send_form(true, 'Accounts', 'index.php?entryPoint=custom_export','Proszę wybrać co najmniej 1 rekord w celu kontynuowania.');
        return <<<EOF
        <script>
            function download_csv(){
                if(list_columns.selectedOptions.length >= 1){
                    sugarListView.get_checks();  
                    var selected_ids = document.MassUpdate.uid.value;  
                    var loop_num; 
                    var array_list_columns = [];
                    for (loop_num = 0; loop_num != list_columns.selectedOptions.length; loop_num++) array_list_columns.push(list_columns.selectedOptions[loop_num].value);
                    $.ajax({
                        type: 'post',
                        url: 'index.php?entryPoint=test',
                        data: { arr_list_from_js : array_list_columns,
                                id_records : selected_ids },
                        success: function(response) {
                            var today = new Date();
                            var mylink = document.createElement('a');
                            mylink.download = "Kontrahenci"+"_"+today.getDate()+"-"+(today.getMonth()+1)+"-"+today.getFullYear()+".csv";
                            mylink.href = "data:application/csv,"+response;
                            mylink.click();
                            mySimpleDialog.hide();
                        },
                        error: function() {
                            alert("Połączenie zostało przerwane, Proszę zgłosić do administratora tego błędu");
                        }
                    });    
                } else {
                    alert("Proszę wybrać co najmniej 1 listę wyboru:");
                }
            }
        </script>
        <a href='javascript:void(0)' onclick="
            mySimpleDialog = new YAHOO.widget.SimpleDialog('dlg', {
                xy:[650,50],
                width: '400px',
                height: '200px',
                draggable: false,
                close: false,
                constraintoviewport : true, 
                effect:{
                    effect: YAHOO.widget.ContainerEffect.FADE,
                    duration: 0.25
                },
                modal: true,
                visible: false
            });

            mySimpleDialog.setHeader('Dialog!');
            mySimpleDialog.setBody('<b>Proszę wybrać jedno lub kilka kolumn danych którego chcesz eksportować:</b></br></br><select id=\'list_columns\' multiple=\'true\' style=\'width:370px;height:300px;\' required><option value=\'all\'>Wszystkie</option><option value=\'nazwa\'>Nazwa</option><option value=\'id\' >ID</option><option value=\'website\'>Strona www</option><option value=\'e-mail\'>Adres e-mail</option><option value=\'telefon\'>Telefon</option><option value=\'faks\'>Faks</option><option value=\'ulica\'>Adres korespondencyjny - Ulica</option><option value=\'miasto\'>Adres korespondencyjny - Miasto</option><option value=\'wojewodztwo\'>Adres korespondencyjny - Województwo</option><option value=\'kod_pocztowy\'>Adres korespondencyjny - Kod pocztowy</option><option value=\'kraj\'>Adres korespondencyjny - Kraj</option><option value=\'description\'>Opis</option><option value=\'account_type\'>Forma działalności</option><option value=\'rodzaj_działalności_gospodarczej\'>Rodzaj Działalności Gospodarczej</option><option value=\'data_utworzenia\'>Data utworzenia</option><option value=\'utworzone_przez\'>Utworzone przez</option><option value=\'data_zawieszenia_dzialalnosci\'>Data zawieszenia działalności</option> <option value=\'data_powstania\'>Data powstania</option><option value=\'data_rozpoczecia_dzialalnosci\'>Data rozpoczęcia działalności</option> <option value=\'adres\'>Adres</option> <option value=\'firma_zagraniczna\'>Firma zagraniczna</option><option value=\'typ_firmy\'>Typ firmy</option><option value=\'data_zakonczenia_dzialanosci\'>Data zakończenia działaności</option><option value=\'numer_nieruchomosci\'>Numer nieruchomości</option> <option value=\'data_zakonczenia_postepowania_upadlosciowego\'>Data zakonczenia postępowania upadłościowego</option> <option value=\'data_orzeczenia_o_upadlosci\'>Data orzeczenia o upadłości</option><option value=\'nip\'>NIP</option> <option value=\'numer_mieszkania\'>Numer mieszkania</option><option value=\'aktywna\'>Aktywna</option><option value=\'data_wznowienia_dzialalnosci\'>Data wznowienia działalności</option> </select></br></br><button style=\'position:absolute;left:100;width:150px\' onclick=\'download_csv();\'>Pobierz plik CSV</button><button style=\'float:right;width:100px\' onclick=\'mySimpleDialog.hide();\'>Zamknij</button>');
            mySimpleDialog.render(document.body);
            mySimpleDialog.show();
        "> {$mod_strings['custom_export']}</a>
EOF;

    }
}
?>
