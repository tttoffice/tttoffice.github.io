//
//var upgradeTime = 5184000,
//    seconds = upgradeTime;
//function timer() {
//    'use strict';
//    var days        = Math.floor(seconds / 24 / 60 / 60),
//        hoursLeft   = Math.floor((seconds) - (days * 86400)),
//        hours       = Math.floor(hoursLeft / 3600),
//        minutesLeft = Math.floor((hoursLeft) - (hours * 3600)),
//        minutes     = Math.floor(minutesLeft / 60),
//        remainingSeconds = seconds % 60;
//    function pad(n) {
//        return (n < 10 ? "0" + n : n);
//    }
//    document.getElementById('countdown').innerHTML = "<div class='row justify-content-center'><div class='col-md-3 col-4 mt-3'><span class='m-auto'>" + pad(days) + " يوم</span></div><div class='col-md-3 col-4 mt-3'><span class='m-auto'>" + pad(hours) + " ساعة</span></div><div class='col-md-3 col-4 mt-3'><span class='m-auto'>" + pad(minutes) + " دقيقة</span></div><div class='col-md-3 col-4 mt-3'><span class='m-auto'>" + pad(remainingSeconds) + " ثانية</span></div></div>";
//    if (seconds == 0) {
//        clearInterval(countdownTimer);
//        document.getElementById('countdown').innerHTML = "Completed";
//    } else {
//        seconds--
//    }
//}
//var countdownTimer = setInterval('timer()', 1000);
var timer;

var compareDate = new Date('12/10/2020 00:00 AM');
compareDate.setDate(compareDate.getDate() + 7); //just for this demo today + 7 days

timer = setInterval(function() {
  timeBetweenDates(compareDate);
}, 1000);

function timeBetweenDates(toDate) {
  var dateEntered = toDate;
  var now = new Date();
  var difference = dateEntered.getTime() - now.getTime();

  if (difference <= 0) {

    // Timer done
    clearInterval(timer);

  } else {

    var seconds = Math.floor(difference / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);

    hours %= 24;
    minutes %= 60;
    seconds %= 60;

    $("#days").text(days);
    $("#hours").text(hours);
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);
  }
}