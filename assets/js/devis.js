// The modal
var modal = document.getElementById("Modalrdv");
var btn = document.getElementById("rdv");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function () {
  modal.style.display = "block";
}
span.onclick = function () {
  modal.style.display = "none";
}
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

const days = {'Mondays': 1, 'Tuesdays': 2, 'Wednesdays': 3, 'Thursday': 4, 'Fridays': 5, 'Saturdays': 6, 'Sundays': 7};
const artisan_availability = document.getElementById('artisan_availability');
const reservation_date = document.getElementById('reservation_date');
const reservation_time = document.getElementById('reservation_time');

// Add an event listener to the select
artisan_availability.addEventListener('change', function () {
    document.getElementById("reservation_date").value = "";
    document.getElementById("reservation_time").value = "";
  if (artisan_availability.value !== '') {

    var selected_availability = document.getElementById("artisan_availability").value.split(";");
    var selected_availability_days = days[selected_availability[0]];
    var selected_availability_start_time = selected_availability[1];
    var selected_availability_end_time = selected_availability[2];
    var hourRange = generateHourRange(selected_availability_start_time, selected_availability_end_time).map(hour => hour.toString() + ":00:00");
    for (let i = 0; i < hourRange.length; i++) {
        console.log(hourRange[i]);
    }
    $(function () {
      // Get today's date
      var today = new Date();

      // Only allow reservations in a range of one month, starting from today
      var OneMonthFromNow = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());

      // Restrict the datetime range according to the option selected
      $("#reservation_date").datepicker({
        format: 'Y-m-d',
        dayOfWeekStart: 1,
        beforeShowDay: function (date) {
          // Check if the date is valid
          return [(date.getDay() === selected_availability_days && date >= today && date <= OneMonthFromNow), ''];
        },
        minDate: today, // Minimum date is today
        maxDate: OneMonthFromNow // Maximum date is one month from now
      });
      $("#reservation_time").datetimepicker({
        datepicker: false,
        format: 'H:i:i',
        minTime: selected_availability_start_time,
        maxTime: selected_availability_end_time,
      });
    });

    reservation_date.style.display = 'block';
    reservation_time.style.display = 'block';
  } else {
    reservation_date.style.display = 'none';
    reservation_time.style.display = 'none';
  }
});

// Generate the hour range
function generateHourRange(start, end) {
  const startTime = parseInt(start.split(':')[0]);
  const endTime = parseInt(end.split(':')[0]);

  const hours = [];
  for (let i = startTime; i <= endTime; i++) {
    hours.push(i);
  }

  return hours;
}
