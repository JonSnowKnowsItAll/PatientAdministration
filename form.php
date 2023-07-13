<h1>Patientensuche</h1>
<?php
if (isset($_POST['speichern']))
{
    if (isset($_POST['searchPat']))
    {
        try
        {
            $patient  = '"%'.$_POST['searchPat'].'%"';

            $stmtPat = 'select p.pat_fname as Vorname, p.pat_nname as Nachname, sp.soz_nr as SVNR,
                       p.pat_gebdat as Geburtstdatum, concat_ws(" ", s.str_name, plz.plz_nr, o.ort_name) as Adresse
                  from patient p, strasse_ort_plz sop, strasse s, ort o, plz, sozialversicherung_patient sp
                 where p.adr_id = sop.adr_id
                   and sop.str_id = s.str_id
                   and sop.ort_id = o.ort_id
                   and sop.plz_id = plz.plz_id
                   and p.pat_id = sp.pat_id
                   and (lower(p.pat_fname) like lower('.$patient.') or lower(p.pat_nname) like lower('.$patient.'))';

            $result = makeStatement($stmtPat);

            $count = $result->rowCount();

            if ($count == 0)
            {
                echo '<h6 style="color: indianred">Anzahl der Suchergebnisse: '.$count.'</h6><br>';
                ?>
                <form method="post">
                    <button class="btn btn-outline-secondary" type="submit" name="back">zurück</button>
                </form>
                <?php

            }
            else
            {
                echo '<h6>Anzahl der Suchergebnisse: '.$count.'</h6><br>';
                showTable($stmtPat);
                ?>
                <form method="post">
                    <button class="btn btn-outline-secondary" type="submit" name="back">zurück</button>
                </form>
                <?php

                if (isset($_POST['back']))
                {
                    //back to Form
                }
            }
        }
        catch (Exception $e)
        {
            echo 'Fehler bei der Patientensuche: '.$e->getCode().': '.$e->getMessage();
        }
    }
}
else
{
    ?>
    <form method="post">
    <div class="row">
        <div class="col-12">
            <input class="form-control" type="text" name="searchPat" placeholder="Name:">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <button class="btn btn-outline-success" type="submit" name="speichern">Suche</button>
            <button class="btn btn-outline-secondary" type="submit" name="abbrechen">abbrechen</button>
        </div>
    </div>
</form>
<?php
}
