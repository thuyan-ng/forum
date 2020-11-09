function convertDate($date){
    let splitted = $date.split("-");
    let year = splitted[0];
    let month = splitted[1];
    let day = splitted[2];

    let monthNames = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "novembre", "décembre"];
    
    return day + " " + monthNames[month-1] + " " + year;
}
function convertHour($hour){
    let splitted = $hour.split(":");
    let hour = splitted[0];
    let minute = splitted[1];

    return hour + "h" + minute ;
}