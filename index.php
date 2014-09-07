<!DOCTYPE>

<html lang="en">

  <head>

    <style>
      date {
        display: none;
      }
    </style>

  </head>

  <body>
    <h1>The Roll</h1>
    <date data-time="<?= time() * 1000 ?>"></date>

    <div class="date-absolute">
      <div class="months"></div>
      <div class="weeks"></div>
      <div class="days"></div>
      <div class="hours"></div>
      <div class="minutes"></div>
      <div class="seconds"></div>
    </div>

    <br />

    <div class="date-relative">
      <div class="months"></div>
      <div class="weeks"></div>
      <div class="days"></div>
      <div class="hours"></div>
      <div class="minutes"></div>
      <div class="seconds"></div>
    </div>

    <script src="/bower_components/momentjs/min/moment-with-locales.js"></script>

    <script>
    
      var rollDay = 20;
      var rollMonths = [2, 5, 8, 11]

      function getNextRoll() {
        var timeNow = moment();

        while (timeNow.date() != rollDay) {
          timeNow.add('day', 1);
        }

        while (rollMonths.indexOf(timeNow.month()) === -1) {
          timeNow.add('month', 1);
        }

        timeNow.set('hour', 0);
        timeNow.set('minute', 0);
        timeNow.set('second', 0);
        timeNow.set('millisecond', 0);

        return timeNow;

      }

      // Find when next roll is
      var rollTime = getNextRoll();

      // If it has passed, celebrate
      if (moment().diff(rollTime) <= 0) {
        console.log('day of roll!', 'success!');
      }

      var units = [
        'months',
        'weeks',
        'days',
        'hours',
        'minutes',
        'seconds'
      ];

      var $absolute = document.querySelector('.date-absolute');
      var $relative = document.querySelector('.date-relative');

      function set() {
        var i;
        var curr1 = moment();
        var curr2 = moment();

        for (i = 0; i < units.length; i++) {
          // Calculates absolute units
          var absolute = Math.floor(rollTime.diff(curr1, units[i], true));
          $absolute.querySelector('.' + units[i]).innerHTML = absolute + ' ' + units[i];

          // Calculates relative time
          var relative = rollTime.diff(curr2, units[i]);
          curr2.add(units[i], relative);
          $relative.querySelector('.' + units[i]).innerHTML = relative + ' ' + units[i];
        }

        window.setTimeout(set, 1000);
      }

      set();

    </script>

  </body>

</html>
