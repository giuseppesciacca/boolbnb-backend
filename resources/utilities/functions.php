<?php

/**
 * @param String $date_in_london_string
 * @return String $correct_data_in_italia_string
 */
function convert_london_dateTime_to_rome(string $date_in_london_string)
{
    // trasformo l'orario di londra in un oggetto dateTime
    $date_in_london = DateTime::createFromFormat('Y-m-d H:i:s', $date_in_london_string);

    // prendo il fuso orario per l'ita
    $timezoneItalia = new DateTimeZone('Europe/Rome');

    // setto la data londinese nel corrispettivo italiano
    $correct_data_in_italia_string = $date_in_london->setTimezone($timezoneItalia);

    // converto l'oggetto datetime in stringa
    $correct_data_in_italia_string = $date_in_london->format('Y-m-d H:i:s');

    // Restituisci la data e l'orario corretti
    return $correct_data_in_italia_string;
}
