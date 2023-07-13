<?php
function makeStatement($query, $valueArray=null)
{
    global $config;
    $stmt = $config->prepare($query);
    $stmt->execute($valueArray);
    return $stmt;
}

function showTable($query)
{
    global $config;
    $stmt = $config->prepare($query);
    $stmt->execute();
    $meta = array(); //save attribute properties

    echo '<table class="table"><tr>';

    //column name
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i); //attribute properties
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach ($row as $r)
        {
            echo '<td>' . $r . '</td>';
        }
       echo '</tr>';
    }
    echo '</table>';
}

function showTablewithBtn($query)
{
    global $config;
    $stmt = $config->prepare($query);
    $stmt->execute();
    $meta = array(); //save attribute properties

    echo '<table class="table"><tr>';

    //column name
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i); //attribute properties
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '<th>Info</th>';
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach ($row as $r)
        {
            echo '<td>' . $r . '</td>';
        }
        echo '<td>
               <form method="POST">               
                <button class="btn btn-outline-success" value="info" name="info">Info</button>
               </form>
               </td>';
        echo '</tr>';
    }
    echo '</table>';
}