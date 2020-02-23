<?php use_helper('Date'); ?>
Datum;Kunde;Filalnummer;Adresse;Tätigkeit;FA;Stunden;Pause;ab 20 Uhr;Urlaub;Krank;Korrektur Stunden;Korrektur Info ;\r\n
<?php foreach ($tasks as $task) {
    $out = [];

    $out[] = format_date($task['task']->getStart(), 'dd.MM.yyyy HH:mm') . ' - ' . format_date($task['task']->getEnd(), 'HH:mm');

    $out[] = $task['task']->getJob()->getStore()->getCustomer()->getCompany();
    $out[] = ($task['task']->getJob()->getStore()->getNumber() != 0 ? $task['task']->getJob()->getStore()->getNumber() : ' ');
    $out[] = $task['task']->getJob()->getStore()->getStreet() .' '.
        sprintf("%1$05d", $task['task']->getJob()->getStore()->getPostcode()) .' '.
        $task['task']->getJob()->getStore()->getCity();


    $out[] = '"'.preg_replace('/\s\s+/', ' ', strip_tags(html_entity_decode($task['task']->getInfo()))).'"';
    $out[] = isset($task['approach']) ? $task['approach'] : '';
    $out[] = isset($task['worktime']) ? $task['worktime'] : '';
    $out[] = isset($task['break']) ? $task['break'] : '';
    $out[] = $task['task']->getOvertime() != 0 ? $task['task']->getOvertime() : '';
    $out[] = isset($task['holyday']) ? $task['holyday'] : '';
    $out[] = isset($task['sickness']) ? $task['sickness'] : '';
    $out[] = $task['task']->getCorrectionTime();
    $out[] = $task['task']->getCorrectionInfo();
    echo implode(';',$out)."\r\n";
}
?>
