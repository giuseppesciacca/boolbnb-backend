@extends('layouts.admin')

@section('content')

<?php

?>


<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div>
        <div style="width: 800px;">
            <canvas id="acquisitions"></canvas>
        </div>
    </div>

    <script type="module" src="acquisitions.js"></script>

<script>
    // example from chartjs
  const data = [
    { year: 2010, count: 10 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];

  new Chart(
    document.getElementById('acquisitions'),
    {
      type: 'line',
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'Acquisitions by year',
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
</script>

 

 

</body>


</html>




@endsection